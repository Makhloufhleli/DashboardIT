<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210806161233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE servers_clients (servers_id INT NOT NULL, clients_id INT NOT NULL, INDEX IDX_D2E03F02B26CDFEC (servers_id), INDEX IDX_D2E03F02AB014612 (clients_id), PRIMARY KEY(servers_id, clients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE servers_clients ADD CONSTRAINT FK_D2E03F02B26CDFEC FOREIGN KEY (servers_id) REFERENCES servers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE servers_clients ADD CONSTRAINT FK_D2E03F02AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clients DROP FOREIGN KEY FK_C82E741844E6B7');
        $this->addSql('DROP INDEX IDX_C82E741844E6B7 ON clients');
        $this->addSql('ALTER TABLE clients DROP server_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE servers_clients');
        $this->addSql('ALTER TABLE clients ADD server_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clients ADD CONSTRAINT FK_C82E741844E6B7 FOREIGN KEY (server_id) REFERENCES servers (id)');
        $this->addSql('CREATE INDEX IDX_C82E741844E6B7 ON clients (server_id)');
    }
}
