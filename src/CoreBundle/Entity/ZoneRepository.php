<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ZoneRepository extends EntityRepository
{
    /**
     * @param Account $account
     * @param Sport|null $sport
     * @return Zone[]
     */
    public function findAllFor(Account $account, Sport $sport = null)
    {
        if (null !== $sport) {
            return $this->findBy([
                'account' => $account->getId(),
                'sport' => $sport->getId()
            ]);
        }

        return $this->findBy([
            'account' => $account->getId()
        ]);
    }

    /**
     * @param Account $account
     * @param int $metric
     * @param Sport|null $sport
     * @return Zone[]
     */
    public function findMetricForSport(Account $account, $metric, Sport $sport = null)
    {
        if (null !== $sport) {
            return $this->findBy([
                'account' => $account->getId(),
                'sport' => $sport->getId()
            ]);
        }

        return $this->findBy([
            'account' => $account->getId()
        ]);
    }

    public function save(Zone $zone)
    {
        $this->_em->persist($zone);
        $this->_em->flush();
    }
}
