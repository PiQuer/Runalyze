<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccountHash
 *
 * @ORM\Table(name="account_hash", indexes={@ORM\Index(name="account_id", columns={"account_id"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\AccountHashRepository")
 */
class AccountHash
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="type", type="integer", columnDefinition="tinyint unsigned NOT NULL DEFAULT 2")
     *
     * @see \Runalyze\Profile\System\HashProfile
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
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account", cascade={"remove"})
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
     * @param null|string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null|string $Hash
     * @return $this
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
        return $this;
    }

    /**
     * @param int $bytes
     * @return string hash of length 2*$bytes
     */
    public static function getRandomHash($bytes = 16) {
        return bin2hex(openssl_random_pseudo_bytes($bytes));
    }

    /**
     * @param null|int $timelimit
     * @return $this
     */
    public function setTimelimit($timelimit)
    {
        $this->timelimit = $timelimit;

        return $this;
    }

    /**
     * @return null|int
     */
    public function getTimelimit()
    {
        return $this->timelimit;
    }

    /**
     * @param null|Account $account
     *
     * @return $this
     */
    public function setAccount(Account $account = null)
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
