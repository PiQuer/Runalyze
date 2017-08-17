<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AccountClientRepository extends EntityRepository
{
    /**
     * @param Account $account
     * @return $accountClient[]
     */
    public function findByAccount(Account $account)
    {
        return $this->findBy([
            'account' => $account->getId()
        ]);
    }

    /**
     * @param Account $account
     * @param string $key
     * @return AccountClient|null
     */
    public function findByAccountAndProvider(Account $account, $provider)
    {
        $results = $this->findBy([
            'account' => $account->getId(),
            'provider' => $provider
        ]);

        return empty($results) ? null : $results[0];
    }

    /**
     * @param Account $account
     * @param int $provider
     * @param string $token
     *
     * @return AccountClient
     */
    public function updateOrInsert(Account $account, $provider, $token)
    {
        if (null === $accountClient = $this->findByAccountAndProvider($account, $provider)) {
            $accountClient = new AccountClient();
            $accountClient->setProvider($provider);
            $accountClient->setAccount($account);
        }

        $accountClient->setToken($token);
        $this->save($accountClient);

        return $accountClient;
    }

    public function save(AccountClient $accountClient)
    {
        $this->_em->persist($accountClient);
        $this->_em->flush($accountClient);
    }

    public function remove(AccountClient $accountClient)
    {
        $this->_em->remove($accountClient);
        $this->_em->flush();
    }
}
