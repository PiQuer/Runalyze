<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Runalyze\Profile\System\HashProfile;

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
            ->setParameter('type', HashProfile::ACTIVATION)
            ->getQuery()
            ->getSingleScalarResult();
    }*/

    public function save(Hash $hash)
    {
        $this->_em->persist($hash);
        $this->_em->flush();
    }
}
