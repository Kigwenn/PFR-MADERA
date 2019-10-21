<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021163500 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fournisseur ADD adresse_fournisseur_id INT NOT NULL');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA32E77495DF FOREIGN KEY (adresse_fournisseur_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_369ECA32E77495DF ON fournisseur (adresse_fournisseur_id)');
        $this->addSql('ALTER TABLE utilisateur ADD adresse_utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B37BF001EF FOREIGN KEY (adresse_utilisateur_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B37BF001EF ON utilisateur (adresse_utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA32E77495DF');
        $this->addSql('DROP INDEX UNIQ_369ECA32E77495DF ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur DROP adresse_fournisseur_id');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B37BF001EF');
        $this->addSql('DROP INDEX UNIQ_1D1C63B37BF001EF ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP adresse_utilisateur_id');
    }
}
