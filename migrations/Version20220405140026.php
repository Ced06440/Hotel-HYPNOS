<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220405140026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_mandelieu (id INT AUTO_INCREMENT NOT NULL, bookers_id INT NOT NULL, rooms_id INT NOT NULL, end_date DATETIME NOT NULL, start_date DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D37B39F7E996650 (bookers_id), INDEX IDX_D37B39F78E2368AB (rooms_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_mandelieu ADD CONSTRAINT FK_D37B39F7E996650 FOREIGN KEY (bookers_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE booking_mandelieu ADD CONSTRAINT FK_D37B39F78E2368AB FOREIGN KEY (rooms_id) REFERENCES rooms_mandelieu (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking_mandelieu');
    }
}
