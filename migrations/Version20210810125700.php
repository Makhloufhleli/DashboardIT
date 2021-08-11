<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810125700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hosts ADD certificate_id INT DEFAULT NULL, DROP certificate');
        $this->addSql('ALTER TABLE hosts ADD CONSTRAINT FK_D8CD66B999223FFD FOREIGN KEY (certificate_id) REFERENCES certificates (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8CD66B999223FFD ON hosts (certificate_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hosts DROP FOREIGN KEY FK_D8CD66B999223FFD');
        $this->addSql('DROP INDEX UNIQ_D8CD66B999223FFD ON hosts');
        $this->addSql('ALTER TABLE hosts ADD certificate LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP certificate_id');
    }
}
