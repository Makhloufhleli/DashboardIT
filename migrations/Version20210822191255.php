<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210822191255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hosts ADD client_id INT DEFAULT NULL, ADD cluster VARCHAR(255) NOT NULL, ADD datacenter VARCHAR(255) NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD subscription VARCHAR(255) NOT NULL, ADD identifier VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE hosts ADD CONSTRAINT FK_D8CD66B919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_D8CD66B919EB6921 ON hosts (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hosts DROP FOREIGN KEY FK_D8CD66B919EB6921');
        $this->addSql('DROP INDEX IDX_D8CD66B919EB6921 ON hosts');
        $this->addSql('ALTER TABLE hosts DROP client_id, DROP cluster, DROP datacenter, DROP type, DROP subscription, DROP identifier');
    }
}
