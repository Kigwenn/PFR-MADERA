<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202174859 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AD4BC8DB');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B5FA50345');
        $this->addSql('DROP TABLE type_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER TABLE commercial ADD token VARCHAR(64) NOT NULL, ADD token_date DATETIME NOT NULL');
        $this->addSql('DROP INDEX IDX_8B27C52B5FA50345 ON devis');
        $this->addSql('ALTER TABLE devis ADD id_client_id INT NOT NULL, DROP utilisateur_devis_id');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B99DED506 ON devis (id_client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE type_utilisateur (id INT AUTO_INCREMENT NOT NULL, niveau INT NOT NULL, nom_type VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, adresse_utilisateur_id INT NOT NULL, type_utilisateur_id INT NOT NULL, nom_utilisateur VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, prenom_utilisateur VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, mail_utilisateur VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, tel_utilisateur VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, mdp_utilisateur VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_1D1C63B37BF001EF (adresse_utilisateur_id), INDEX IDX_1D1C63B3AD4BC8DB (type_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B37BF001EF FOREIGN KEY (adresse_utilisateur_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AD4BC8DB FOREIGN KEY (type_utilisateur_id) REFERENCES type_utilisateur (id)');
        $this->addSql('ALTER TABLE commercial DROP token, DROP token_date');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B99DED506');
        $this->addSql('DROP INDEX IDX_8B27C52B99DED506 ON devis');
        $this->addSql('ALTER TABLE devis ADD utilisateur_devis_id INT DEFAULT NULL, DROP id_client_id');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B5FA50345 FOREIGN KEY (utilisateur_devis_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B5FA50345 ON devis (utilisateur_devis_id)');
    }
}
