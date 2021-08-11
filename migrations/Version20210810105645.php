<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210810105645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates ADD project_id INT DEFAULT NULL, DROP projects');
        $this->addSql('ALTER TABLE certificates ADD CONSTRAINT FK_8D26FB5F166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D26FB5F166D1F9C ON certificates (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates DROP FOREIGN KEY FK_8D26FB5F166D1F9C');
        $this->addSql('DROP INDEX UNIQ_8D26FB5F166D1F9C ON certificates');
        $this->addSql('ALTER TABLE certificates ADD projects LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', DROP project_id');
    }
}
