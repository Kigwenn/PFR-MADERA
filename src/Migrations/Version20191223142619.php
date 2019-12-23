<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223142619 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C960D6DC42');
        $this->addSql('DROP INDEX IDX_EC8486C960D6DC42 ON composant');
        $this->addSql('ALTER TABLE composant DROP modules_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composant ADD modules_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C960D6DC42 FOREIGN KEY (modules_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C960D6DC42 ON composant (modules_id)');
    }
}
