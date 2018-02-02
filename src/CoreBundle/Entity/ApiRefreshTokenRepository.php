<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ApiRefreshTokenRepository extends EntityRepository
{

    /**
     * @param Account $account
     * @return ApiRefreshToken[]
     */
    public function findByAccount(Account $account)
    {
        return $this->findBy([
            'user' => $account->getId()
        ]);
    }


    public function save(ApiRefreshToken $apiRefreshToken)
    {
        $this->_em->persist($apiRefreshToken);
        $this->_em->flush();
    }

    public function remove(ApiRefreshToken $apiRefreshToken)
    {
        $this->_em->remove($apiRefreshToken);
        $this->_em->flush();
    }
}
