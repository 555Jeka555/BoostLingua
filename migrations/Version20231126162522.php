<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126162522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '`Create table user`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(' CREATE TABLE user (
        user_id INT AUTO_INCREMENT NOT NULL,
        first_name VARCHAR(255) NOT NULL, 
        second_name VARCHAR(255) NOT NULL, 
        link_name VARCHAR(255) NOT NULL, 
        description VARCHAR(255) DEFAULT NULL, 
        email VARCHAR(255) NOT NULL, 
        password VARCHAR(255) NOT NULL, 
        avatar_name VARCHAR(255) DEFAULT NULL,
        user_role INT NOT NULL, 
        PRIMARY KEY(user_id)) 
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}
