<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountClient
 *
 * @ORM\Table(name="account_client", indexes={@ORM\Index(name="accountid", columns={"account_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="unique_internal_id", columns={"account_id", "provider"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\AccountClientRepository")
 */
class AccountClient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", unique=true, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="provider", type="smallint", length=5, nullable=false)
     */
    private $provider;

    /**
     * @var string
     *
     * @ORM\Column(name="refreshToken", type="string", length=200, nullable=false)
     */
    private $refreshToken;

    /**
     * @var \Runalyze\Bundle\CoreBundle\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_id", referencedColumnName="id", nullable=false)
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
     * @return $this
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
     * Set plain token
     *
     * @param string $plainToken
     *
     * @return $this
     */
    public function setPlainToken($plainToken)
    {
        $this->plainToken = $plainToken;

        return $this;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     *
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set account
     *
     * @param \Runalyze\Bundle\CoreBundle\Entity\Account $account
     *
     * @return $this
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
