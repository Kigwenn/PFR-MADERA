<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191201175742 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE composant_commande DROP FOREIGN KEY FK_DCC5CF4B82EA2E54');
        $this->addSql('CREATE TABLE cctp (id INT AUTO_INCREMENT NOT NULL, nom_cctp VARCHAR(255) NOT NULL, image_cctp LONGBLOB NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, id_adresse_id INT NOT NULL, UNIQUE INDEX UNIQ_C7440455E86D5C8B (id_adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commercial (id INT AUTO_INCREMENT NOT NULL, mot_de_passe VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_module (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_fournisseur (id INT AUTO_INCREMENT NOT NULL, id_fournisseur_id INT NOT NULL, UNIQUE INDEX UNIQ_5832758C5A6AC879 (id_fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille_composant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE huisseries (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, description VARCHAR(500) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parametre (id INT AUTO_INCREMENT NOT NULL, pourcentage NUMERIC(4, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, sexe_personne VARCHAR(5) NOT NULL, nom_personne VARCHAR(50) NOT NULL, prenom_personne VARCHAR(50) NOT NULL, mail_personne VARCHAR(200) NOT NULL, tel_personne VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455E86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE contact_fournisseur ADD CONSTRAINT FK_5832758C5A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE composant_commande');
        $this->addSql('DROP TABLE devis_etape');
        $this->addSql('DROP TABLE devis_etat_devis');
        $this->addSql('DROP TABLE maison_module');
        $this->addSql('DROP TABLE module_composant');
        $this->addSql('ALTER TABLE adresse ADD pays VARCHAR(200) NOT NULL, ADD complement_adresse VARCHAR(255) DEFAULT NULL, ADD info_complementaire VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE composant ADD famille_composant_id INT DEFAULT NULL, ADD modules_id INT DEFAULT NULL, ADD unite_usage NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C9A5655F89 FOREIGN KEY (famille_composant_id) REFERENCES famille_composant (id)');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C960D6DC42 FOREIGN KEY (modules_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C9A5655F89 ON composant (famille_composant_id)');
        $this->addSql('CREATE INDEX IDX_EC8486C960D6DC42 ON composant (modules_id)');
        $this->addSql('ALTER TABLE devis ADD etape_devis_id INT NOT NULL, ADD etat_devis_id INT NOT NULL, ADD id_adresse_id INT NOT NULL, ADD id_gamme_id INT DEFAULT NULL, ADD id_commercial_id INT NOT NULL, ADD stockage_devis LONGBLOB DEFAULT NULL, ADD dossier_technique LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B50849825 FOREIGN KEY (etape_devis_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BDC0B524A FOREIGN KEY (etat_devis_id) REFERENCES etat_devis (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BE86D5C8B FOREIGN KEY (id_adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B82266964 FOREIGN KEY (id_gamme_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC67CD679 FOREIGN KEY (id_commercial_id) REFERENCES commercial (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B50849825 ON devis (etape_devis_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BDC0B524A ON devis (etat_devis_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B27C52BE86D5C8B ON devis (id_adresse_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B82266964 ON devis (id_gamme_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BC67CD679 ON devis (id_commercial_id)');
        $this->addSql('ALTER TABLE maison ADD coupe_principe LONGBLOB DEFAULT NULL, ADD catalogue LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD id_cctp_id INT NOT NULL, ADD composants_id INT DEFAULT NULL, ADD id_devis INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262889A2A733 FOREIGN KEY (id_cctp_id) REFERENCES cctp (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628D960F9EE FOREIGN KEY (composants_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_C24262889A2A733 ON module (id_cctp_id)');
        $this->addSql('CREATE INDEX IDX_C242628D960F9EE ON module (composants_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262889A2A733');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC67CD679');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C960D6DC42');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628D960F9EE');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C9A5655F89');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom_commande VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, prix_commande DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_commande (composant_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_DCC5CF4B7F3310E7 (composant_id), INDEX IDX_DCC5CF4B82EA2E54 (commande_id), PRIMARY KEY(composant_id, commande_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE devis_etape (devis_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_3E7C68F941DEFADA (devis_id), INDEX IDX_3E7C68F94A8CA2AD (etape_id), PRIMARY KEY(devis_id, etape_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE devis_etat_devis (devis_id INT NOT NULL, etat_devis_id INT NOT NULL, INDEX IDX_7D11A27A41DEFADA (devis_id), INDEX IDX_7D11A27ADC0B524A (etat_devis_id), PRIMARY KEY(devis_id, etat_devis_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maison_module (maison_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_ED7BA8CA9D67D8AF (maison_id), INDEX IDX_ED7BA8CAAFC2B591 (module_id), PRIMARY KEY(maison_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE module_composant (module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_B6E59901AFC2B591 (module_id), INDEX IDX_B6E599017F3310E7 (composant_id), PRIMARY KEY(module_id, composant_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE composant_commande ADD CONSTRAINT FK_DCC5CF4B7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_commande ADD CONSTRAINT FK_DCC5CF4B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etape ADD CONSTRAINT FK_3E7C68F941DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etape ADD CONSTRAINT FK_3E7C68F94A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etat_devis ADD CONSTRAINT FK_7D11A27A41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etat_devis ADD CONSTRAINT FK_7D11A27ADC0B524A FOREIGN KEY (etat_devis_id) REFERENCES etat_devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_module ADD CONSTRAINT FK_ED7BA8CA9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_module ADD CONSTRAINT FK_ED7BA8CAAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E599017F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E59901AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE cctp');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commercial');
        $this->addSql('DROP TABLE composant_module');
        $this->addSql('DROP TABLE contact_fournisseur');
        $this->addSql('DROP TABLE famille_composant');
        $this->addSql('DROP TABLE huisseries');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE personne');
        $this->addSql('ALTER TABLE adresse DROP pays, DROP complement_adresse, DROP info_complementaire');
        $this->addSql('DROP INDEX IDX_EC8486C9A5655F89 ON composant');
        $this->addSql('DROP INDEX IDX_EC8486C960D6DC42 ON composant');
        $this->addSql('ALTER TABLE composant DROP famille_composant_id, DROP modules_id, DROP unite_usage');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B50849825');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BDC0B524A');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BE86D5C8B');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B82266964');
        $this->addSql('DROP INDEX IDX_8B27C52B50849825 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BDC0B524A ON devis');
        $this->addSql('DROP INDEX UNIQ_8B27C52BE86D5C8B ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B82266964 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BC67CD679 ON devis');
        $this->addSql('ALTER TABLE devis DROP etape_devis_id, DROP etat_devis_id, DROP id_adresse_id, DROP id_gamme_id, DROP id_commercial_id, DROP stockage_devis, DROP dossier_technique');
        $this->addSql('ALTER TABLE maison DROP coupe_principe, DROP catalogue');
        $this->addSql('DROP INDEX IDX_C24262889A2A733 ON module');
        $this->addSql('DROP INDEX IDX_C242628D960F9EE ON module');
        $this->addSql('ALTER TABLE module DROP id_cctp_id, DROP composants_id, DROP id_devis');
    }
}
