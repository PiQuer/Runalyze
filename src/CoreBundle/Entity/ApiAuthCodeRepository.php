<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ApiAuthCodeRepository extends EntityRepository
{

    public function save(ApiAuthCode $apiAuthCode)
    {
        $this->_em->persist($apiAuthCode);
        $this->_em->flush();
    }

    public function remove(ApiAuthCode $apiAuthCode)
    {
        $this->_em->remove($apiAuthCode);
        $this->_em->flush();
    }
}
