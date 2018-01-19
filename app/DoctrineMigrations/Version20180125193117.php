<?php

namespace Runalyze\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20180125193117 extends AbstractMigration implements ContainerAwareInterface
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

        $this->addSql("CREATE TABLE IF NOT EXISTS `".$prefix."zone` (
                  `id` INT UNSIGNED AUTO_INCREMENT NOT NULL,
                  sport_id INT UNSIGNED NOT NULL,
                  account_id INT UNSIGNED NOT NULL,
                  metric_id TINYINT UNSIGNED NOT NULL COMMENT '(DC2Type:tinyint)',
                  settings TEXT NOT NULL COMMENT '(DC2Type:json_array)',
                  INDEX IDX_7737055FAC78BCF8 (sport_id),
                  INDEX IDX_7737055F9B6B5FBA (account_id),
                  INDEX accountid_time (account_id, sport_id),
                  PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $prefix = $this->container->getParameter('database_prefix');
        $this->addSql('DROP TABLE `'.$prefix.'zone`');


    }
}
