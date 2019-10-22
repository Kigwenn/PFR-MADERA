<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191022120132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, rue_adresse VARCHAR(200) NOT NULL, ville_adresse VARCHAR(200) NOT NULL, cp_adresse VARCHAR(5) NOT NULL, region_adresse VARCHAR(200) NOT NULL, INDEX IDX_C35F0816670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, nom_caracteristique VARCHAR(100) NOT NULL, largeur_caracteristique DOUBLE PRECISION NOT NULL, hauteur_caracteristique DOUBLE PRECISION NOT NULL, epaisseur_caracteristique DOUBLE PRECISION NOT NULL, poids_caracteristique DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, nom_catalogue VARCHAR(100) NOT NULL, desc_catalogue LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom_commande VARCHAR(100) NOT NULL, prix_commande DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, fournisseur_composant_id INT NOT NULL, nom_composant VARCHAR(200) NOT NULL, prix_composant DOUBLE PRECISION NOT NULL, type_composant VARCHAR(100) NOT NULL, INDEX IDX_EC8486C916523276 (fournisseur_composant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_commande (composant_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_DCC5CF4B7F3310E7 (composant_id), INDEX IDX_DCC5CF4B82EA2E54 (commande_id), PRIMARY KEY(composant_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_stock (composant_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_B8CB81A7F3310E7 (composant_id), INDEX IDX_B8CB81ADCD6110 (stock_id), PRIMARY KEY(composant_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_caracteristique (composant_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_C1ED4EB57F3310E7 (composant_id), INDEX IDX_C1ED4EB51704EEB7 (caracteristique_id), PRIMARY KEY(composant_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, utilisateur_devis_id INT DEFAULT NULL, devis_maison_id INT NOT NULL, nom_devis VARCHAR(100) NOT NULL, date_devis DATETIME NOT NULL, prix_total DOUBLE PRECISION NOT NULL, INDEX IDX_8B27C52B5FA50345 (utilisateur_devis_id), INDEX IDX_8B27C52BECB412D5 (devis_maison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_etat_devis (devis_id INT NOT NULL, etat_devis_id INT NOT NULL, INDEX IDX_7D11A27A41DEFADA (devis_id), INDEX IDX_7D11A27ADC0B524A (etat_devis_id), PRIMARY KEY(devis_id, etat_devis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_etape (devis_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_3E7C68F941DEFADA (devis_id), INDEX IDX_3E7C68F94A8CA2AD (etape_id), PRIMARY KEY(devis_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doc_maison (id INT AUTO_INCREMENT NOT NULL, maison_id INT NOT NULL, data_doc LONGBLOB NOT NULL, INDEX IDX_7B6BABC19D67D8AF (maison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, nom_etape_devis VARCHAR(100) NOT NULL, valeur_base_etape INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_devis (id INT AUTO_INCREMENT NOT NULL, nom_etat VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom_fournisseur VARCHAR(50) NOT NULL, mail_fournisseur VARCHAR(100) NOT NULL, tel_fournisseur VARCHAR(10) NOT NULL, nom_contact_fournisseur VARCHAR(50) DEFAULT NULL, siret VARCHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gamme (id INT AUTO_INCREMENT NOT NULL, nom_gamme VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, nom_maison VARCHAR(100) NOT NULL, prix_maison DOUBLE PRECISION NOT NULL, nb_pieces INT NOT NULL, nb_chambres INT NOT NULL, desc_maison LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison_catalogue (maison_id INT NOT NULL, catalogue_id INT NOT NULL, INDEX IDX_AD14647A9D67D8AF (maison_id), INDEX IDX_AD14647A4A7843DC (catalogue_id), PRIMARY KEY(maison_id, catalogue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison_module (maison_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_ED7BA8CA9D67D8AF (maison_id), INDEX IDX_ED7BA8CAAFC2B591 (module_id), PRIMARY KEY(maison_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, gamme_module_id INT NOT NULL, nom_module VARCHAR(100) NOT NULL, prix_module DOUBLE PRECISION NOT NULL, INDEX IDX_C242628C04BB607 (gamme_module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_composant (module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_B6E59901AFC2B591 (module_id), INDEX IDX_B6E599017F3310E7 (composant_id), PRIMARY KEY(module_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_utilisateur (id INT AUTO_INCREMENT NOT NULL, niveau INT NOT NULL, nom_type VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, adresse_utilisateur_id INT NOT NULL, type_utilisateur_id INT NOT NULL, nom_utilisateur VARCHAR(50) NOT NULL, prenom_utilisateur VARCHAR(50) NOT NULL, mail_utilisateur VARCHAR(100) NOT NULL, tel_utilisateur VARCHAR(10) NOT NULL, mdp_utilisateur VARCHAR(30) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B37BF001EF (adresse_utilisateur_id), INDEX IDX_1D1C63B3AD4BC8DB (type_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C916523276 FOREIGN KEY (fournisseur_composant_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE composant_commande ADD CONSTRAINT FK_DCC5CF4B7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_commande ADD CONSTRAINT FK_DCC5CF4B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_stock ADD CONSTRAINT FK_B8CB81A7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_stock ADD CONSTRAINT FK_B8CB81ADCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB57F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB51704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B5FA50345 FOREIGN KEY (utilisateur_devis_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BECB412D5 FOREIGN KEY (devis_maison_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE devis_etat_devis ADD CONSTRAINT FK_7D11A27A41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etat_devis ADD CONSTRAINT FK_7D11A27ADC0B524A FOREIGN KEY (etat_devis_id) REFERENCES etat_devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etape ADD CONSTRAINT FK_3E7C68F941DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etape ADD CONSTRAINT FK_3E7C68F94A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE doc_maison ADD CONSTRAINT FK_7B6BABC19D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE maison_catalogue ADD CONSTRAINT FK_AD14647A9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_catalogue ADD CONSTRAINT FK_AD14647A4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_module ADD CONSTRAINT FK_ED7BA8CA9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_module ADD CONSTRAINT FK_ED7BA8CAAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628C04BB607 FOREIGN KEY (gamme_module_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E59901AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E599017F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B37BF001EF FOREIGN KEY (adresse_utilisateur_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3AD4BC8DB FOREIGN KEY (type_utilisateur_id) REFERENCES type_utilisateur (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B37BF001EF');
        $this->addSql('ALTER TABLE composant_caracteristique DROP FOREIGN KEY FK_C1ED4EB51704EEB7');
        $this->addSql('ALTER TABLE maison_catalogue DROP FOREIGN KEY FK_AD14647A4A7843DC');
        $this->addSql('ALTER TABLE composant_commande DROP FOREIGN KEY FK_DCC5CF4B82EA2E54');
        $this->addSql('ALTER TABLE composant_commande DROP FOREIGN KEY FK_DCC5CF4B7F3310E7');
        $this->addSql('ALTER TABLE composant_stock DROP FOREIGN KEY FK_B8CB81A7F3310E7');
        $this->addSql('ALTER TABLE composant_caracteristique DROP FOREIGN KEY FK_C1ED4EB57F3310E7');
        $this->addSql('ALTER TABLE module_composant DROP FOREIGN KEY FK_B6E599017F3310E7');
        $this->addSql('ALTER TABLE devis_etat_devis DROP FOREIGN KEY FK_7D11A27A41DEFADA');
        $this->addSql('ALTER TABLE devis_etape DROP FOREIGN KEY FK_3E7C68F941DEFADA');
        $this->addSql('ALTER TABLE devis_etape DROP FOREIGN KEY FK_3E7C68F94A8CA2AD');
        $this->addSql('ALTER TABLE devis_etat_devis DROP FOREIGN KEY FK_7D11A27ADC0B524A');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816670C757F');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C916523276');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628C04BB607');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BECB412D5');
        $this->addSql('ALTER TABLE doc_maison DROP FOREIGN KEY FK_7B6BABC19D67D8AF');
        $this->addSql('ALTER TABLE maison_catalogue DROP FOREIGN KEY FK_AD14647A9D67D8AF');
        $this->addSql('ALTER TABLE maison_module DROP FOREIGN KEY FK_ED7BA8CA9D67D8AF');
        $this->addSql('ALTER TABLE maison_module DROP FOREIGN KEY FK_ED7BA8CAAFC2B591');
        $this->addSql('ALTER TABLE module_composant DROP FOREIGN KEY FK_B6E59901AFC2B591');
        $this->addSql('ALTER TABLE composant_stock DROP FOREIGN KEY FK_B8CB81ADCD6110');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3AD4BC8DB');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B5FA50345');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE composant_commande');
        $this->addSql('DROP TABLE composant_stock');
        $this->addSql('DROP TABLE composant_caracteristique');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE devis_etat_devis');
        $this->addSql('DROP TABLE devis_etape');
        $this->addSql('DROP TABLE doc_maison');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE etat_devis');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE gamme');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE maison_catalogue');
        $this->addSql('DROP TABLE maison_module');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_composant');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE type_utilisateur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
