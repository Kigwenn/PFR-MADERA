<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021171426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_utilisateur DROP FOREIGN KEY FK_5605B422FB88E14F');
        $this->addSql('DROP INDEX IDX_5605B422FB88E14F ON type_utilisateur');
        $this->addSql('ALTER TABLE type_utilisateur DROP utilisateur_id');
        $this->addSql('ALTER TABLE utilisateur ADD type_utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AD4BC8DB FOREIGN KEY (type_utilisateur_id) REFERENCES type_utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3AD4BC8DB ON utilisateur (type_utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE type_utilisateur ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_utilisateur ADD CONSTRAINT FK_5605B422FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_5605B422FB88E14F ON type_utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AD4BC8DB');
        $this->addSql('DROP INDEX IDX_1D1C63B3AD4BC8DB ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP type_utilisateur_id');
    }
}
