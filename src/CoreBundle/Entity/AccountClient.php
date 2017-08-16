<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountClient
 *
 * @ORM\Table(name="account_client", indexes={@ORM\Index(name="accountid", columns={"account_id"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\AccountClientRepository")
 */
class AccountClient
{
    /**
     * @var string
     *
     * @ORM\Column(name="provider_id", type="smallint", length=5, nullable=false)
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=200, nullable=false)
     */
    private $token;

    /**
     * @var \Runalyze\Bundle\CoreBundle\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="accountid", referencedColumnName="id", nullable=false)
     * })
     */
    private $account;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set provider
     *
     * @param string $provider
     *
     * @return AccountClient
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return AccountClient
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set account
     *
     * @param \Runalyze\Bundle\CoreBundle\Entity\Account $account
     *
     * @return AccountClient
     */
    public function setAccount(\Runalyze\Bundle\CoreBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \Runalyze\Bundle\CoreBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
