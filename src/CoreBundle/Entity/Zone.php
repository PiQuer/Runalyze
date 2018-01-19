<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Runalyze\Bundle\CoreBundle\Entity\Common\AccountRelatedEntityInterface;
use Runalyze\Bundle\CoreBundle\Entity\Common\IdentifiableEntityInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Zone
 *
 * @ORM\Table(name="zone", indexes={@ORM\Index(name="accountid_time", columns={"account_id", "sport_id"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\ZoneRepository")
 */
class Zone implements IdentifiableEntityInterface, AccountRelatedEntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Sport
     *
     * @ORM\ManyToOne(targetEntity="Sport", inversedBy="zones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sport_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $sport;

    /**
     * @var int|null see \Runalyze\Profile\Sport\ZoneMetricProfile
     *
     * @ORM\Column(name="metric_id", type="tinyint", options={"unsigned":true})
     */
    private $metric = null;

    /**
     * @var string
     *
     * @ORM\Column(name="settings", type="json_array", length=65535, nullable=false)
     */
    private $settings;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Sport $sport
     *
     * @return $this
     */
    public function setSport(Sport $sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * @return Sport
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param int|null $metric see \Runalyze\Profile\Sport\ZoneMetricProfile
     *
     * @return $this
     */
    public function setMetric($metric)
    {
        $this->metric = $metric;

        return $this;
    }

    /**
     * @return int|null see \Runalyze\Profile\Sport\ZoneMetricProfile
     */
    public function getMetric()
    {
        return $this->metric;
    }

    /**
     * @param string|null $settings
     *
     * @return $this
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param Account $account
     *
     * @return $this
     */
    public function setAccount(Account $account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
