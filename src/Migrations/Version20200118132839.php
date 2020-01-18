<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200118132839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, adre_rue VARCHAR(200) NOT NULL, adre_ville VARCHAR(200) NOT NULL, adre_cp VARCHAR(5) NOT NULL, adre_region VARCHAR(200) NOT NULL, adre_complement VARCHAR(255) DEFAULT NULL, adre_info VARCHAR(255) DEFAULT NULL, INDEX IDX_C35F0816A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE caracteristique (id INT AUTO_INCREMENT NOT NULL, cara_section DOUBLE PRECISION NOT NULL, cara_hauteur DOUBLE PRECISION NOT NULL, cara_longueur DOUBLE PRECISION NOT NULL, cara_type_angle VARCHAR(15) NOT NULL, cara_degre_angle DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, cata_nom VARCHAR(100) NOT NULL, cata_description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cctp (id INT AUTO_INCREMENT NOT NULL, cctp_nom VARCHAR(255) NOT NULL, cctp_image LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, pers_sexe VARCHAR(5) NOT NULL, pers_nom VARCHAR(50) NOT NULL, pers_prenom VARCHAR(50) NOT NULL, pers_mail VARCHAR(200) NOT NULL, pers_tel VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, adre_id INT NOT NULL, pers_sexe VARCHAR(5) NOT NULL, pers_nom VARCHAR(50) NOT NULL, pers_prenom VARCHAR(50) NOT NULL, pers_mail VARCHAR(200) NOT NULL, pers_tel VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_C744045535227DDF (adre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercial (id INT AUTO_INCREMENT NOT NULL, pers_sexe VARCHAR(5) NOT NULL, pers_nom VARCHAR(50) NOT NULL, pers_prenom VARCHAR(50) NOT NULL, pers_mail VARCHAR(200) NOT NULL, pers_tel VARCHAR(10) NOT NULL, comm_mdp VARCHAR(50) NOT NULL, comm_token VARCHAR(64) NOT NULL, comm_token_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, fami_id INT DEFAULT NULL, comp_nom VARCHAR(200) NOT NULL, comp_type VARCHAR(100) NOT NULL, comp_prix_unitaire NUMERIC(6, 2) NOT NULL, INDEX IDX_EC8486C982E6D09 (fami_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_stock (composant_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_B8CB81A7F3310E7 (composant_id), INDEX IDX_B8CB81ADCD6110 (stock_id), PRIMARY KEY(composant_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_module (id INT AUTO_INCREMENT NOT NULL, modu_id INT NOT NULL, comp_id INT NOT NULL, como_quantite INT NOT NULL, INDEX IDX_BCB404E427FCD2D5 (modu_id), INDEX IDX_BCB404E44D0D3BCB (comp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, four_id INT NOT NULL, pers_sexe VARCHAR(5) NOT NULL, pers_nom VARCHAR(50) NOT NULL, pers_prenom VARCHAR(50) NOT NULL, pers_mail VARCHAR(200) NOT NULL, pers_tel VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_4C62E638E5AC00A4 (four_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couverture (id INT AUTO_INCREMENT NOT NULL, couv_nom VARCHAR(200) NOT NULL, couv_description VARCHAR(500) NOT NULL, couv_prix_unitaire NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, mais_id INT NOT NULL, etap_id INT NOT NULL, etat_id INT NOT NULL, adre_id INT NOT NULL, gamm_id INT DEFAULT NULL, comm_id INT NOT NULL, clie_id INT NOT NULL, devi_nom VARCHAR(100) NOT NULL, devi_date DATETIME NOT NULL, devi_prix DOUBLE PRECISION NOT NULL, devi_dossier_estimatif LONGBLOB DEFAULT NULL, devi_dossier_technique LONGBLOB DEFAULT NULL, INDEX IDX_8B27C52BC00D28C8 (mais_id), INDEX IDX_8B27C52B823C11A8 (etap_id), INDEX IDX_8B27C52BD5E86FF (etat_id), UNIQUE INDEX UNIQ_8B27C52B35227DDF (adre_id), INDEX IDX_8B27C52B213BF1EA (gamm_id), INDEX IDX_8B27C52BEF7EB489 (comm_id), INDEX IDX_8B27C52B59DE4808 (clie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_module (devis_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_3031E1E441DEFADA (devis_id), INDEX IDX_3031E1E4AFC2B591 (module_id), PRIMARY KEY(devis_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (id INT AUTO_INCREMENT NOT NULL, etap_nom VARCHAR(100) NOT NULL, etap_valeur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, etat_nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille_composant (id INT AUTO_INCREMENT NOT NULL, faco_nom VARCHAR(100) NOT NULL, faco_description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition_exterieur (id INT AUTO_INCREMENT NOT NULL, fiex_nom VARCHAR(200) NOT NULL, fiex_description VARCHAR(500) NOT NULL, fiex_prix_unitaire NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition_interieur (id INT AUTO_INCREMENT NOT NULL, fiin_nom VARCHAR(200) NOT NULL, fiin_description VARCHAR(500) NOT NULL, fiin_prix_unitaire NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, four_nom VARCHAR(50) NOT NULL, four_mail VARCHAR(100) NOT NULL, four_tel VARCHAR(10) NOT NULL, four_siret VARCHAR(14) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur_composant (fournisseur_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_114ECAAC670C757F (fournisseur_id), INDEX IDX_114ECAAC7F3310E7 (composant_id), PRIMARY KEY(fournisseur_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gamme (id INT AUTO_INCREMENT NOT NULL, isol_id INT NOT NULL, fiex_id INT NOT NULL, fiin_id INT NOT NULL, couv_id INT NOT NULL, huis_id INT NOT NULL, gamm_nom VARCHAR(100) NOT NULL, INDEX IDX_C32E1468FD661D22 (isol_id), INDEX IDX_C32E14683CA8945F (fiex_id), INDEX IDX_C32E14688C2A711D (fiin_id), INDEX IDX_C32E146838F6B854 (couv_id), INDEX IDX_C32E1468A7247E2 (huis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE huisseries (id INT AUTO_INCREMENT NOT NULL, huis_nom VARCHAR(200) NOT NULL, huis_description VARCHAR(500) NOT NULL, huis_prix_unitaire NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE isolant (id INT AUTO_INCREMENT NOT NULL, isol_nom VARCHAR(200) NOT NULL, isol_description VARCHAR(500) NOT NULL, isol_prix_unitaire NUMERIC(6, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, mais_nom VARCHAR(100) NOT NULL, mais_prix DOUBLE PRECISION NOT NULL, mais_piece INT NOT NULL, mais_chambre INT NOT NULL, mais_description LONGTEXT NOT NULL, mais_catalogue LONGBLOB DEFAULT NULL, mais_cdp LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, devi_id INT DEFAULT NULL, cctp_id INT NOT NULL, fiex_id INT DEFAULT NULL, fiin_id INT DEFAULT NULL, couv_id INT DEFAULT NULL, isol_id INT DEFAULT NULL, modu_nom VARCHAR(100) NOT NULL, modu_prix_unitaire DOUBLE PRECISION DEFAULT NULL, INDEX IDX_C242628131098A5 (devi_id), INDEX IDX_C242628573F0E43 (cctp_id), INDEX IDX_C2426283CA8945F (fiex_id), INDEX IDX_C2426288C2A711D (fiin_id), INDEX IDX_C24262838F6B854 (couv_id), INDEX IDX_C242628FD661D22 (isol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_caracteristique (module_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_2CF51901AFC2B591 (module_id), INDEX IDX_2CF519011704EEB7 (caracteristique_id), PRIMARY KEY(module_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_composant (module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_B6E59901AFC2B591 (module_id), INDEX IDX_B6E599017F3310E7 (composant_id), PRIMARY KEY(module_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre (id INT AUTO_INCREMENT NOT NULL, param_pourcentage NUMERIC(4, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, pays_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, stoc_quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045535227DDF FOREIGN KEY (adre_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C982E6D09 FOREIGN KEY (fami_id) REFERENCES famille_composant (id)');
        $this->addSql('ALTER TABLE composant_stock ADD CONSTRAINT FK_B8CB81A7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_stock ADD CONSTRAINT FK_B8CB81ADCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module ADD CONSTRAINT FK_BCB404E427FCD2D5 FOREIGN KEY (modu_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE composant_module ADD CONSTRAINT FK_BCB404E44D0D3BCB FOREIGN KEY (comp_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638E5AC00A4 FOREIGN KEY (four_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC00D28C8 FOREIGN KEY (mais_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B823C11A8 FOREIGN KEY (etap_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B35227DDF FOREIGN KEY (adre_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B213BF1EA FOREIGN KEY (gamm_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BEF7EB489 FOREIGN KEY (comm_id) REFERENCES commercial (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B59DE4808 FOREIGN KEY (clie_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE devis_module ADD CONSTRAINT FK_3031E1E441DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_module ADD CONSTRAINT FK_3031E1E4AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_composant ADD CONSTRAINT FK_114ECAAC670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_composant ADD CONSTRAINT FK_114ECAAC7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468FD661D22 FOREIGN KEY (isol_id) REFERENCES isolant (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E14683CA8945F FOREIGN KEY (fiex_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E14688C2A711D FOREIGN KEY (fiin_id) REFERENCES finition_interieur (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E146838F6B854 FOREIGN KEY (couv_id) REFERENCES couverture (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468A7247E2 FOREIGN KEY (huis_id) REFERENCES huisseries (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628131098A5 FOREIGN KEY (devi_id) REFERENCES devis (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628573F0E43 FOREIGN KEY (cctp_id) REFERENCES cctp (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426283CA8945F FOREIGN KEY (fiex_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426288C2A711D FOREIGN KEY (fiin_id) REFERENCES finition_interieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262838F6B854 FOREIGN KEY (couv_id) REFERENCES couverture (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628FD661D22 FOREIGN KEY (isol_id) REFERENCES isolant (id)');
        $this->addSql('ALTER TABLE module_caracteristique ADD CONSTRAINT FK_2CF51901AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_caracteristique ADD CONSTRAINT FK_2CF519011704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E59901AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E599017F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045535227DDF');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B35227DDF');
        $this->addSql('ALTER TABLE module_caracteristique DROP FOREIGN KEY FK_2CF519011704EEB7');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628573F0E43');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B59DE4808');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BEF7EB489');
        $this->addSql('ALTER TABLE composant_stock DROP FOREIGN KEY FK_B8CB81A7F3310E7');
        $this->addSql('ALTER TABLE composant_module DROP FOREIGN KEY FK_BCB404E44D0D3BCB');
        $this->addSql('ALTER TABLE fournisseur_composant DROP FOREIGN KEY FK_114ECAAC7F3310E7');
        $this->addSql('ALTER TABLE module_composant DROP FOREIGN KEY FK_B6E599017F3310E7');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E146838F6B854');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262838F6B854');
        $this->addSql('ALTER TABLE devis_module DROP FOREIGN KEY FK_3031E1E441DEFADA');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628131098A5');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B823C11A8');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BD5E86FF');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C982E6D09');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E14683CA8945F');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426283CA8945F');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E14688C2A711D');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426288C2A711D');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638E5AC00A4');
        $this->addSql('ALTER TABLE fournisseur_composant DROP FOREIGN KEY FK_114ECAAC670C757F');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B213BF1EA');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468A7247E2');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468FD661D22');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628FD661D22');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC00D28C8');
        $this->addSql('ALTER TABLE composant_module DROP FOREIGN KEY FK_BCB404E427FCD2D5');
        $this->addSql('ALTER TABLE devis_module DROP FOREIGN KEY FK_3031E1E4AFC2B591');
        $this->addSql('ALTER TABLE module_caracteristique DROP FOREIGN KEY FK_2CF51901AFC2B591');
        $this->addSql('ALTER TABLE module_composant DROP FOREIGN KEY FK_B6E59901AFC2B591');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A6E44244');
        $this->addSql('ALTER TABLE composant_stock DROP FOREIGN KEY FK_B8CB81ADCD6110');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE caracteristique');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('DROP TABLE cctp');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commercial');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE composant_stock');
        $this->addSql('DROP TABLE composant_module');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE couverture');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE devis_module');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE famille_composant');
        $this->addSql('DROP TABLE finition_exterieur');
        $this->addSql('DROP TABLE finition_interieur');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournisseur_composant');
        $this->addSql('DROP TABLE gamme');
        $this->addSql('DROP TABLE huisseries');
        $this->addSql('DROP TABLE isolant');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE module_caracteristique');
        $this->addSql('DROP TABLE module_composant');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE stock');
    }
}
