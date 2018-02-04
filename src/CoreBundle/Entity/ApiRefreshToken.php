<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;
use Doctrine\ORM\Mapping as ORM;
use Runalyze\Bundle\CoreBundle\Entity\ApiClient;
use Runalyze\Bundle\CoreBundle\Entity\Account;

/**
 * @ORM\Table(name="api_refresh_token")
 * @ORM\Entity(repositoryClass="Runalyze\Bundle\CoreBundle\Entity\ApiRefreshTokenRepository")
 */
class ApiRefreshToken extends BaseRefreshToken
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
     * @ORM\ManyToOne(targetEntity="Runalyze\Bundle\CoreBundle\Entity\Account", inversedBy="refreshTokens")
     */
    protected $user;
}