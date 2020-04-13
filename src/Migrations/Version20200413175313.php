<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200413175313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE apartment (id INT AUTO_INCREMENT NOT NULL, building_id INT NOT NULL, number SMALLINT NOT NULL, area DOUBLE PRECISION NOT NULL, count_people SMALLINT DEFAULT NULL, INDEX IDX_4D7E68544D2A7E12 (building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE apartment_user (apartment_id INT NOT NULL, user_id BIGINT UNSIGNED NOT NULL, INDEX IDX_F80F64A7176DFE85 (apartment_id), INDEX IDX_F80F64A7A76ED395 (user_id), PRIMARY KEY(apartment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apartment ADD CONSTRAINT FK_4D7E68544D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE apartment_user ADD CONSTRAINT FK_F80F64A7176DFE85 FOREIGN KEY (apartment_id) REFERENCES apartment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apartment_user ADD CONSTRAINT FK_F80F64A7A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE streets RENAME INDEX street_id_city_id TO streets_city_id_foreign');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE apartment_user DROP FOREIGN KEY FK_F80F64A7176DFE85');
        $this->addSql('DROP TABLE apartment');
        $this->addSql('DROP TABLE apartment_user');
        $this->addSql('ALTER TABLE streets RENAME INDEX streets_city_id_foreign TO street_id_city_id');
    }
}
