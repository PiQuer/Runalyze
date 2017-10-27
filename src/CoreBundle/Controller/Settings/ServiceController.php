<?php

namespace Runalyze\Bundle\CoreBundle\Controller\Settings;

use Runalyze\Bundle\CoreBundle\Entity\AccountClientSettings;
use Runalyze\Bundle\CoreBundle\Entity\AccountClientSettingsRepository;
use Runalyze\Bundle\CoreBundle\Entity\AccountRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Runalyze\Bundle\CoreBundle\Entity\Account;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Runalyze\Bundle\CoreBundle\Form\Settings\ClientSettingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ServiceController extends Controller
{
    /**
     * @return AccountRepository
     */
    protected function getAccountRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:Account');
    }

    /**
     * @return AccountClientRepository
     */
    protected function getAccountClientRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:AccountClient');
    }

    /**
     * @return AccountClientSettingsRepository
     */
    protected function getAccountClientSettingRepository()
    {
        return $this->getDoctrine()->getRepository('CoreBundle:AccountClientSettings');
    }

    /**
     * @Route("/settings/services", name="settings-services")
     * @Security("has_role('ROLE_USER')")
     */
    public function servicesAction(Request $request, Account $account)
    {

        return $this->render('settings/services/services.html.twig', [
            'tomTomMySports' => !empty($this->getParameter('tomtom_mysports.client_id')) ? true : false,
            'connectedServices' => $this->getAccountClientRepository()->findByAccount($account)
        ]);
    }

    /**
     * @Route("/settings/services/client/{id}", name="settings-services-client-settings", requirements={"id" = "\d+"})
     * @ParamConverter("setting", class="CoreBundle:AccountClientSettings")
     * @Security("has_role('ROLE_USER')")
     */
    public function serviceClientSettingAction(Request $request, AccountClientSettings $setting, Account $account)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ClientSettingType::class, $setting ,[
            'action' => $this->generateUrl('settings-services-client-settings', ['id' => $setting->getId()])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getAccountClientSettingRepository()->save($setting);
            return $this->redirectToRoute('settings-services-client-settings', ['id' => $setting->getId()]);
        }

        return $this->render('settings/services/service-client-setting.html.twig', [
            'form' => $form->createView(),
            'id' => $setting->getId()
        ]);
    }
}
