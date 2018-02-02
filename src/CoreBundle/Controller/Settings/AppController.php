<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Settings;

use Runalyze\Bundle\CoreBundle\Entity\Account;
use Runalyze\Bundle\CoreBundle\Entity\ApiClientRepository;
use Runalyze\Bundle\CoreBundle\Entity\ApiRefreshToken;
use Runalyze\Bundle\CoreBundle\Entity\ApiRefreshTokenRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{
    /**
     * @return ApiClientRepository
     */
    protected function getApiClientRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:ApiClient');
    }

    /**
     * @return ApiRefreshTokenRepository
     */
    protected function getApiRefreshTokenRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:ApiRefreshToken');
    }


    /**
     * @Route("/settings/apps", name="settings-apps")
     * @Security("has_role('ROLE_USER')")
     */
    public function settingsAppAction(Request $request, Account $account)
    {

        return $this->render('settings/app.html.twig', [
            'connectedApps' => $this->getApiRefreshTokenRepository()->findByAccount($account)
        ]);
    }

    /**
     * @Route("/settings/apps/{id}/revoke", name="settings-app-revoke")
     * @Security("has_role('ROLE_USER')")
     * @ParamConverter("app", class="CoreBundle:ApiRefreshToken")
     */
    public function revokeAppAction(Request $request, ApiRefreshToken $app, Account $account)
    {
        $this->getApiRefreshTokenRepository()->remove($app);

        return $this->redirectToRoute('settings-apps');
    }
}
