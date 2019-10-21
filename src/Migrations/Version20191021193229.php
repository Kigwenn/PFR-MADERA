<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191021193229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE composant_commande (composant_id INT NOT NULL, commande_id INT NOT NULL, INDEX IDX_DCC5CF4B7F3310E7 (composant_id), INDEX IDX_DCC5CF4B82EA2E54 (commande_id), PRIMARY KEY(composant_id, commande_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_stock (composant_id INT NOT NULL, stock_id INT NOT NULL, INDEX IDX_B8CB81A7F3310E7 (composant_id), INDEX IDX_B8CB81ADCD6110 (stock_id), PRIMARY KEY(composant_id, stock_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_caracteristique (composant_id INT NOT NULL, caracteristique_id INT NOT NULL, INDEX IDX_C1ED4EB57F3310E7 (composant_id), INDEX IDX_C1ED4EB51704EEB7 (caracteristique_id), PRIMARY KEY(composant_id, caracteristique_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_etat_devis (devis_id INT NOT NULL, etat_devis_id INT NOT NULL, INDEX IDX_7D11A27A41DEFADA (devis_id), INDEX IDX_7D11A27ADC0B524A (etat_devis_id), PRIMARY KEY(devis_id, etat_devis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis_etape (devis_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_3E7C68F941DEFADA (devis_id), INDEX IDX_3E7C68F94A8CA2AD (etape_id), PRIMARY KEY(devis_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison_catalogue (maison_id INT NOT NULL, catalogue_id INT NOT NULL, INDEX IDX_AD14647A9D67D8AF (maison_id), INDEX IDX_AD14647A4A7843DC (catalogue_id), PRIMARY KEY(maison_id, catalogue_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison_module (maison_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_ED7BA8CA9D67D8AF (maison_id), INDEX IDX_ED7BA8CAAFC2B591 (module_id), PRIMARY KEY(maison_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_composant (module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_B6E59901AFC2B591 (module_id), INDEX IDX_B6E599017F3310E7 (composant_id), PRIMARY KEY(module_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composant_commande ADD CONSTRAINT FK_DCC5CF4B7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_commande ADD CONSTRAINT FK_DCC5CF4B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_stock ADD CONSTRAINT FK_B8CB81A7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_stock ADD CONSTRAINT FK_B8CB81ADCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB57F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_caracteristique ADD CONSTRAINT FK_C1ED4EB51704EEB7 FOREIGN KEY (caracteristique_id) REFERENCES caracteristique (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etat_devis ADD CONSTRAINT FK_7D11A27A41DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etat_devis ADD CONSTRAINT FK_7D11A27ADC0B524A FOREIGN KEY (etat_devis_id) REFERENCES etat_devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etape ADD CONSTRAINT FK_3E7C68F941DEFADA FOREIGN KEY (devis_id) REFERENCES devis (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devis_etape ADD CONSTRAINT FK_3E7C68F94A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_catalogue ADD CONSTRAINT FK_AD14647A9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_catalogue ADD CONSTRAINT FK_AD14647A4A7843DC FOREIGN KEY (catalogue_id) REFERENCES catalogue (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_module ADD CONSTRAINT FK_ED7BA8CA9D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maison_module ADD CONSTRAINT FK_ED7BA8CAAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E59901AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE module_composant ADD CONSTRAINT FK_B6E599017F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816670C757F ON adresse (fournisseur_id)');
        $this->addSql('ALTER TABLE composant ADD fournisseur_composant_id INT NOT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C916523276 FOREIGN KEY (fournisseur_composant_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C916523276 ON composant (fournisseur_composant_id)');
        $this->addSql('ALTER TABLE devis ADD devis_maison_id INT NOT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BECB412D5 FOREIGN KEY (devis_maison_id) REFERENCES maison (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BECB412D5 ON devis (devis_maison_id)');
        $this->addSql('ALTER TABLE doc_maison ADD maison_id INT NOT NULL');
        $this->addSql('ALTER TABLE doc_maison ADD CONSTRAINT FK_7B6BABC19D67D8AF FOREIGN KEY (maison_id) REFERENCES maison (id)');
        $this->addSql('CREATE INDEX IDX_7B6BABC19D67D8AF ON doc_maison (maison_id)');
        $this->addSql('ALTER TABLE fournisseur DROP FOREIGN KEY FK_369ECA32E77495DF');
        $this->addSql('DROP INDEX UNIQ_369ECA32E77495DF ON fournisseur');
        $this->addSql('ALTER TABLE fournisseur DROP adresse_fournisseur_id');
        $this->addSql('ALTER TABLE module ADD gamme_module_id INT NOT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628C04BB607 FOREIGN KEY (gamme_module_id) REFERENCES gamme (id)');
        $this->addSql('CREATE INDEX IDX_C242628C04BB607 ON module (gamme_module_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE composant_commande');
        $this->addSql('DROP TABLE composant_stock');
        $this->addSql('DROP TABLE composant_caracteristique');
        $this->addSql('DROP TABLE devis_etat_devis');
        $this->addSql('DROP TABLE devis_etape');
        $this->addSql('DROP TABLE maison_catalogue');
        $this->addSql('DROP TABLE maison_module');
        $this->addSql('DROP TABLE module_composant');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816670C757F');
        $this->addSql('DROP INDEX IDX_C35F0816670C757F ON adresse');
        $this->addSql('ALTER TABLE adresse DROP fournisseur_id');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C916523276');
        $this->addSql('DROP INDEX IDX_EC8486C916523276 ON composant');
        $this->addSql('ALTER TABLE composant DROP fournisseur_composant_id');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BECB412D5');
        $this->addSql('DROP INDEX IDX_8B27C52BECB412D5 ON devis');
        $this->addSql('ALTER TABLE devis DROP devis_maison_id');
        $this->addSql('ALTER TABLE doc_maison DROP FOREIGN KEY FK_7B6BABC19D67D8AF');
        $this->addSql('DROP INDEX IDX_7B6BABC19D67D8AF ON doc_maison');
        $this->addSql('ALTER TABLE doc_maison DROP maison_id');
        $this->addSql('ALTER TABLE fournisseur ADD adresse_fournisseur_id INT NOT NULL');
        $this->addSql('ALTER TABLE fournisseur ADD CONSTRAINT FK_369ECA32E77495DF FOREIGN KEY (adresse_fournisseur_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_369ECA32E77495DF ON fournisseur (adresse_fournisseur_id)');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628C04BB607');
        $this->addSql('DROP INDEX IDX_C242628C04BB607 ON module');
        $this->addSql('ALTER TABLE module DROP gamme_module_id');
    }
}
