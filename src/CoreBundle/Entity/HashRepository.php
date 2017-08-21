<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityRepository;
use Runalyze\Profile\System\Hash;
class HashRepository extends EntityRepository
{

    /**
     * @param int $days
     * @return array
     */
    /**
     * public function deleteNotActivatedAccounts($days = 7)
    {
        $minimumAge = time() - $days * 86400;

        return $this->createQueryBuilder('h')
            ->delete()
            ->where('h.type = :type AND h.timelimit < UNIX_TIMESTAMP()')
            ->setParameter('type', Hash::ACTIVATION)
            ->getQuery()
            ->getSingleScalarResult();
    }*/

    public function save(Hash $hash)
    {
        $this->_em->persist($hash);
        $this->_em->flush();
    }
}
