<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Runalyze\Parameter\Application\Timezone;
use Runalyze\Profile\System\AccountStatusProfile;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Runalyze\Model\Account\UserRole;
use Runalyze\Profile\Athlete\Gender;
use Runalyze\Bundle\CoreBundle\Validator\Constraints as RunalyzeAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Account
 *
 * @ORM\Table(name="account", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username"}), @ORM\UniqueConstraint(name="mail", columns={"mail"})})
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\AccountRepository")
 * @UniqueEntity("mail", message="This mail address is already in use")
 * @UniqueEntity("username", message="This username is already in use")
 */
class Account implements AdvancedUserInterface, \Serializable
{

    /**
     * @var string
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Your password must be at least {{ limit }} characters long"
     * )
     */
    private $plainPassword;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=10, unique=true, nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message = "You need to enter a username.")
     * @Assert\Length(
     *     min = 3,
     *     max = 32,
     *     minMessage = "Your username must be at least {{ limit }} characters long",
     *     maxMessage = "Your username cannot be longer than {{ limit }} characters")
     * @Assert\Regex(
     *     pattern  = "#[^a-zA-Z0-9\.\_\-]#i",
     *     match    = false,
     *     message  = "Besides digits and letters, only the following characters are allowed: . _ -"
     * )
     * @ORM\Column(name="username", type="string", length=60, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, options={"default":""})
     */
    private $name = '';

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     * )
     * @RunalyzeAssert\ContainsDisposableMailAddress()
     * @ORM\Column(name="mail", type="string", length=100, nullable=false)
     */
    private $mail;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="language", type="string", length=5, nullable=false, options={"default":"en"})
     */
    private $language = 'en';

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type("int")
     * @RunalyzeAssert\IsValidTimezone()
     * @ORM\Column(name="timezone", type="smallint", length=5, nullable=false, options={"unsigned":true, "default":0})
     */
    private $timezone = Timezone::UTC;

    /**
     * @var int
     * @Assert\Type("int")
     * @ORM\Column(name="gender", type="integer", columnDefinition="TINYINT UNSIGNED NOT NULL DEFAULT 0")
     */
    private $gender = Gender::NONE;

    /**
     * @var int|null
     * @Assert\Type("int")
     * @ORM\Column(name="birthyear", type="integer", precision=4, nullable=true, options={"unsigned":true})
     */
    private $birthyear = null;

    /**
     * @var string
     * @ORM\Column(name="password", type="string", length=64, nullable=false, options={"default": ""})
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=64, nullable=false, options={"fixed" = true, "default":""})
     */
    private $salt = '';

    /**
     * @var int|null
     * @Assert\Type("int")
     * @ORM\Column(name="registerdate", type="integer", nullable=true, options={"unsigned":true})
     */
    private $registerdate = null;

    /**
     * @var int|null
     * @Assert\Type("int")
     * @ORM\Column(name="lastaction", type="integer", nullable=true, options={"unsigned":true})
     */
    private $lastaction = null;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="allow_mails", type="boolean", columnDefinition="TINYINT UNSIGNED NOT NULL DEFAULT 1")
     */
    private $allowMails = true;

    /**
     * @var bool
     * @Assert\Type("bool")
     * @ORM\Column(name="allow_support", type="boolean", columnDefinition="TINYINT UNSIGNED NOT NULL DEFAULT 0")
     */
    private $allowSupport = false;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", columnDefinition="tinyint unsigned NOT NULL DEFAULT 0")
     *
     * @see \Runalyze\Profile\System\AccountStatusProfile
     */
    private $status = AccountStatusProfile::NOT_ACTIVATED;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Sport", mappedBy="account", cascade={"persist"}, fetch="EXTRA_LAZY")
     */
    protected $sports;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Runalyze\Bundle\CoreBundle\Entity\AccountHash", mappedBy="account", cascade={"persist"}, fetch="EXTRA_LAZY")
     */
    protected $hashes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Runalyze\Bundle\CoreBundle\Entity\EquipmentType", mappedBy="account", cascade={"persist"}, fetch="EXTRA_LAZY")
     */
    protected $equipmentTypes;

    /**
     * @var int
     *
     * @ORM\Column(name="role", columnDefinition="TINYINT UNSIGNED NOT NULL DEFAULT 1")
     */
    private $role = UserRole::ROLE_USER;


    public function __construct()
    {
        $this->setRegisterdate(time());
        $this->setLastAction(time());
        $this->setNewSalt();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Account
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Account
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Account
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     * @Assert\Type("string")
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     * @return Account
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Account
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthyear
     *
     * @param string $birthyear
     * @return Account
     */
    public function setBirthyear($birthyear)
    {
        $this->birthyear = $birthyear;

        return $this;
    }

    /**
     * Get birthyear
     *
     * @return string
     */
    public function getBirthyear()
    {
        return $this->birthyear;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plain password
     *
     * @param string $plainPassword
     * @return Account
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @return Account
     */
    public function setNewSalt()
    {
        return $this->setSalt(self::getRandomHash(32));
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Account
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
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
     * Set registerdate
     *
     * @param integer $registerdate
     * @return Account
     */
    public function setRegisterdate($registerdate)
    {
        $this->registerdate = $registerdate;

        return $this;
    }

    /**
     * Get registerdate
     *
     * @return integer
     */
    public function getRegisterdate()
    {
        return $this->registerdate;
    }

    /**
     * Set lastaction
     *
     * @param integer $lastaction
     * @return Account
     */
    public function setLastAction($lastaction = null)
    {
        if (is_null($lastaction)) {
            $lastaction = (int)(new \DateTime())->getTimestamp();
        }

        $this->lastaction = $lastaction;

        return $this;
    }

    /**
     * Get lastaction
     *
     * @return integer
     */
    public function getLastAction()
    {
        return $this->lastaction;
    }

     /**
     * Set allowMails
     *
     * @param bool $allowMails
     * @return Account
     */
    public function setAllowMails($allowMails)
    {
        $this->allowMails = $allowMails;

        return $this;
    }

    /**
     * Get allowMails
     *
     * @return bool
     */
    public function getAllowMails()
    {
        return $this->allowMails;
    }

    /**
     * Set allowSupport
     *
     * @param bool $allowSupport
     * @return Account
     */
    public function setAllowSupport($allowSupport)
    {
        $this->allowSupport = $allowSupport;

        return $this;
    }

    /**
     * Get allowSupport
     *
     * @return bool
     */
    public function getAllowSupport()
    {
        return $this->allowSupport;
    }

    /**
     * Set status
     *
     * @param null|string $status
     * @return Account
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Account
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    public function eraseCredentials()
    {
        $this->setPlainPassword(null);
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return array(UserRole::getRoleName($this->role));
    }

    /**
     * Get sports
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSports()
    {
        return $this->sports;
    }

    /**
     * Get account hashes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccountHashes()
    {
        return $this->hashes;
    }

    /**
     * Get equipment types
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEquipmentTypes()
    {
        return $this->equipmentTypes;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
	        $this->status,
	        $this->language
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
	        $this->status,
	        $this->language
        ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
	    return true;
    }

    public function isAccountNonLocked()
    {
	    return true;
    }

    public function isCredentialsNonExpired()
    {
	    return true;
    }

    public function isEnabled()
    {
	    return (AccountStatusProfile::ACTIVATED == $this->status);
    }
}
