<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210823125636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hosts CHANGE subscription subscription VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F710B8E53F');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F7B00092E6');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F7F4595BF2');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F710B8E53F FOREIGN KEY (technical_manager_id) REFERENCES accounts_managers (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F7B00092E6 FOREIGN KEY (admin_manager_id) REFERENCES accounts_managers (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F7F4595BF2 FOREIGN KEY (billing_manager_id) REFERENCES accounts_managers (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hosts CHANGE subscription subscription VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F7B00092E6');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F710B8E53F');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F7F4595BF2');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F7B00092E6 FOREIGN KEY (admin_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F710B8E53F FOREIGN KEY (technical_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F7F4595BF2 FOREIGN KEY (billing_manager_id) REFERENCES accounts_managers (id)');
    }
}
