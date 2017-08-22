<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hash
 *
 * @ORM\Table(name="hash", indexes={@ORM\Index(name="account_id", columns={"account_id"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\HashRepository")
 */
class Hash
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", columnDefinition="tinyint unsigned NOT NULL DEFAULT 2")
     *
     * @see \Runalyze\Profile\System\Hash
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hash", type="string", length=32, nullable=true, options={"fixed" = true})
     */
    private $hash = null;

    /**
     * @var int|null
     *
     * @ORM\Column(name="timelimit", type="integer", nullable=true, options={"unsigned":true})
     */
    private $timelimit = null;

    /**
     * @var \Runalyze\Bundle\CoreBundle\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="account_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $account;

    public function __construct()
    {
        $this->setNewHash();
    }

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
     * Set type
     *
     * @param null|string $type
     * @return Hash
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set Hash
     *
     * @param null|string $Hash
     * @return Hash
     */
    public function setHash($Hash)
    {
        $this->hash = $Hash;

        return $this;
    }

    /**
     * Get Hash
     *
     * @return null|string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return $this
     */
    public function setNewHash()
    {
        $this->setHash(self::getRandomHash(16));
        $this->setTimelimit(time() + 86400);

        return $this;
    }

    /**
     * Get hash.
     * @param int $bytes
     * @return string hash of length 2*$bytes
     */
    public static function getRandomHash($bytes = 16) {
        return bin2hex(openssl_random_pseudo_bytes($bytes));
    }

    /**
     * Set Timelimit
     *
     * @param null|int $Timelimit
     * @return Hash
     */
    public function setTimelimit($Timelimit)
    {
        $this->timelimit = $Timelimit;

        return $this;
    }

    /**
     * Get Timelimit
     *
     * @return null|int
     */
    public function getTimelimit()
    {
        return $this->timelimit;
    }

    /**
     * Set account
     *
     * @param \Runalyze\Bundle\CoreBundle\Entity\Account $account
     *
     * @return Conf
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
