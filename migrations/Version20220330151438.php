<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330151438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, booker_id INT NOT NULL, rooms_id INT NOT NULL, hotels_id INT DEFAULT NULL, end_date DATETIME NOT NULL, start_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_E00CEDDE8B7E4006 (booker_id), INDEX IDX_E00CEDDE8E2368AB (rooms_id), INDEX IDX_E00CEDDEF42F66C8 (hotels_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booking_auxerre (id INT AUTO_INCREMENT NOT NULL, bookers_id INT NOT NULL, rooms_id INT NOT NULL, end_date DATETIME NOT NULL, start_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_302DFDFE996650 (bookers_id), INDEX IDX_302DFDF8E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8B7E4006 FOREIGN KEY (booker_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE8E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms_auxerre (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEF42F66C8 FOREIGN KEY (hotels_id) REFERENCES hotel (id)');
        $this->addSql('ALTER TABLE booking_auxerre ADD CONSTRAINT FK_302DFDFE996650 FOREIGN KEY (bookers_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE booking_auxerre ADD CONSTRAINT FK_302DFDF8E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms_auxerre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE booking_auxerre');
    }
}
