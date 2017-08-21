<?php

namespace Runalyze\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20170815090503 extends AbstractMigration implements ContainerAwareInterface
{
    /** @var ContainerInterface|null */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $prefix = $this->container->getParameter('database_prefix');

        $this->addSql('INSERT INTO `'.$prefix.'hash` (`account_id`, `type`, `hash`, `timelimit`) SELECT id, 1, changepw_hash, changepw_timelimit FROM `'.$prefix.'account` WHERE changepw_hash IS NOT NULL AND changepw_timelimit IS NOT NULL');
        $this->addSql('INSERT INTO `'.$prefix.'hash` (`account_id`, `type`, `hash`, `timelimit`) SELECT id, 2, activation_hash, registerdate+1209600 FROM `'.$prefix.'account` WHERE activation_hash IS NOT NULL');
        $this->addSql('INSERT INTO `'.$prefix.'hash` (`account_id`, `type`, `hash`, `timelimit`) SELECT id, 3, deletion_hash, UNIX_TIMESTAMP()+1209600 FROM `'.$prefix.'account` WHERE deletion_hash IS NOT NULL');
        $this->addSql('ALTER TABLE `'.$prefix.'account` ADD status tinyint unsigned NOT NULL DEFAULT 0, DROP changepw_hash, DROP changepw_timelimit, DROP activation_hash, DROP deletion_hash');


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // not possible
    }
}
