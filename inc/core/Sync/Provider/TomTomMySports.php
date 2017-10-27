<?php
namespace Runalyze\Sync\Provider;
use Runalyze\Bundle\CoreBundle\Entity\AccountClient;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientRepository;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientSettingsRepository;
use Runalyze\Sync\Provider\ActivitySyncInterface;
use Runalyze\Profile\Sync\SyncProvider;
use League\OAuth2\Client\Provider;
use KnpU\OAuth2ClientBundle\Client\OAuth2Client;

class TomTomMySports implements ActivitySyncInterface {

    /** @var Provider\TomTomMySports */
    protected $client;

    /** @var string $refreshToken */
    protected $refreshToken;

    /** @var string $refreshToken */
    protected $accessToken;

    /** @var AccountClientRepository */
    protected $AccountClientRepository;

    /** @var AccountClientSettingsRepository */
    protected $AccountClientSettingsRepository;


    /**
     * Constructor
     *
     * @param AccountClientRepository $accountClient
     * @param AccountClientSettingsRepository $accountClient
     * @param OAuth2Client $client
     */
    public function __construct(AccountClientRepository $accountClient, AccountClientSettingsRepository $accountClientSettings, OAuth2Client $client)
    {
        $this->AccountClientRepository = $accountClient;
        $this->AccountClientSettingsRepository = $accountClientSettings;
        $this->client = $client;
    }

    public function setRefreshToken($refreshToken) {
        $this->refreshToken = $refreshToken;
    }

    public static function getIdentifier() {
        return SyncProviderProfile::TOMTOM_MYSPORTS;
    }

    private function getAccessToken()
    {
        if (empty($accessToken)) {
            $accessToken = $this->client->getAccessToken('refresh_token', [
                'refresh_token' => $this->refreshToken
            ]);
            $this->accessToken = $accessToken->getToken();
        }

    }

    /*
     * @link https://developer.tomtom.com/tomtom-sports-cloud/tomtom-sports-cloud-documentation/get-activity-list
     */
    public function fetchActivityList()
    {
        $this->getAccessToken();

        $url = Provider\TomTomMySports::BASE_MYSPORTS_URL.'1/activity';
        /** @var Provider\TomTomMySports */
        $request = $this->client->getAuthenticatedRequest('GET', $url, $this->accessToken);
        dump($request);

    }

    /**
     * @param array $activityListArray
     */
    private function processActivityList($activityListArray)
    {
        foreach($activityListArray as $activity) {
            // Check if activity is already synced
            // If not queueActivity with needed identifier
        }

    }

    /*
     * @link https://developer.tomtom.com/tomtom-sports-cloud/tomtom-sports-cloud-documentation/get-startstop-activity
     */
    public function fetchActivity($identifier)
    {
        $url = Provider\TomTomMySports::BASE_MYSPORTS_URL.$identifier;
        $request = $this->client->getAuthenticatedRequest('GET', $url, $this->accessToken);

    }

    private function processActivity()
    {
        //Do what is needed to import that activity->
        //Call Parser/Importers
    }
}