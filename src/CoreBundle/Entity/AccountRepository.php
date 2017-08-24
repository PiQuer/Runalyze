<?php

namespace Runalyze\Bundle\CoreBundle\Entity;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityRepository;
use Runalyze\Profile\System\AccountStatusProfile;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

class AccountRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @param string $username username
     * @return null|Account
     */
    public function findByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string|string[] $language language key(s)
     * @param bool $excluded if set, all but given languages will be selected
     * @return array account ids
     */
    public function findAllByLanguage($language, $excluded = false)
    {
        return $this->findAllByLanguageQueryBuilder($language, $excluded)->getQuery()->getResult("COLUMN_HYDRATOR");
    }

    /**
     * @param string|string[] $language language key(s)
     * @param bool $excluded if set, all but given languages will be selected
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findAllByLanguageQueryBuilder($language, $excluded = false)
    {
        if (!is_array($language)) {
            $language = [$language];
        }

        $queryBuilder = $this->createQueryBuilder('u')
            ->select('u.id');

        if (!empty($language)) {
            $queryBuilder
                ->where('u.language '.($excluded ? 'NOT' : '').' IN (:lang)')
                ->setParameter('lang', $language, Connection::PARAM_STR_ARRAY);
        }

        return $queryBuilder;
    }

    /**
     * @param string $username username or mail
     * @return null|Account
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.mail = :mail')
            ->setParameter('username', $username)
            ->setParameter('mail', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param bool $cache
     * @return mixed number of accounts
     */
    public function getAmountOfActivatedUsers($cache = true)
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->where('u.status = :status')
            ->setParameter('status', AccountStatusProfile::ACTIVATED)
            ->getQuery()
            ->useResultCache($cache, 320)
            ->getSingleScalarResult();
    }

    /**
     * @param array $criteria
     * @return bool
     */
    public function existsOneWith(array $criteria)
    {
        return null !== $this->findOneBy($criteria);
    }

    /**
     * @param string $deletionHash
     * @return bool true on success
     */
    /**
    public function deleteByHash($deletionHash)
    {
        $account = $this->findOneBy([
            'deletionHash' => $deletionHash
        ]);

        if (null !== $account) {
            $this->_em->remove($account);
            $this->_em->flush();

            return true;
        }

        return false;
    }
    */

    /**
     * @param string $activationHash
     * @return bool true on success
     * @TODO
     */
    /**
    public function activateByHash($activationHash)
    {
        $account = $this->findOneBy([
            'activationHash' => $activationHash
        ]);

        if (null !== $account) {
            $this->save($account->removeActivationHash());

            return true;
        }

        return false;
    }*/

    public function save(Account $account)
    {
        $this->_em->persist($account);
        $this->_em->flush();
    }
}
