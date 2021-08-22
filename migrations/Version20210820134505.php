<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820134505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates ADD host_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE certificates ADD CONSTRAINT FK_8D26FB5F1FB8D185 FOREIGN KEY (host_id) REFERENCES hosts (id) ON DELETE SET NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D26FB5F1FB8D185 ON certificates (host_id)');
        $this->addSql('ALTER TABLE hosts DROP FOREIGN KEY FK_D8CD66B999223FFD');
        $this->addSql('DROP INDEX UNIQ_D8CD66B999223FFD ON hosts');
        $this->addSql('ALTER TABLE hosts ADD has_certificate TINYINT(1) NOT NULL, DROP certificate_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE certificates DROP FOREIGN KEY FK_8D26FB5F1FB8D185');
        $this->addSql('DROP INDEX UNIQ_8D26FB5F1FB8D185 ON certificates');
        $this->addSql('ALTER TABLE certificates DROP host_id');
        $this->addSql('ALTER TABLE hosts ADD certificate_id INT DEFAULT NULL, DROP has_certificate');
        $this->addSql('ALTER TABLE hosts ADD CONSTRAINT FK_D8CD66B999223FFD FOREIGN KEY (certificate_id) REFERENCES certificates (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D8CD66B999223FFD ON hosts (certificate_id)');
    }
}
