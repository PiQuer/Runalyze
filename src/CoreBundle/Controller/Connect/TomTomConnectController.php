<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Connect;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Runalyze\Profile\SyncProvider;


/**
 * Class TomTomConnectController
 * @author Hannes Christiansen <hannes@runalyze.de>
 * @author Michael Pohl <michael@runalyze.de>
 * @package Runalyze\Bundle\CoreBundle\Controller\Connect
 */
class TomTomConnectController extends Controller
{
    /**
     * @Route("/connect/tomtomMySports")
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
    public function connectCheckAction(Request $request)
    {
        /** @var \League\OAuth2\Client\Provider\TomTomMySports $client */
        $client = $this->get('oauth2.registry')
            ->getClient('tomtomMySports');

        try {
            // the exact class depends on which provider you're using
            /** @var \League\OAuth2\Client\Provider\FacebookUser $user */
            #    $user = $client->getApiVersion();
            echo $client->getAccessToken();
            return new JsonResponse();


            // do something with all this new power!
            //$user->getFirstName();
            // ...
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            $e->getMessage();die;
        }



    }
}