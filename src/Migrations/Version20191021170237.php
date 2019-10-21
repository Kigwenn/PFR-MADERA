<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021170237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devis ADD utilisateur_devis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B5FA50345 FOREIGN KEY (utilisateur_devis_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B5FA50345 ON devis (utilisateur_devis_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B341DEFADA');
        $this->addSql('DROP INDEX IDX_1D1C63B341DEFADA ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP devis_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B5FA50345');
        $this->addSql('DROP INDEX IDX_8B27C52B5FA50345 ON devis');
        $this->addSql('ALTER TABLE devis DROP utilisateur_devis_id');
        $this->addSql('ALTER TABLE utilisateur ADD devis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B341DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B341DEFADA ON utilisateur (devis_id)');
    }
}
