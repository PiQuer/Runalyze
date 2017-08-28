<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * AccountClient
 *
 * @ORM\Table(name="account_client_settings", indexes={@ORM\Index(name="accountid", columns={"account_id"})}, uniqueConstraints={@ORM\UniqueConstraint(name="unique_internal_id", columns={"account_id", "client_id", "data_type"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\AccountClientSettingsRepository")
 */
class AccountClientSettings
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
     * @var \Runalyze\Bundle\CoreBundle\Entity\AccountClient
     *
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\AccountClient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="data_type", type="smallint", length=5, nullable=false)
     */
    private $dataType;

    /**
     * @var array
     *
     * @ORM\Column(name="generic_data", type="json_array", nullable=true)
     */
    private $genericData;

    /**
     * @var null|\DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="enabled", type="boolean", columnDefinition="tinyint unsigned NOT NULL DEFAULT 1")
     */
    private $enabled = true;

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
     * @param array $genericData
     *
     * @return $this
     */
    public function setGenericData($genericData)
    {
        $this->genericData = $genericData;

        return $this;
    }

    /**
     * @return array
     */
    public function getGenericData()
    {
        return $this->genericData;
    }

    /**
     * @param null|\DateTime $startDate
     *
     * @return $this
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
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
