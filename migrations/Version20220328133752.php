<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328133752 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD rooms_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms_auxerre (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE8E2368AB ON booking (rooms_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE8E2368AB');
        $this->addSql('DROP INDEX IDX_E00CEDDE8E2368AB ON booking');
        $this->addSql('ALTER TABLE booking DROP rooms_id');
    }
}
