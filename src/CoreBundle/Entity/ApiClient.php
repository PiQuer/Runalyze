<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ApiClient extends BaseClient
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="internal_note", type="text", length=65535, nullable=true)
     */
    private $internalNote;

    /**
     * @var string
     *
     * @ORM\Column(name="contactMail", type="string", length=100, nullable=false)
     */
    private $contactMail;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var int|null [timestamp]
     *
     * @ORM\Column(name="created", type="integer", nullable=true, options={"unsigned":true})
     */
    private $created = null;

    /**
     * Set name
     *
     * @param string $name
     * @return $this
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
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $internalNote
     * @return $this
     */
    public function setInternalNote($internalNote)
    {
        $this->internalNote = $internalNote;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getInternalNote()
    {
        return $this->internalNote;
    }

    /**
     * Set contactMail
     *
     * @param string $contactMail
     * @return $this
     */
    public function setContactMail($contactMail)
    {
        $this->contactMail = $contactMail;
        return $this;
    }

    /**
     * Get contactMail
     *
     * @return string
     */
    public function getContactMail()
    {
        return $this->contactMail;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null|int $created [timestamp]
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return null|int [timestamp]
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedToNow()
    {
        $this->setCreated(time());
    }

}