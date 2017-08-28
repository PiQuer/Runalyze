<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuccessfulSyncs
 *
 * @ORM\Table(name="successful_syncs", indexes={@ORM\Index(name="successfulSyncIndex", columns={"account_id", "client_id", "data_type"})}, uniqueConstraints={@ORM\UniqueConstraint(name="unique_internal_id", columns={"client_id", "data_type", "data_identifier"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\SuccessfulSyncsRepository")
 */
class SuccessfulSyncs
{

    /**
     * @var \Runalyze\Bundle\CoreBundle\Entity\AccountClient
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\AccountClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="data_type", type="smallint", length=5, nullable=false)
     */
    private $dataType;

    /**
     * @var string
     *
     * @ORM\Column(name="data_identifier", type="string", length=100, nullable=true)
     */
    private $dataIdentifier;

    /**
     * @var \Runalyze\Bundle\CoreBundle\Entity\Account
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $account;

    /**
     * Set client
     *
     * @param \Runalyze\Bundle\CoreBundle\Entity\AccountClient $accountClient
     *
     * @return $this
     */
    public function setClient(AccountClient $accountClient = null)
    {
        $this->client = $accountClient;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Runalyze\Bundle\CoreBundle\Entity\AccountClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param int $dataType
     *
     * @return $this
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * @return int
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param null|string $dataIdentifier
     *
     * @return $this
     */
    public function setDataIdentifier($dataIdentifier)
    {
        $this->dataIdentifier = $dataIdentifier;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDataIdentifier()
    {
        return $this->dataIdentifier;
    }

    /**
     * Set account
     *
     * @param \Runalyze\Bundle\CoreBundle\Entity\Account $account
     *
     * @return $this
     */
    public function setAccount(Account $account = null)
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
