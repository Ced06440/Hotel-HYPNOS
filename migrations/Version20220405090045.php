<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405090045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_paris (id INT AUTO_INCREMENT NOT NULL, bookers_id INT NOT NULL, rooms_id INT NOT NULL, end_date DATETIME NOT NULL, start_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_7503657E996650 (bookers_id), INDEX IDX_75036578E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_paris ADD CONSTRAINT FK_7503657E996650 FOREIGN KEY (bookers_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE booking_paris ADD CONSTRAINT FK_75036578E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms_paris (id)');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE8E2368AB');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE8B7E4006');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEF42F66C8');
        $this->addSql('DROP INDEX IDX_E00CEDDE8E2368AB ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDEF42F66C8 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE8B7E4006 ON booking');
        $this->addSql('ALTER TABLE booking DROP booker_id, DROP rooms_id, DROP hotels_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking_paris');
        $this->addSql('ALTER TABLE booking ADD booker_id INT NOT NULL, ADD rooms_id INT NOT NULL, ADD hotels_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms_auxerre (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8B7E4006 FOREIGN KEY (booker_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF42F66C8 FOREIGN KEY (hotels_id) REFERENCES hotel (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE8E2368AB ON booking (rooms_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEF42F66C8 ON booking (hotels_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE8B7E4006 ON booking (booker_id)');
    }
}
