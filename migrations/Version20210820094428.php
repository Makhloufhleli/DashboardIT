<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820094428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates DROP FOREIGN KEY FK_8D26FB5F115F0EE5');
        $this->addSql('ALTER TABLE certificates ADD CONSTRAINT FK_8D26FB5F115F0EE5 FOREIGN KEY (domain_id) REFERENCES domains (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE domains DROP INDEX UNIQ_8C7BBF9D166D1F9C, ADD INDEX IDX_8C7BBF9D166D1F9C (project_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates DROP FOREIGN KEY FK_8D26FB5F115F0EE5');
        $this->addSql('ALTER TABLE certificates ADD CONSTRAINT FK_8D26FB5F115F0EE5 FOREIGN KEY (domain_id) REFERENCES domains (id)');
        $this->addSql('ALTER TABLE domains DROP INDEX IDX_8C7BBF9D166D1F9C, ADD UNIQUE INDEX UNIQ_8C7BBF9D166D1F9C (project_id)');
    }
}
