<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Connect;

use Runalyze\Bundle\CoreBundle\Component\Notifications\Message\ConnectedClientMessage;
use Runalyze\Bundle\CoreBundle\Entity\AccountClient;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientRepository;
use Runalyze\Bundle\CoreBundle\Entity\NotificationRepository;
use Runalyze\Profile\Sync\SyncProviderProfile;
use Runalyze\Sync\Provider\TomTomMySports;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Runalyze\Bundle\CoreBundle\Entity\Notification;
use Runalyze\Bundle\CoreBundle\Entity\Account;


/**
 * Class TomTomConnectController
 * @author Hannes Christiansen <hannes@runalyze.com>
 * @author Michael Pohl <michael@runalyze.com>
 * @package Runalyze\Bundle\CoreBundle\Controller\Connect
 */
class TomTomConnectController extends Controller
{
    /**
     * @return NotificationRepository
     */
    protected function getNotificationRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:Notification');
    }

    /**
     * @return AccountClientRepository
     */
    protected function getAccountClientRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:AccountClient');
    }

    /**
     * @Route("/connect/tomtomMySports", name="connect_tomtom_mysports")
     */
    public function connectAction()
    {
        return $this->get('oauth2.registry')
            ->getClient('tomtomMySports')
            ->redirect();
    }

    /**
     * @Route("/connect/tomtomMySports/check", name="connect_tomtom_mysports_check")
     */
    public function connectCheckAction(Request $request, Account $account)
    {
        /** @var \League\OAuth2\Client\Provider\TomTomMySports $client */
        $client = $this->get('oauth2.registry')->getClient('tomtomMySports');

        try {
            $token =  $client->getAccessToken();
            $AccountClient = new AccountClient();
            $AccountClient->setAccount($account);
            $AccountClient->setRefreshToken($token->getRefreshToken());
            $AccountClient->setProvider(SyncProviderProfile::TOMTOM_MYSPORTS);

            $this->getAccountClientRepository()->save($AccountClient);
            $test = new TomTomMySports($this->get('oauth2.registry')->getClient('tomtomMySports'), $token->getRefreshToken());
            $test->fetchActivityList();
            $this->getNotificationRepository()->save(
                Notification::createFromMessage(new ConnectedClientMessage(SyncProviderProfile::TOMTOM_MYSPORTS, ConnectedClientMessage::STATE_SUCCESS ), $account)
            );
          exit;

        } catch (IdentityProviderException $e) {
            $this->getNotificationRepository()->save(
                Notification::createFromMessage(new ConnectedClientMessage(SyncProviderProfile::TOMTOM_MYSPORTS, ConnectedClientMessage::STATE_FAILED), $account)
            );
        }
        return $this->redirectToRoute('dashboard');


    }
}