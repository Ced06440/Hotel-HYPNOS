<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323082720 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD hotel_id INT DEFAULT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E93243BB18 ON users (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93243BB18');
        $this->addSql('DROP INDEX UNIQ_1483A5E93243BB18 ON users');
        $this->addSql('ALTER TABLE users DROP hotel_id, DROP firstname, DROP lastname');
    }
}
