<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210601074222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE data_center (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE distribution (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE server (id INT AUTO_INCREMENT NOT NULL, location_id INT DEFAULT NULL, distribution_id INT DEFAULT NULL, state_pending INT NOT NULL, state INT NOT NULL, cpu INT NOT NULL, ram INT NOT NULL, INDEX IDX_5A6DD5F664D218E (location_id), INDEX IDX_5A6DD5F66EB6DDB5 (distribution_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F664D218E FOREIGN KEY (location_id) REFERENCES data_center (id)');
        $this->addSql('ALTER TABLE server ADD CONSTRAINT FK_5A6DD5F66EB6DDB5 FOREIGN KEY (distribution_id) REFERENCES distribution (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F664D218E');
        $this->addSql('ALTER TABLE server DROP FOREIGN KEY FK_5A6DD5F66EB6DDB5');
        $this->addSql('DROP TABLE data_center');
        $this->addSql('DROP TABLE distribution');
        $this->addSql('DROP TABLE server');
    }
}
