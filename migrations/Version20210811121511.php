<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811121511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates DROP FOREIGN KEY FK_8D26FB5F166D1F9C');
        $this->addSql('DROP INDEX UNIQ_8D26FB5F166D1F9C ON certificates');
        $this->addSql('ALTER TABLE certificates ADD renawal_date DATE DEFAULT NULL, DROP project_id, DROP renewal_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates ADD project_id INT DEFAULT NULL, ADD renewal_date DATE NOT NULL, DROP renawal_date');
        $this->addSql('ALTER TABLE certificates ADD CONSTRAINT FK_8D26FB5F166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D26FB5F166D1F9C ON certificates (project_id)');
    }
}
