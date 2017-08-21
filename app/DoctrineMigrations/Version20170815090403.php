<?php

namespace Runalyze\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20170815090403 extends AbstractMigration implements ContainerAwareInterface
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

        $this->addSql('CREATE TABLE `'.$prefix.'hash` (id INT UNSIGNED AUTO_INCREMENT NOT NULL, account_id INT UNSIGNED NOT NULL, type tinyint unsigned NOT NULL DEFAULT 2, hash CHAR(32) DEFAULT NULL, timelimit INT UNSIGNED DEFAULT NULL, INDEX account_id (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `'.$prefix.'hash` ADD CONSTRAINT FK_664A7E09B6B5FBA FOREIGN KEY (account_id) REFERENCES runalyze_account (id);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE `'.$prefix.'hash`');
    }
}
