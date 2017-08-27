<?php

namespace Runalyze\Bundle\CoreBundle\Component\Notifications\Message;

use Runalyze\Profile\Notifications\MessageTypeProfile;
use Runalyze\Profile\Sync\SyncProvider;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

class ConnectedClientMessage implements MessageInterface
{
    /** @var int connection successful */
    const STATE_SUCCESS = 0;

    /** @var int connection not successfully */
    const STATE_FAILED = 1;

    /** @var int SyncProvider */
    protected $Provider;

    /** @var int see self::STATE_... */
    protected $State = 0;

    public function __construct($provider, $state = self::STATE_SUCCESS)
    {
        $this->State = (int)$state;
        $this->Provider = (int)$provider;
    }

    public function getMessageType()
    {
        return MessageTypeProfile::CONNECTED_CLIENT_MESSAGE;
    }

    public function getData()
    {
        return (string)$this->State;
    }

    public function getLifetime()
    {
        return 5;
    }

    public function getText(TranslatorInterface $translator)
    {
        switch ($this->State) {
            case self::STATE_FAILED:
                return $translator->trans(
                    'Connecting your account with %provider% failed',
                    array('%provider%' => $this->Provider)
                );

        }

        return $translator->trans(
            'You are successfully conntecd with %provider%',
            array('%provider%' => $this->Provider)
        );

    }

    public function hasLink()
    {
        return self::STATE_FAILED != $this->State;
    }

    public function getLink(RouterInterface $router)
    {
        return $router->generate('settings-services');
    }

    public function isLinkInternal()
    {
        return true;
    }

    public function getWindowSizeForInternalLink()
    {
        return '';
    }
}
