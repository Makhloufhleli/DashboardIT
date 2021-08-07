<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210806194050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE servers_clients');
        $this->addSql('ALTER TABLE domains DROP INDEX UNIQ_8C7BBF9D19EB6921, ADD INDEX IDX_8C7BBF9D19EB6921 (client_id)');
        $this->addSql('ALTER TABLE servers ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE servers ADD CONSTRAINT FK_4F8AF5F719EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)');
        $this->addSql('CREATE INDEX IDX_4F8AF5F719EB6921 ON servers (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE servers_clients (servers_id INT NOT NULL, clients_id INT NOT NULL, INDEX IDX_D2E03F02B26CDFEC (servers_id), INDEX IDX_D2E03F02AB014612 (clients_id), PRIMARY KEY(servers_id, clients_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE servers_clients ADD CONSTRAINT FK_D2E03F02AB014612 FOREIGN KEY (clients_id) REFERENCES clients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE servers_clients ADD CONSTRAINT FK_D2E03F02B26CDFEC FOREIGN KEY (servers_id) REFERENCES servers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE domains DROP INDEX IDX_8C7BBF9D19EB6921, ADD UNIQUE INDEX UNIQ_8C7BBF9D19EB6921 (client_id)');
        $this->addSql('ALTER TABLE servers DROP FOREIGN KEY FK_4F8AF5F719EB6921');
        $this->addSql('DROP INDEX IDX_4F8AF5F719EB6921 ON servers');
        $this->addSql('ALTER TABLE servers DROP client_id');
    }
}
