<?php

namespace Runalyze\Bundle\CoreBundle\Queue\Receiver;

use Bernard\Message\DefaultMessage;
use Monolog\Logger;
use Runalyze\Bundle\CoreBundle\Component\Tool\Backup\FilenameHandler;
use Runalyze\Bundle\CoreBundle\Component\Tool\Backup\JsonBackup;
use Runalyze\Bundle\CoreBundle\Component\Tool\Backup\SqlBackup;
use Runalyze\Bundle\CoreBundle\Entity\Account;
use Runalyze\Bundle\CoreBundle\Entity\AccountRepository;
use Runalyze\Bundle\CoreBundle\Entity\Common\AccountRelatedEntityInterface;
use Runalyze\Bundle\CoreBundle\Entity\SportRepository;
use Runalyze\Bundle\CoreBundle\Services\Activity\ActivityContextFactory;
use Runalyze\Bundle\CoreBundle\Services\Configuration\ConfigurationManager;
use Runalyze\Bundle\CoreBundle\Services\Import\ActivityContextAdapterFactory;
use Runalyze\Bundle\CoreBundle\Services\Import\ActivityDataContainerFilter;
use Runalyze\Bundle\CoreBundle\Services\Import\FileImporter;
use Symfony\Component\CssSelector\Parser\Token;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Runalyze\Bundle\CoreBundle\Component\Notifications;
use Runalyze\Bundle\CoreBundle\Entity\Notification;
use Runalyze\Bundle\CoreBundle\Component\Notifications\Message\BackupReadyMessage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Runalyze\Bundle\CoreBundle\Component\Activity\ActivityContext;
use Runalyze\Bundle\CoreBundle\Entity\TrainingRepository;
use Runalyze\Bundle\CoreBundle\Services\Import\FileImportResult;
use Runalyze\Parser\Activity\Common\Data\ActivityDataContainer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Runalyze\Bundle\CoreBundle\Services\Import\ActivityDataContainerToActivityContextConverter;
use Psr\Log\LoggerInterface;

class ActivityReceiver
{
    /** @var FileImporter */
    private $fileImporter;

    /** @var LoggerInterface */
    protected $Logger;

    /** @var ConfigurationManager */
    protected $configurationManager;

    /** @var ActivityContextAdapterFactory */
    protected $activityContextAdapterFactory;

    /** @var ActivityDataContainerFilter */
    protected $activityDataContainerFilter;

    /** @var ActivityDataContainerToActivityContextConverter */
    protected $activityContextConverter;

    /** @var TokenStorage $tokenStorage */
    protected $tokenStorage;

    /** @var AccountRepository */
    protected $accountRepository;

    /** @var SportRepository */
    protected $sportRepository;

    /** @var TrainingRepository */
    protected $trainingRepository;

    /** @var $Datadir */
    protected $DataDir;

    /**
     * ActivityReceiver constructor.
     * @param FileImporter $fileImporter
     * @param LoggerInterface $logger
     * @param ConfigurationManager $configurationManager
     * @param ActivityContextAdapterFactory $activityContextAdapterFactory
     * @param ActivityDataContainerFilter $activityDataContainerFilter
     * @param ActivityDataContainerToActivityContextConverter $activityContextConverter
     * @param TokenStorage $tokenStorage
     * @param AccountRepository $accountRepository
     * @param SportRepository $sportRepository
     * @param TrainingRepository $trainingRepository
     * @param $dataDir
     */
    public function __construct(
        FileImporter $fileImporter,
        LoggerInterface $logger,
        ConfigurationManager $configurationManager,
        ActivityContextAdapterFactory $activityContextAdapterFactory,
        ActivityDataContainerFilter $activityDataContainerFilter,
        ActivityDataContainerToActivityContextConverter $activityContextConverter,
        TokenStorage $tokenStorage,
        AccountRepository $accountRepository,
        SportRepository $sportRepository,
        TrainingRepository $trainingRepository,
        $dataDir
    )
    {
        $this->fileImporter = $fileImporter;
        $this->Logger = $logger;
        $this->configurationManager = $configurationManager;
        $this->activityContextAdapterFactory = $activityContextAdapterFactory;
        $this->activityDataContainerFilter = $activityDataContainerFilter;
        $this->activityContextConverter = $activityContextConverter;
        $this->tokenStorage = $tokenStorage;
        $this->accountRepository = $accountRepository;
        $this->sportRepository = $sportRepository;
        $this->trainingRepository = $trainingRepository;
        $this->DataDir = $dataDir;
    }

    public function activityImport(DefaultMessage $message)
    {

        $fileHandler = new FilenameHandler($message->get('accountid'));

        /** @var Account $account */
        $account = $this->accountRepository->find($message->get('account'));


        $token = new UsernamePasswordToken($account, null, 'main', $account->getRoles());
        $this->tokenStorage->setToken($token);

        $filePath = $this->DataDir.$message->get('filename');

        $importResult = $this->fileImporter->importSingleFile($filePath);
        $importResult->completeAndFilterResults($this->activityDataContainerFilter);
        $defaultLocation = $this->configurationManager->getList()->getActivityForm()->getDefaultLocationForWeatherForecast();

        if ($message->get('sport') !== null) {
            $possibleSport = $this->sportRepository->find((int)$message->get('sport'));
            if($possibleSport->getAccount()->getId() == $account->getId()) {
                $sport = $possibleSport;
            }
        }

        foreach ($importResult as $result) {
            /** @var $result FileImportResult */
            foreach ($result->getContainer() as $container) {
                $activity = $this->containerToActivity($container, $account);
               /* if ($sport) {
                    $activity->setSport($sport);
                }*/
                $context = new ActivityContext($activity, null, null, $activity->getRoute());
                $contextAdapter = $this->activityContextAdapterFactory->getAdapterFor($context);

                if ($contextAdapter->isPossibleDuplicate()) {
                    $this->Logger->warning('Activity duplicate', ['filename' => $message->get('filename'), 'account' => $account->getId()]);
                    break;
                }

                $contextAdapter->guessWeatherConditions($defaultLocation);
                $this->trainingRepository->save($activity);
                $this->Logger->info('Activity succesfully imported', ['filename' => $message->get('filename'), 'account' => $account->getId()]);

            }
        }

        //Notification
    }

    /**
     * @param ActivityDataContainer $container
     * @param Account $account
     * @return \Runalyze\Bundle\CoreBundle\Entity\Training
     */
    protected function containerToActivity(ActivityDataContainer $container, Account $account)
    {
        return $this->activityContextConverter->getActivityFor($container, $account);
    }

}
