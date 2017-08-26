<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Runalyze\Profile\System\HashProfile;

class AccountHashRepository extends EntityRepository
{
    public function addDeletionHash(Account $account)
    {
        $accountHash = new AccountHash();
        $accountHash->setType(HashProfile::DELETION);
        $accountHash->setAccount($account);
        $this->save($accountHash);
        return $accountHash;
    }

    public function addActivationHash(Account $account)
    {
        $accountHash = new AccountHash();
        $accountHash->setType(HashProfile::ACTIVATION);
        $accountHash->setAccount($account);
        $this->save($accountHash);
        return $accountHash;
    }

    public function addChangePasswordHash(Account $account)
    {
        $accountHash = new AccountHash();
        $accountHash->setType(HashProfile::CHANGE_PASSWORD);
        $accountHash->setAccount($account);
        $this->save($accountHash);
        return $accountHash;
    }

    public function activateAccount($hash, $username = null) {
        $hash = $this->createQueryBuilder('h')
            ->join('h.account', 'a')
            ->where('h.hash = :hash')
            ->setParameter('hash', $hash)
            ->getQuery()
            ->getResult();
        return $hash;
    }

    public function save(AccountHash $accountHash)
    {
        $this->_em->persist($accountHash);
        $this->_em->flush();
    }
}

