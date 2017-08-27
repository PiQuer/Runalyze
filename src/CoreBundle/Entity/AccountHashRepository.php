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

    public function activateAccount($hash) {
        $hash = $this->findOneBy([
            'hash' => $hash,
            'type' => HashProfile::ACTIVATION
        ]);

        return $hash;
    }

    public function getAccountByDeletionHash($hash) {
        $hash = $this->findOneBy([
            'hash' => $hash,
            'type' => HashProfile::DELETION
        ]);

        return $hash;
    }

    public function save(AccountHash $accountHash)
    {
        $this->_em->persist($accountHash);
        $this->_em->flush();
    }

    public function remove(AccountHash $accountHash)
    {
        $this->_em->remove($accountHash);
        $this->_em->flush();
    }
}

