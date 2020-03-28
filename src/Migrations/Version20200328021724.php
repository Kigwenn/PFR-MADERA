<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328021724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module ADD modu_reference_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628FAFBE836 FOREIGN KEY (modu_reference_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C242628FAFBE836 ON module (modu_reference_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628FAFBE836');
        $this->addSql('DROP INDEX IDX_C242628FAFBE836 ON module');
        $this->addSql('ALTER TABLE module DROP modu_reference_id');
    }
}
