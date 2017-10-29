<?php

namespace Runalyze\Bundle\CoreBundle\Queue\Receiver;

use Bernard\Message\DefaultMessage;
use Runalyze\Bundle\CoreBundle\Entity\Account;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Runalyze\Bundle\CoreBundle\Component\Notifications;
use Runalyze\Bundle\CoreBundle\Entity\Notification;
use Runalyze\Bundle\CoreBundle\Component\Notifications\Message\BackupReadyMessage;

class ServiceSyncReceiver
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function syncActivity(DefaultMessage $message)
    {
        /** @var Account $account */
        $account = $this->container->get('doctrine.orm.entity_manager')->getRepository('CoreBundle:Account')->find($message->get('accountid'));



        /*$this->container->get('doctrine')->getRepository('CoreBundle:Notification')->save(
            Notification::createFromMessage(new BackupReadyMessage(), $account)
        );*/
    }
}
