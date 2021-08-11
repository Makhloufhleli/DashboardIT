<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210811103053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE accounts_managers (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, function VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hosts (id INT AUTO_INCREMENT NOT NULL, admin_manager_id INT DEFAULT NULL, technical_manager_id INT DEFAULT NULL, billing_manager_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, php_version VARCHAR(255) NOT NULL, disc_space VARCHAR(255) NOT NULL, certificate LONGTEXT NOT NULL, cdn VARCHAR(255) NOT NULL, sites LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', databases_links LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', backups LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', apache_nginx VARCHAR(255) NOT NULL, INDEX IDX_D8CD66B9B00092E6 (admin_manager_id), INDEX IDX_D8CD66B910B8E53F (technical_manager_id), INDEX IDX_D8CD66B9F4595BF2 (billing_manager_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, server_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5C93B3A41844E6B7 (server_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE servers (id INT AUTO_INCREMENT NOT NULL, admin_manager_id INT DEFAULT NULL, technical_manager_id INT DEFAULT NULL, billing_manager_id INT DEFAULT NULL, client_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, ip_adress VARCHAR(255) NOT NULL, project_public_cloud VARCHAR(255) DEFAULT NULL, model VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, data_center VARCHAR(255) NOT NULL, subscription VARCHAR(255) DEFAULT NULL, operating_system VARCHAR(255) NOT NULL, cpu VARCHAR(255) NOT NULL, ram VARCHAR(255) NOT NULL, disc_space VARCHAR(255) NOT NULL, extra_disc VARCHAR(255) NOT NULL, apache_nginx VARCHAR(255) NOT NULL, identifier VARCHAR(255) NOT NULL, INDEX IDX_4F8AF5F7B00092E6 (admin_manager_id), INDEX IDX_4F8AF5F710B8E53F (technical_manager_id), INDEX IDX_4F8AF5F7F4595BF2 (billing_manager_id), INDEX IDX_4F8AF5F719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hosts ADD CONSTRAINT FK_D8CD66B9B00092E6 FOREIGN KEY (admin_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE hosts ADD CONSTRAINT FK_D8CD66B910B8E53F FOREIGN KEY (technical_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE hosts ADD CONSTRAINT FK_D8CD66B9F4595BF2 FOREIGN KEY (billing_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A41844E6B7 FOREIGN KEY (server_id) REFERENCES servers (id)');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F7B00092E6 FOREIGN KEY (admin_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F710B8E53F FOREIGN KEY (technical_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F7F4595BF2 FOREIGN KEY (billing_manager_id) REFERENCES accounts_managers (id)');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F719EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE certificates ADD CONSTRAINT FK_8D26FB5F115F0EE5 FOREIGN KEY (domain_id) REFERENCES domains (id)');
        $this->addSql('ALTER TABLE domains CHANGE name name VARCHAR(255) NOT NULL, CHANGE creation_date creation_date DATE NOT NULL, CHANGE registr_ar registr_ar VARCHAR(255) NOT NULL, CHANGE registr_ant registr_ant VARCHAR(255) NOT NULL, CHANGE ns1 ns1 VARCHAR(255) NOT NULL, CHANGE ns2 ns2 VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8C7BBF9D166D1F9C ON domains (project_id)');
        $this->addSql('CREATE INDEX IDX_8C7BBF9DB00092E6 ON domains (admin_manager_id)');
        $this->addSql('CREATE INDEX IDX_8C7BBF9D10B8E53F ON domains (technical_manager_id)');
        $this->addSql('CREATE INDEX IDX_8C7BBF9DF4595BF2 ON domains (billing_manager_id)');
        $this->addSql('CREATE INDEX IDX_8C7BBF9D19EB6921 ON domains (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE domains DROP FOREIGN KEY FK_8C7BBF9DB00092E6');
        $this->addSql('ALTER TABLE domains DROP FOREIGN KEY FK_8C7BBF9D10B8E53F');
        $this->addSql('ALTER TABLE domains DROP FOREIGN KEY FK_8C7BBF9DF4595BF2');
        $this->addSql('ALTER TABLE hosts DROP FOREIGN KEY FK_D8CD66B9B00092E6');
        $this->addSql('ALTER TABLE hosts DROP FOREIGN KEY FK_D8CD66B910B8E53F');
        $this->addSql('ALTER TABLE hosts DROP FOREIGN KEY FK_D8CD66B9F4595BF2');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F7B00092E6');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F710B8E53F');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F7F4595BF2');
        $this->addSql('ALTER TABLE domains DROP FOREIGN KEY FK_8C7BBF9D19EB6921');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F719EB6921');
        $this->addSql('ALTER TABLE domains DROP FOREIGN KEY FK_8C7BBF9D166D1F9C');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A41844E6B7');
        $this->addSql('DROP TABLE accounts_managers');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE hosts');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE servers');
        $this->addSql('ALTER TABLE certificates DROP FOREIGN KEY FK_8D26FB5F115F0EE5');
        $this->addSql('DROP INDEX UNIQ_8C7BBF9D166D1F9C ON domains');
        $this->addSql('DROP INDEX IDX_8C7BBF9DB00092E6 ON domains');
        $this->addSql('DROP INDEX IDX_8C7BBF9D10B8E53F ON domains');
        $this->addSql('DROP INDEX IDX_8C7BBF9DF4595BF2 ON domains');
        $this->addSql('DROP INDEX IDX_8C7BBF9D19EB6921 ON domains');
        $this->addSql('ALTER TABLE domains CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE creation_date creation_date DATE DEFAULT NULL, CHANGE registr_ar registr_ar VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE registr_ant registr_ant VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_0900_ai_ci`, CHANGE ns1 ns1 INT DEFAULT NULL, CHANGE ns2 ns2 INT DEFAULT NULL');
    }
}
