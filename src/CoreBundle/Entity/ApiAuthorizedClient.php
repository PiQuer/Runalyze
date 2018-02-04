<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Runalyze\Bundle\CoreBundle\Entity\Common\AccountRelatedEntityInterface;

/**
 * @ORM\Table(name="api_authorized_client")
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\ApiAuthorizedClientRepository")
 */
class ApiAuthorizedClient implements AccountRelatedEntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\ApiClient")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @var \Runalyze\Bundle\CoreBundle\Entity\Account
     *
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account", inversedBy="authorizedClients")
     */
    protected $account;


    /**
     * @param ApiClient $client
     *
     * @return $this
     */
    public function setClient(ApiClient $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return ApiClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}