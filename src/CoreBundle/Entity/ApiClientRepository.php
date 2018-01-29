<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ApiClientRepository extends EntityRepository
{

    public function save(ApiClient $apiClient)
    {
        $this->_em->persist($apiClient);
        $this->_em->flush();
    }

    public function remove(ApiClient $apiClient)
    {
        $this->_em->remove($apiClient);
        $this->_em->flush();
    }
}
