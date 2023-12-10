<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231210130558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '`Create table post`';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE post (
        post_id INT AUTO_INCREMENT NOT NULL,
        subscribe_id INT DEFAULT NULL,
        author_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        body TEXT NOT NULL,
        cover VARCHAR(255) DEFAULT NULL,
        PRIMARY KEY(post_id))
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE post');
    }
}
