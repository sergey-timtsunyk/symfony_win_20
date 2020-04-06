<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200406172900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE building (id INT AUTO_INCREMENT NOT NULL, street_id BIGINT UNSIGNED NOT NULL, number SMALLINT NOT NULL, section_count INT NOT NULL, INDEX IDX_E16F61D487CF8EB (street_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE building ADD CONSTRAINT FK_E16F61D487CF8EB FOREIGN KEY (street_id) REFERENCES streets (id)');
        //$this->addSql('DROP INDEX streets_city_id_foreign ON streets');
        $this->addSql('ALTER TABLE streets DROP FOREIGN KEY streets_city_id_foreign');
        $this->addSql('ALTER TABLE cities CHANGE id id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE streets CHANGE city_id city_id SMALLINT UNSIGNED DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE building');
        $this->addSql('ALTER TABLE cities CHANGE id id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE streets CHANGE city_id city_id BIGINT UNSIGNED NOT NULL');
    }
}
