<?php

namespace Runalyze\Bundle\CoreBundle\Tests\Entity;

use Runalyze\Bundle\CoreBundle\Entity\Account;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    /** @var Account */
    protected $Account;

    public function setUp()
    {
        $this->Account = new Account();
    }

    public function testDefaultValues()
    {
        $this->assertNotNull($this->Account->getSalt());
    }


}
