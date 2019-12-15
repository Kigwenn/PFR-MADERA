<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191215134906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BDC0B524A');
        $this->addSql('CREATE TABLE composant_fournisseur (composant_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_996BE157F3310E7 (composant_id), INDEX IDX_996BE15670C757F (fournisseur_id), PRIMARY KEY(composant_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_module_module (composant_module_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_2B8A5E4F60CA0F61 (composant_module_id), INDEX IDX_2B8A5E4FAFC2B591 (module_id), PRIMARY KEY(composant_module_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_module_composant (composant_module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_7794265A60CA0F61 (composant_module_id), INDEX IDX_7794265A7F3310E7 (composant_id), PRIMARY KEY(composant_module_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, four_id_id INT NOT NULL, pers_sexe VARCHAR(5) NOT NULL, pers_nom VARCHAR(50) NOT NULL, pers_prenom VARCHAR(50) NOT NULL, pers_mail VARCHAR(200) NOT NULL, pers_tel VARCHAR(10) NOT NULL, UNIQUE INDEX UNIQ_4C62E6386750DFAA (four_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE couverture (id INT AUTO_INCREMENT NOT NULL, couv_nom VARCHAR(200) NOT NULL, couv_description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat (id INT AUTO_INCREMENT NOT NULL, etat_nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition_exterieur (id INT AUTO_INCREMENT NOT NULL, finex_nom VARCHAR(200) NOT NULL, finex_description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE finition_interieur (id INT AUTO_INCREMENT NOT NULL, finin_nom VARCHAR(200) NOT NULL, finin_description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur_composant (fournisseur_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_114ECAAC670C757F (fournisseur_id), INDEX IDX_114ECAAC7F3310E7 (composant_id), PRIMARY KEY(fournisseur_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, pays_nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remplissage (id INT AUTO_INCREMENT NOT NULL, remp_nom VARCHAR(200) NOT NULL, remp_description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composant_fournisseur ADD CONSTRAINT FK_996BE157F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_fournisseur ADD CONSTRAINT FK_996BE15670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_module ADD CONSTRAINT FK_2B8A5E4F60CA0F61 FOREIGN KEY (composant_module_id) REFERENCES composant_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_module ADD CONSTRAINT FK_2B8A5E4FAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_composant ADD CONSTRAINT FK_7794265A60CA0F61 FOREIGN KEY (composant_module_id) REFERENCES composant_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_composant ADD CONSTRAINT FK_7794265A7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6386750DFAA FOREIGN KEY (four_id_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE fournisseur_composant ADD CONSTRAINT FK_114ECAAC670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_composant ADD CONSTRAINT FK_114ECAAC7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE contact_fournisseur');
        $this->addSql('DROP TABLE doc_maison');
        $this->addSql('DROP TABLE etat_devis');
        $this->addSql('DROP TABLE maison_catalogue');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816670C757F');
        $this->addSql('DROP INDEX IDX_C35F0816670C757F ON adresse');
        $this->addSql('ALTER TABLE adresse ADD pays_id_id INT NOT NULL, ADD adre_rue VARCHAR(200) NOT NULL, ADD adre_ville VARCHAR(200) NOT NULL, ADD adre_region VARCHAR(200) NOT NULL, ADD adre_complement VARCHAR(255) DEFAULT NULL, ADD adre_info VARCHAR(255) DEFAULT NULL, DROP fournisseur_id, DROP rue_adresse, DROP ville_adresse, DROP region_adresse, DROP pays, DROP complement_adresse, DROP info_complementaire, CHANGE cp_adresse adre_cp VARCHAR(5) NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081674FAEB6C FOREIGN KEY (pays_id_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_C35F081674FAEB6C ON adresse (pays_id_id)');
        $this->addSql('ALTER TABLE caracteristique ADD cara_section DOUBLE PRECISION NOT NULL, ADD cara_hauteur DOUBLE PRECISION NOT NULL, ADD cara_longueur DOUBLE PRECISION NOT NULL, ADD cara_type_angle VARCHAR(15) NOT NULL, ADD cara_degre_angle DOUBLE PRECISION NOT NULL, DROP nom_caracteristique, DROP largeur_caracteristique, DROP hauteur_caracteristique, DROP epaisseur_caracteristique, DROP poids_caracteristique');
        $this->addSql('ALTER TABLE catalogue CHANGE nom_catalogue cata_nom VARCHAR(100) NOT NULL, CHANGE desc_catalogue cata_description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE cctp CHANGE nom_cctp cctp_nom VARCHAR(255) NOT NULL, CHANGE image_cctp cctp_image LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE personne ADD pers_nom VARCHAR(50) NOT NULL, ADD pers_prenom VARCHAR(50) NOT NULL, DROP nom_personne, DROP prenom_personne, CHANGE sexe_personne pers_sexe VARCHAR(5) NOT NULL, CHANGE mail_personne pers_mail VARCHAR(200) NOT NULL, CHANGE tel_personne pers_tel VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455E86D5C8B');
        $this->addSql('DROP INDEX UNIQ_C7440455E86D5C8B ON client');
        $this->addSql('ALTER TABLE client ADD pers_sexe VARCHAR(5) NOT NULL, ADD pers_nom VARCHAR(50) NOT NULL, ADD pers_prenom VARCHAR(50) NOT NULL, ADD pers_mail VARCHAR(200) NOT NULL, ADD pers_tel VARCHAR(10) NOT NULL, CHANGE id_adresse_id adre_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455AF65F157 FOREIGN KEY (adre_id_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455AF65F157 ON client (adre_id_id)');
        $this->addSql('ALTER TABLE commercial ADD pers_sexe VARCHAR(5) NOT NULL, ADD pers_prenom VARCHAR(50) NOT NULL, ADD pers_mail VARCHAR(200) NOT NULL, ADD pers_tel VARCHAR(10) NOT NULL, ADD comm_mdp VARCHAR(50) NOT NULL, CHANGE mot_de_passe pers_nom VARCHAR(50) NOT NULL, CHANGE token comm_token VARCHAR(64) NOT NULL, CHANGE token_date comm_token_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C916523276');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C9A5655F89');
        $this->addSql('DROP INDEX IDX_EC8486C916523276 ON composant');
        $this->addSql('DROP INDEX IDX_EC8486C9A5655F89 ON composant');
        $this->addSql('ALTER TABLE composant DROP fournisseur_composant_id, CHANGE famille_composant_id fami_id_id INT DEFAULT NULL, CHANGE nom_composant comp_nom VARCHAR(200) NOT NULL, CHANGE prix_composant comp_prix DOUBLE PRECISION NOT NULL, CHANGE type_composant comp_type VARCHAR(100) NOT NULL, CHANGE unite_usage comp_unite_usage NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C96515E692 FOREIGN KEY (fami_id_id) REFERENCES famille_composant (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C96515E692 ON composant (fami_id_id)');
        $this->addSql('ALTER TABLE composant_module CHANGE quantite como_quantite INT NOT NULL');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B50849825');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B82266964');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B99DED506');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC67CD679');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BE86D5C8B');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BECB412D5');
        $this->addSql('DROP INDEX IDX_8B27C52B99DED506 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B82266964 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B50849825 ON devis');
        $this->addSql('DROP INDEX UNIQ_8B27C52BE86D5C8B ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BC67CD679 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BDC0B524A ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BECB412D5 ON devis');
        $this->addSql('ALTER TABLE devis ADD mais_id_id INT NOT NULL, ADD etap_id_id INT NOT NULL, ADD etat_id_id INT NOT NULL, ADD adre_id_id INT NOT NULL, ADD comm_id_id INT NOT NULL, ADD clie_id_id INT NOT NULL, ADD devi_dossier_estimatif LONGBLOB DEFAULT NULL, ADD devi_dossier_technique LONGBLOB DEFAULT NULL, DROP devis_maison_id, DROP etape_devis_id, DROP etat_devis_id, DROP id_adresse_id, DROP id_commercial_id, DROP id_client_id, DROP stockage_devis, DROP dossier_technique, CHANGE id_gamme_id gamm_id_id INT DEFAULT NULL, CHANGE nom_devis devi_nom VARCHAR(100) NOT NULL, CHANGE date_devis devi_date DATETIME NOT NULL, CHANGE prix_total devi_prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BDA11D01F FOREIGN KEY (mais_id_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BCD9C96FD FOREIGN KEY (etap_id_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B39D3B2EE FOREIGN KEY (etat_id_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BAF65F157 FOREIGN KEY (adre_id_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B7E98A9BF FOREIGN KEY (gamm_id_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBFB1D257 FOREIGN KEY (comm_id_id) REFERENCES commercial (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B3199AE0F FOREIGN KEY (clie_id_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BDA11D01F ON devis (mais_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BCD9C96FD ON devis (etap_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B39D3B2EE ON devis (etat_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B27C52BAF65F157 ON devis (adre_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B7E98A9BF ON devis (gamm_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BBFB1D257 ON devis (comm_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B3199AE0F ON devis (clie_id_id)');
        $this->addSql('ALTER TABLE etape CHANGE nom_etape_devis etap_nom VARCHAR(100) NOT NULL, CHANGE valeur_base_etape etap_valeur INT NOT NULL');
        $this->addSql('ALTER TABLE famille_composant CHANGE nom faco_nom VARCHAR(100) NOT NULL, CHANGE description faco_description VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE fournisseur DROP nom_contact_fournisseur, CHANGE nom_fournisseur four_nom VARCHAR(50) NOT NULL, CHANGE mail_fournisseur four_mail VARCHAR(100) NOT NULL, CHANGE tel_fournisseur four_tel VARCHAR(10) NOT NULL, CHANGE siret four_siret VARCHAR(14) NOT NULL');
        $this->addSql('ALTER TABLE gamme ADD remp_id_id INT NOT NULL, ADD finex_id_id INT NOT NULL, ADD couv_id_id INT NOT NULL, ADD huis_id_id INT NOT NULL, CHANGE nom_gamme gamm_nom VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468E4FA4F11 FOREIGN KEY (remp_id_id) REFERENCES remplissage (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E146869877BE0 FOREIGN KEY (finex_id_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468753630FD FOREIGN KEY (couv_id_id) REFERENCES couverture (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468CD140826 FOREIGN KEY (huis_id_id) REFERENCES huisseries (id)');
        $this->addSql('CREATE INDEX IDX_C32E1468E4FA4F11 ON gamme (remp_id_id)');
        $this->addSql('CREATE INDEX IDX_C32E146869877BE0 ON gamme (finex_id_id)');
        $this->addSql('CREATE INDEX IDX_C32E1468753630FD ON gamme (couv_id_id)');
        $this->addSql('CREATE INDEX IDX_C32E1468CD140826 ON gamme (huis_id_id)');
        $this->addSql('ALTER TABLE huisseries ADD huis_prix_unitaire NUMERIC(6, 2) NOT NULL, ADD huis_prix DOUBLE PRECISION NOT NULL, CHANGE nom huis_nom VARCHAR(200) NOT NULL, CHANGE description huis_description VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE maison ADD mais_piece INT NOT NULL, ADD mais_chambre INT NOT NULL, ADD mais_catalogue LONGBLOB DEFAULT NULL, ADD mais_cdp LONGBLOB DEFAULT NULL, DROP nb_pieces, DROP nb_chambres, DROP coupe_principe, DROP catalogue, CHANGE nom_maison mais_nom VARCHAR(100) NOT NULL, CHANGE prix_maison mais_prix DOUBLE PRECISION NOT NULL, CHANGE desc_maison mais_description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262889A2A733');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628C04BB607');
        $this->addSql('DROP INDEX IDX_C242628C04BB607 ON module');
        $this->addSql('DROP INDEX IDX_C24262889A2A733 ON module');
        $this->addSql('ALTER TABLE module ADD gamm_id_id INT NOT NULL, ADD cctp_id_id INT NOT NULL, ADD remp_id_id INT NOT NULL, ADD finex_id_id INT NOT NULL, ADD finin_id_id INT NOT NULL, ADD couv_id_id INT NOT NULL, DROP gamme_module_id, DROP id_cctp_id, CHANGE nom_module modu_nom VARCHAR(100) NOT NULL, CHANGE prix_module modu_prix_unitaire DOUBLE PRECISION NOT NULL, CHANGE id_devis devi_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426287E98A9BF FOREIGN KEY (gamm_id_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426283C78F64D FOREIGN KEY (cctp_id_id) REFERENCES cctp (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628E4FA4F11 FOREIGN KEY (remp_id_id) REFERENCES remplissage (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262869877BE0 FOREIGN KEY (finex_id_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426283A26C75B FOREIGN KEY (finin_id_id) REFERENCES finition_interieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628753630FD FOREIGN KEY (couv_id_id) REFERENCES couverture (id)');
        $this->addSql('CREATE INDEX IDX_C2426287E98A9BF ON module (gamm_id_id)');
        $this->addSql('CREATE INDEX IDX_C2426283C78F64D ON module (cctp_id_id)');
        $this->addSql('CREATE INDEX IDX_C242628E4FA4F11 ON module (remp_id_id)');
        $this->addSql('CREATE INDEX IDX_C24262869877BE0 ON module (finex_id_id)');
        $this->addSql('CREATE INDEX IDX_C2426283A26C75B ON module (finin_id_id)');
        $this->addSql('CREATE INDEX IDX_C242628753630FD ON module (couv_id_id)');
        $this->addSql('ALTER TABLE parametre CHANGE pourcentage param_pourcentage NUMERIC(4, 2) NOT NULL');
        $this->addSql('ALTER TABLE stock CHANGE quantite stoc_quantite INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468753630FD');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628753630FD');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B39D3B2EE');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E146869877BE0');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262869877BE0');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426283A26C75B');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081674FAEB6C');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468E4FA4F11');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628E4FA4F11');
        $this->addSql('CREATE TABLE contact_fournisseur (id INT AUTO_INCREMENT NOT NULL, id_fournisseur_id INT NOT NULL, UNIQUE INDEX UNIQ_5832758C5A6AC879 (id_fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE doc_maison (id INT AUTO_INCREMENT NOT NULL, maison_id INT NOT NULL, data_doc LONGBLOB NOT NULL, INDEX IDX_7B6BABC19D67D8AF (maison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE etat_devis (id INT AUTO_INCREMENT NOT NULL, nom_etat VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maison_catalogue (maison_id INT NOT NULL, catalogue_id INT NOT NULL, INDEX IDX_AD14647A4A7843DC (catalogue_id), INDEX IDX_AD14647A9D67D8AF (maison_id), PRIMARY KEY(maison_id, catalogue_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE contact_fournisseur ADD CONSTRAINT FK_5832758C5A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE doc_maison ADD CONSTRAINT FK_7B6BABC19D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE maison_catalogue ADD CONSTRAINT FK_AD14647A4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_catalogue ADD CONSTRAINT FK_AD14647A9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE composant_fournisseur');
        $this->addSql('DROP TABLE composant_module_module');
        $this->addSql('DROP TABLE composant_module_composant');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE couverture');
        $this->addSql('DROP TABLE etat');
        $this->addSql('DROP TABLE finition_exterieur');
        $this->addSql('DROP TABLE finition_interieur');
        $this->addSql('DROP TABLE fournisseur_composant');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE remplissage');
        $this->addSql('DROP INDEX IDX_C35F081674FAEB6C ON adresse');
        $this->addSql('ALTER TABLE adresse ADD fournisseur_id INT DEFAULT NULL, ADD rue_adresse VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_adresse VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, ADD region_adresse VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, ADD pays VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, ADD complement_adresse VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, ADD info_complementaire VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP pays_id_id, DROP adre_rue, DROP adre_ville, DROP adre_region, DROP adre_complement, DROP adre_info, CHANGE adre_cp cp_adresse VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816670C757F ON adresse (fournisseur_id)');
        $this->addSql('ALTER TABLE caracteristique ADD nom_caracteristique VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, ADD largeur_caracteristique DOUBLE PRECISION NOT NULL, ADD hauteur_caracteristique DOUBLE PRECISION NOT NULL, ADD epaisseur_caracteristique DOUBLE PRECISION NOT NULL, ADD poids_caracteristique DOUBLE PRECISION NOT NULL, DROP cara_section, DROP cara_hauteur, DROP cara_longueur, DROP cara_type_angle, DROP cara_degre_angle');
        $this->addSql('ALTER TABLE catalogue CHANGE cata_nom nom_catalogue VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cata_description desc_catalogue LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE cctp CHANGE cctp_nom nom_cctp VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE cctp_image image_cctp LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455AF65F157');
        $this->addSql('DROP INDEX UNIQ_C7440455AF65F157 ON client');
        $this->addSql('ALTER TABLE client DROP pers_sexe, DROP pers_nom, DROP pers_prenom, DROP pers_mail, DROP pers_tel, CHANGE adre_id_id id_adresse_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455E86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E86D5C8B ON client (id_adresse_id)');
        $this->addSql('ALTER TABLE commercial ADD mot_de_passe VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, DROP pers_sexe, DROP pers_nom, DROP pers_prenom, DROP pers_mail, DROP pers_tel, DROP comm_mdp, CHANGE comm_token token VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE comm_token_date token_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C96515E692');
        $this->addSql('DROP INDEX IDX_EC8486C96515E692 ON composant');
        $this->addSql('ALTER TABLE composant ADD fournisseur_composant_id INT NOT NULL, CHANGE fami_id_id famille_composant_id INT DEFAULT NULL, CHANGE comp_nom nom_composant VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE comp_prix prix_composant DOUBLE PRECISION NOT NULL, CHANGE comp_type type_composant VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE comp_unite_usage unite_usage NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C916523276 FOREIGN KEY (fournisseur_composant_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C9A5655F89 FOREIGN KEY (famille_composant_id) REFERENCES famille_composant (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C916523276 ON composant (fournisseur_composant_id)');
        $this->addSql('CREATE INDEX IDX_EC8486C9A5655F89 ON composant (famille_composant_id)');
        $this->addSql('ALTER TABLE composant_module CHANGE como_quantite quantite INT NOT NULL');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BDA11D01F');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BCD9C96FD');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BAF65F157');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B7E98A9BF');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBFB1D257');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B3199AE0F');
        $this->addSql('DROP INDEX IDX_8B27C52BDA11D01F ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BCD9C96FD ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B39D3B2EE ON devis');
        $this->addSql('DROP INDEX UNIQ_8B27C52BAF65F157 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B7E98A9BF ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BBFB1D257 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B3199AE0F ON devis');
        $this->addSql('ALTER TABLE devis ADD devis_maison_id INT NOT NULL, ADD etape_devis_id INT NOT NULL, ADD etat_devis_id INT NOT NULL, ADD id_adresse_id INT NOT NULL, ADD id_commercial_id INT NOT NULL, ADD id_client_id INT NOT NULL, ADD stockage_devis LONGBLOB DEFAULT NULL, ADD dossier_technique LONGBLOB DEFAULT NULL, DROP mais_id_id, DROP etap_id_id, DROP etat_id_id, DROP adre_id_id, DROP comm_id_id, DROP clie_id_id, DROP devi_dossier_estimatif, DROP devi_dossier_technique, CHANGE gamm_id_id id_gamme_id INT DEFAULT NULL, CHANGE devi_nom nom_devis VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE devi_date date_devis DATETIME NOT NULL, CHANGE devi_prix prix_total DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B50849825 FOREIGN KEY (etape_devis_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B82266964 FOREIGN KEY (id_gamme_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC67CD679 FOREIGN KEY (id_commercial_id) REFERENCES commercial (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BDC0B524A FOREIGN KEY (etat_devis_id) REFERENCES etat_devis (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BECB412D5 FOREIGN KEY (devis_maison_id) REFERENCES maison (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B99DED506 ON devis (id_client_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B82266964 ON devis (id_gamme_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B50849825 ON devis (etape_devis_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B27C52BE86D5C8B ON devis (id_adresse_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BC67CD679 ON devis (id_commercial_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BDC0B524A ON devis (etat_devis_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BECB412D5 ON devis (devis_maison_id)');
        $this->addSql('ALTER TABLE etape CHANGE etap_nom nom_etape_devis VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE etap_valeur valeur_base_etape INT NOT NULL');
        $this->addSql('ALTER TABLE famille_composant CHANGE faco_nom nom VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE faco_description description VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE fournisseur ADD nom_contact_fournisseur VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE four_nom nom_fournisseur VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE four_mail mail_fournisseur VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE four_tel tel_fournisseur VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE four_siret siret VARCHAR(14) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468CD140826');
        $this->addSql('DROP INDEX IDX_C32E1468E4FA4F11 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E146869877BE0 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E1468753630FD ON gamme');
        $this->addSql('DROP INDEX IDX_C32E1468CD140826 ON gamme');
        $this->addSql('ALTER TABLE gamme DROP remp_id_id, DROP finex_id_id, DROP couv_id_id, DROP huis_id_id, CHANGE gamm_nom nom_gamme VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE huisseries DROP huis_prix_unitaire, DROP huis_prix, CHANGE huis_nom nom VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE huis_description description VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE maison ADD nb_pieces INT NOT NULL, ADD nb_chambres INT NOT NULL, ADD coupe_principe LONGBLOB DEFAULT NULL, ADD catalogue LONGBLOB DEFAULT NULL, DROP mais_piece, DROP mais_chambre, DROP mais_catalogue, DROP mais_cdp, CHANGE mais_nom nom_maison VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE mais_prix prix_maison DOUBLE PRECISION NOT NULL, CHANGE mais_description desc_maison LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426287E98A9BF');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426283C78F64D');
        $this->addSql('DROP INDEX IDX_C2426287E98A9BF ON module');
        $this->addSql('DROP INDEX IDX_C2426283C78F64D ON module');
        $this->addSql('DROP INDEX IDX_C242628E4FA4F11 ON module');
        $this->addSql('DROP INDEX IDX_C24262869877BE0 ON module');
        $this->addSql('DROP INDEX IDX_C2426283A26C75B ON module');
        $this->addSql('DROP INDEX IDX_C242628753630FD ON module');
        $this->addSql('ALTER TABLE module ADD gamme_module_id INT NOT NULL, ADD id_cctp_id INT NOT NULL, DROP gamm_id_id, DROP cctp_id_id, DROP remp_id_id, DROP finex_id_id, DROP finin_id_id, DROP couv_id_id, CHANGE modu_nom nom_module VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE modu_prix_unitaire prix_module DOUBLE PRECISION NOT NULL, CHANGE devi_id id_devis INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262889A2A733 FOREIGN KEY (id_cctp_id) REFERENCES cctp (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628C04BB607 FOREIGN KEY (gamme_module_id) REFERENCES gamme (id)');
        $this->addSql('CREATE INDEX IDX_C242628C04BB607 ON module (gamme_module_id)');
        $this->addSql('CREATE INDEX IDX_C24262889A2A733 ON module (id_cctp_id)');
        $this->addSql('ALTER TABLE parametre CHANGE param_pourcentage pourcentage NUMERIC(4, 2) NOT NULL');
        $this->addSql('ALTER TABLE personne ADD nom_personne VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, ADD prenom_personne VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, DROP pers_nom, DROP pers_prenom, CHANGE pers_sexe sexe_personne VARCHAR(5) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pers_mail mail_personne VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pers_tel tel_personne VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE stock CHANGE stoc_quantite quantite INT NOT NULL');
    }
}
