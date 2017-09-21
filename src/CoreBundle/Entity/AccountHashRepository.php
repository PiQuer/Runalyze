<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Runalyze\Profile\System\HashProfile;

class AccountHashRepository extends EntityRepository
{
    public function getDefaultObject($type, Account $account) {
        $accountHash = new AccountHash();
        $accountHash->setType($type);
        $accountHash->setAccount($account);
        return $accountHash;
    }

    public function addDeletionHash(Account $account)
    {
        $accountHash = $this->findOneBy([
            'account' => $account->getId(),
            'type' => HashProfile::DELETION
        ]);
        if (null === $accountHash) {
            $accountHash = $this->getDefaultObject(HashProfile::DELETION, $account);
        } else {
            $accountHash->setNewHash();
        }
        $accountHash->setTimelimit(time() + 1209600);


        $this->save($accountHash);
        return $accountHash;
    }

    public function addActivationHash(Account $account)
    {
        dump($account);
        $accountHash = $this->findOneBy([
            'account' => $account->getId(),
            'type' => HashProfile::ACTIVATION
        ]);
        if (null === $accountHash) {
            $accountHash = $this->getDefaultObject(HashProfile::ACTIVATION, $account);
        } else {
            $accountHash->setNewHash();
        }
        $accountHash->setTimelimit(time() + 1209600);

        $this->save($accountHash);
        return $accountHash;
    }

    public function addRecoverPasswordHash(Account $account)
    {
        $accountHash = $this->findOneBy([
            'account' => $account->getId(),
            'type' => HashProfile::RECOVER_PASSWORD
        ]);
        if (null === $accountHash) {
            $accountHash = $this->getDefaultObject(HashProfile::RECOVER_PASSWORD, $account);
        } else {
            $accountHash->setNewHash();
        }
        $accountHash->setTimelimit(time() + 86400);

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

    public function getAccountByRecoverHash($hash) {
        $hash = $this->findOneBy([
            'hash' => $hash,
            'type' => HashProfile::RECOVER_PASSWORD
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

