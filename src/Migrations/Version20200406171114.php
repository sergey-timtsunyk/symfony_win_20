<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200406171114 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `cities` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $this->addSql('CREATE TABLE `streets` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `type` enum(\'ул\',\'пл\',\'пр-т\',\'пер\',\'бул\') COLLATE utf8mb4_unicode_ci NOT NULL,
              `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
              `city_id` bigint(20) unsigned NOT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              KEY `streets_city_id_foreign` (`city_id`),
              CONSTRAINT `streets_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $this->addSql('CREATE TABLE `users` (
              `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
              `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
              `email_verified_at` timestamp NULL DEFAULT NULL,
              `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
              `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `created_at` timestamp NULL DEFAULT NULL,
              `updated_at` timestamp NULL DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `users_email_unique` (`email`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE streets');
        $this->addSql('DROP TABLE cities');
        $this->addSql('DROP TABLE users');

    }
}
