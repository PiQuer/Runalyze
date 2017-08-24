<?php

namespace Runalyze\Bundle\CoreBundle\Services;

use Runalyze\Bundle\CoreBundle\Entity\Account;
use Symfony\Component\Translation\TranslatorInterface;

class AccountMailer
{
    /** @var \Swift_Mailer */
    protected $Mailer;

    /** @var \Twig_Environment */
    protected $Twig;

    /** @var TranslatorInterface */
    protected $Translator;

    /** @var array */
    protected $Sender = [];

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, TranslatorInterface $translator)
    {
        $this->Mailer = $mailer;
        $this->Twig = $twig;
        $this->Translator = $translator;
    }

    /**
     * @param string $senderMail
     * @param string $senderName
     */
    public function setFrom($senderMail, $senderName)
    {
        $this->Sender = [$senderMail => $senderName];
    }

    /**
     * @param Account $account
     * @param $subject
     * @param $template
     * @param array $templateData
     */
    public function sendMailTo(Account $account, $subject, $template, array $templateData)
    {
        $template = $this->customLanguageTemplates($template, $account->getLanguage());
        $message = \Swift_Message::newInstance($subject)
            ->setTo([$account->getMail() => $account->getUsername()])
            ->setFrom($this->Sender);
        $message->setBody($this->Twig->render($template, $templateData), 'text/html');

        $this->Mailer->send($message);
    }

    /**
     * @param string $template
     * @param string $language
     * @return string
     */
    protected function customLanguageTemplates($template, $language)
    {
        $template = str_replace('html.twig', '', $template);

        try {
            $this->Twig->render($template.$language.'.html.twig');

            return $template.$language.'.html.twig';
        } catch (\Exception $ex) {
            return $template.'html.twig';
        }
    }

    /**
     * @param Account $account
     * @param string $activationHash
     */
    public function sendActivationLinkTo(Account $account, $activationHash)
    {
            $this->sendMailTo($account, $this->Translator->trans('Please activate your RUNALYZE account'),
                'mail/account/registration.html.twig', [
                'username' => $account->getUsername(),
                'activationHash' => $activationHash
            ]
        );
    }

    /**
     * @param Account $account
     * @param string $changePasswordHash
     */
    public function sendRecoverPasswordLinkTo(Account $account, $changePasswordHash)
    {
        $this->sendMailTo($account, $this->Translator->trans('Reset your RUNALYZE password'),
                'mail/account/recoverPassword.html.twig', [
                'username' => $account->getUsername(),
                'changepw_hash' => $changePasswordHash
            ]
        );
    }

    /**
     * @param Account $account
     * @param string $deletionHash
     */
    public function sendDeleteLinkTo(Account $account, $deletionHash)
    {
        $this->sendMailTo($account, $this->Translator->trans('Deletion request of your RUNALYZE account'),
            'mail/account/deleteAccountRequest.html.twig', [
                'username' => $account->getUsername(),
                'deletion_hash' => $deletionHash
            ]
        );
    }
}
