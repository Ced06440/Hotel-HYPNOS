<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323063003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_A949E006E7927C74 ON managers');
        $this->addSql('ALTER TABLE managers ADD hotel_id INT DEFAULT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE managers ADD CONSTRAINT FK_A949E0063243BB18 FOREIGN KEY (hotel_id) REFERENCES hotel (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A949E0063243BB18 ON managers (hotel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE managers DROP FOREIGN KEY FK_A949E0063243BB18');
        $this->addSql('DROP INDEX UNIQ_A949E0063243BB18 ON managers');
        $this->addSql('ALTER TABLE managers ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP hotel_id, DROP firstname, DROP lastname, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A949E006E7927C74 ON managers (email)');
    }
}
