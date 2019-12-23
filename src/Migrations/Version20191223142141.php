<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223142141 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE composant_fournisseur (composant_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_996BE157F3310E7 (composant_id), INDEX IDX_996BE15670C757F (fournisseur_id), PRIMARY KEY(composant_id, fournisseur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_module_module (composant_module_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_2B8A5E4F60CA0F61 (composant_module_id), INDEX IDX_2B8A5E4FAFC2B591 (module_id), PRIMARY KEY(composant_module_id, module_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE composant_module_composant (composant_module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_7794265A60CA0F61 (composant_module_id), INDEX IDX_7794265A7F3310E7 (composant_id), PRIMARY KEY(composant_module_id, composant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composant_fournisseur ADD CONSTRAINT FK_996BE157F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_fournisseur ADD CONSTRAINT FK_996BE15670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_module ADD CONSTRAINT FK_2B8A5E4F60CA0F61 FOREIGN KEY (composant_module_id) REFERENCES composant_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_module ADD CONSTRAINT FK_2B8A5E4FAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_composant ADD CONSTRAINT FK_7794265A60CA0F61 FOREIGN KEY (composant_module_id) REFERENCES composant_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_composant ADD CONSTRAINT FK_7794265A7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081674FAEB6C');
        $this->addSql('DROP INDEX IDX_C35F081674FAEB6C ON adresse');
        $this->addSql('ALTER TABLE adresse CHANGE pays_id_id pays_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816A6E44244 ON adresse (pays_id)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455AF65F157');
        $this->addSql('DROP INDEX UNIQ_C7440455AF65F157 ON client');
        $this->addSql('ALTER TABLE client CHANGE adre_id_id adre_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045535227DDF FOREIGN KEY (adre_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C744045535227DDF ON client (adre_id)');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C96515E692');
        $this->addSql('DROP INDEX IDX_EC8486C96515E692 ON composant');
        $this->addSql('ALTER TABLE composant ADD modules_id INT DEFAULT NULL, CHANGE fami_id_id fami_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C982E6D09 FOREIGN KEY (fami_id) REFERENCES famille_composant (id)');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C960D6DC42 FOREIGN KEY (modules_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C982E6D09 ON composant (fami_id)');
        $this->addSql('CREATE INDEX IDX_EC8486C960D6DC42 ON composant (modules_id)');
        $this->addSql('ALTER TABLE composant_module DROP FOREIGN KEY FK_BCB404E4B9B82F59');
        $this->addSql('ALTER TABLE composant_module DROP FOREIGN KEY FK_BCB404E4EA062B66');
        $this->addSql('DROP INDEX IDX_BCB404E4B9B82F59 ON composant_module');
        $this->addSql('DROP INDEX IDX_BCB404E4EA062B66 ON composant_module');
        $this->addSql('ALTER TABLE composant_module DROP modu_id_id, DROP comp_id_id');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E6386750DFAA');
        $this->addSql('DROP INDEX UNIQ_4C62E6386750DFAA ON contact');
        $this->addSql('ALTER TABLE contact CHANGE four_id_id four_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638E5AC00A4 FOREIGN KEY (four_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638E5AC00A4 ON contact (four_id)');
        $this->addSql('ALTER TABLE couverture ADD couv_prix_unitaire NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B3199AE0F');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B39D3B2EE');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B7E98A9BF');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BAF65F157');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BBFB1D257');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BCD9C96FD');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BDA11D01F');
        $this->addSql('DROP INDEX IDX_8B27C52BBFB1D257 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B39D3B2EE ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BDA11D01F ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B3199AE0F ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B7E98A9BF ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BCD9C96FD ON devis');
        $this->addSql('DROP INDEX UNIQ_8B27C52BAF65F157 ON devis');
        $this->addSql('ALTER TABLE devis ADD mais_id INT NOT NULL, ADD etap_id INT NOT NULL, ADD etat_id INT NOT NULL, ADD adre_id INT NOT NULL, ADD comm_id INT NOT NULL, ADD clie_id INT NOT NULL, DROP mais_id_id, DROP etap_id_id, DROP etat_id_id, DROP adre_id_id, DROP comm_id_id, DROP clie_id_id, CHANGE gamm_id_id gamm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BC00D28C8 FOREIGN KEY (mais_id) REFERENCES maison (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B823C11A8 FOREIGN KEY (etap_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BD5E86FF FOREIGN KEY (etat_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B35227DDF FOREIGN KEY (adre_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B213BF1EA FOREIGN KEY (gamm_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BEF7EB489 FOREIGN KEY (comm_id) REFERENCES commercial (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B59DE4808 FOREIGN KEY (clie_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BC00D28C8 ON devis (mais_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B823C11A8 ON devis (etap_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BD5E86FF ON devis (etat_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B27C52B35227DDF ON devis (adre_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B213BF1EA ON devis (gamm_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BEF7EB489 ON devis (comm_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B59DE4808 ON devis (clie_id)');
        $this->addSql('ALTER TABLE finition_exterieur ADD fiex_prix_unitaire NUMERIC(6, 2) NOT NULL, CHANGE finex_nom fiex_nom VARCHAR(200) NOT NULL, CHANGE finex_description fiex_description VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE finition_interieur ADD fiin_prix_unitaire NUMERIC(6, 2) NOT NULL, CHANGE finin_nom fiin_nom VARCHAR(200) NOT NULL, CHANGE finin_description fiin_description VARCHAR(500) NOT NULL');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E146869877BE0');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468753630FD');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468CD140826');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468E4FA4F11');
        $this->addSql('DROP INDEX IDX_C32E1468CD140826 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E146869877BE0 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E1468753630FD ON gamme');
        $this->addSql('DROP INDEX IDX_C32E1468E4FA4F11 ON gamme');
        $this->addSql('ALTER TABLE gamme ADD remp_id INT NOT NULL, ADD finex_id INT NOT NULL, ADD couv_id INT NOT NULL, ADD huis_id INT NOT NULL, DROP remp_id_id, DROP finex_id_id, DROP couv_id_id, DROP huis_id_id');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E14682D3F8FD7 FOREIGN KEY (remp_id) REFERENCES remplissage (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468392F7D25 FOREIGN KEY (finex_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E146838F6B854 FOREIGN KEY (couv_id) REFERENCES couverture (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468A7247E2 FOREIGN KEY (huis_id) REFERENCES huisseries (id)');
        $this->addSql('CREATE INDEX IDX_C32E14682D3F8FD7 ON gamme (remp_id)');
        $this->addSql('CREATE INDEX IDX_C32E1468392F7D25 ON gamme (finex_id)');
        $this->addSql('CREATE INDEX IDX_C32E146838F6B854 ON gamme (couv_id)');
        $this->addSql('CREATE INDEX IDX_C32E1468A7247E2 ON gamme (huis_id)');
        $this->addSql('ALTER TABLE huisseries DROP huis_prix');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426283A26C75B');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426283C78F64D');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262869877BE0');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628753630FD');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426287E98A9BF');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628E4FA4F11');
        $this->addSql('DROP INDEX IDX_C242628753630FD ON module');
        $this->addSql('DROP INDEX IDX_C24262869877BE0 ON module');
        $this->addSql('DROP INDEX IDX_C2426283C78F64D ON module');
        $this->addSql('DROP INDEX IDX_C2426283A26C75B ON module');
        $this->addSql('DROP INDEX IDX_C242628E4FA4F11 ON module');
        $this->addSql('DROP INDEX IDX_C2426287E98A9BF ON module');
        $this->addSql('ALTER TABLE module ADD gamm_id INT NOT NULL, ADD cctp_id INT NOT NULL, ADD remp_id INT NOT NULL, ADD finex_id INT NOT NULL, ADD finin_id INT NOT NULL, ADD couv_id INT NOT NULL, ADD devi INT DEFAULT NULL, DROP gamm_id_id, DROP cctp_id_id, DROP remp_id_id, DROP finex_id_id, DROP finin_id_id, DROP couv_id_id, CHANGE devi_id composants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628213BF1EA FOREIGN KEY (gamm_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628573F0E43 FOREIGN KEY (cctp_id) REFERENCES cctp (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628D960F9EE FOREIGN KEY (composants_id) REFERENCES composant_module (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426282D3F8FD7 FOREIGN KEY (remp_id) REFERENCES remplissage (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628392F7D25 FOREIGN KEY (finex_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262889AD9867 FOREIGN KEY (finin_id) REFERENCES finition_interieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262838F6B854 FOREIGN KEY (couv_id) REFERENCES couverture (id)');
        $this->addSql('CREATE INDEX IDX_C242628213BF1EA ON module (gamm_id)');
        $this->addSql('CREATE INDEX IDX_C242628573F0E43 ON module (cctp_id)');
        $this->addSql('CREATE INDEX IDX_C242628D960F9EE ON module (composants_id)');
        $this->addSql('CREATE INDEX IDX_C2426282D3F8FD7 ON module (remp_id)');
        $this->addSql('CREATE INDEX IDX_C242628392F7D25 ON module (finex_id)');
        $this->addSql('CREATE INDEX IDX_C24262889AD9867 ON module (finin_id)');
        $this->addSql('CREATE INDEX IDX_C24262838F6B854 ON module (couv_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE composant_fournisseur');
        $this->addSql('DROP TABLE composant_module_module');
        $this->addSql('DROP TABLE composant_module_composant');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A6E44244');
        $this->addSql('DROP INDEX IDX_C35F0816A6E44244 ON adresse');
        $this->addSql('ALTER TABLE adresse CHANGE pays_id pays_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081674FAEB6C FOREIGN KEY (pays_id_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_C35F081674FAEB6C ON adresse (pays_id_id)');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045535227DDF');
        $this->addSql('DROP INDEX UNIQ_C744045535227DDF ON client');
        $this->addSql('ALTER TABLE client CHANGE adre_id adre_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455AF65F157 FOREIGN KEY (adre_id_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455AF65F157 ON client (adre_id_id)');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C982E6D09');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C960D6DC42');
        $this->addSql('DROP INDEX IDX_EC8486C982E6D09 ON composant');
        $this->addSql('DROP INDEX IDX_EC8486C960D6DC42 ON composant');
        $this->addSql('ALTER TABLE composant ADD fami_id_id INT DEFAULT NULL, DROP fami_id, DROP modules_id');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C96515E692 FOREIGN KEY (fami_id_id) REFERENCES famille_composant (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C96515E692 ON composant (fami_id_id)');
        $this->addSql('ALTER TABLE composant_module ADD modu_id_id INT NOT NULL, ADD comp_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE composant_module ADD CONSTRAINT FK_BCB404E4B9B82F59 FOREIGN KEY (comp_id_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE composant_module ADD CONSTRAINT FK_BCB404E4EA062B66 FOREIGN KEY (modu_id_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_BCB404E4B9B82F59 ON composant_module (comp_id_id)');
        $this->addSql('CREATE INDEX IDX_BCB404E4EA062B66 ON composant_module (modu_id_id)');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638E5AC00A4');
        $this->addSql('DROP INDEX UNIQ_4C62E638E5AC00A4 ON contact');
        $this->addSql('ALTER TABLE contact CHANGE four_id four_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E6386750DFAA FOREIGN KEY (four_id_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E6386750DFAA ON contact (four_id_id)');
        $this->addSql('ALTER TABLE couverture DROP couv_prix_unitaire');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BC00D28C8');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B823C11A8');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BD5E86FF');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B35227DDF');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B213BF1EA');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52BEF7EB489');
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B59DE4808');
        $this->addSql('DROP INDEX IDX_8B27C52BC00D28C8 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B823C11A8 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BD5E86FF ON devis');
        $this->addSql('DROP INDEX UNIQ_8B27C52B35227DDF ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B213BF1EA ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52BEF7EB489 ON devis');
        $this->addSql('DROP INDEX IDX_8B27C52B59DE4808 ON devis');
        $this->addSql('ALTER TABLE devis ADD mais_id_id INT NOT NULL, ADD etap_id_id INT NOT NULL, ADD etat_id_id INT NOT NULL, ADD adre_id_id INT NOT NULL, ADD comm_id_id INT NOT NULL, ADD clie_id_id INT NOT NULL, DROP mais_id, DROP etap_id, DROP etat_id, DROP adre_id, DROP comm_id, DROP clie_id, CHANGE gamm_id gamm_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B3199AE0F FOREIGN KEY (clie_id_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B39D3B2EE FOREIGN KEY (etat_id_id) REFERENCES etat (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B7E98A9BF FOREIGN KEY (gamm_id_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BAF65F157 FOREIGN KEY (adre_id_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BBFB1D257 FOREIGN KEY (comm_id_id) REFERENCES commercial (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BCD9C96FD FOREIGN KEY (etap_id_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52BDA11D01F FOREIGN KEY (mais_id_id) REFERENCES maison (id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BBFB1D257 ON devis (comm_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B39D3B2EE ON devis (etat_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BDA11D01F ON devis (mais_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B3199AE0F ON devis (clie_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52B7E98A9BF ON devis (gamm_id_id)');
        $this->addSql('CREATE INDEX IDX_8B27C52BCD9C96FD ON devis (etap_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B27C52BAF65F157 ON devis (adre_id_id)');
        $this->addSql('ALTER TABLE finition_exterieur DROP fiex_prix_unitaire, CHANGE fiex_nom finex_nom VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE fiex_description finex_description VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE finition_interieur DROP fiin_prix_unitaire, CHANGE fiin_nom finin_nom VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE fiin_description finin_description VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E14682D3F8FD7');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468392F7D25');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E146838F6B854');
        $this->addSql('ALTER TABLE gamme DROP FOREIGN KEY FK_C32E1468A7247E2');
        $this->addSql('DROP INDEX IDX_C32E14682D3F8FD7 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E1468392F7D25 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E146838F6B854 ON gamme');
        $this->addSql('DROP INDEX IDX_C32E1468A7247E2 ON gamme');
        $this->addSql('ALTER TABLE gamme ADD remp_id_id INT NOT NULL, ADD finex_id_id INT NOT NULL, ADD couv_id_id INT NOT NULL, ADD huis_id_id INT NOT NULL, DROP remp_id, DROP finex_id, DROP couv_id, DROP huis_id');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E146869877BE0 FOREIGN KEY (finex_id_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468753630FD FOREIGN KEY (couv_id_id) REFERENCES couverture (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468CD140826 FOREIGN KEY (huis_id_id) REFERENCES huisseries (id)');
        $this->addSql('ALTER TABLE gamme ADD CONSTRAINT FK_C32E1468E4FA4F11 FOREIGN KEY (remp_id_id) REFERENCES remplissage (id)');
        $this->addSql('CREATE INDEX IDX_C32E1468CD140826 ON gamme (huis_id_id)');
        $this->addSql('CREATE INDEX IDX_C32E146869877BE0 ON gamme (finex_id_id)');
        $this->addSql('CREATE INDEX IDX_C32E1468753630FD ON gamme (couv_id_id)');
        $this->addSql('CREATE INDEX IDX_C32E1468E4FA4F11 ON gamme (remp_id_id)');
        $this->addSql('ALTER TABLE huisseries ADD huis_prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628213BF1EA');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628573F0E43');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628D960F9EE');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C2426282D3F8FD7');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628392F7D25');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262889AD9867');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C24262838F6B854');
        $this->addSql('DROP INDEX IDX_C242628213BF1EA ON module');
        $this->addSql('DROP INDEX IDX_C242628573F0E43 ON module');
        $this->addSql('DROP INDEX IDX_C242628D960F9EE ON module');
        $this->addSql('DROP INDEX IDX_C2426282D3F8FD7 ON module');
        $this->addSql('DROP INDEX IDX_C242628392F7D25 ON module');
        $this->addSql('DROP INDEX IDX_C24262889AD9867 ON module');
        $this->addSql('DROP INDEX IDX_C24262838F6B854 ON module');
        $this->addSql('ALTER TABLE module ADD gamm_id_id INT NOT NULL, ADD cctp_id_id INT NOT NULL, ADD remp_id_id INT NOT NULL, ADD finex_id_id INT NOT NULL, ADD finin_id_id INT NOT NULL, ADD couv_id_id INT NOT NULL, ADD devi_id INT DEFAULT NULL, DROP gamm_id, DROP cctp_id, DROP composants_id, DROP remp_id, DROP finex_id, DROP finin_id, DROP couv_id, DROP devi');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426283A26C75B FOREIGN KEY (finin_id_id) REFERENCES finition_interieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426283C78F64D FOREIGN KEY (cctp_id_id) REFERENCES cctp (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C24262869877BE0 FOREIGN KEY (finex_id_id) REFERENCES finition_exterieur (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628753630FD FOREIGN KEY (couv_id_id) REFERENCES couverture (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C2426287E98A9BF FOREIGN KEY (gamm_id_id) REFERENCES gamme (id)');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628E4FA4F11 FOREIGN KEY (remp_id_id) REFERENCES remplissage (id)');
        $this->addSql('CREATE INDEX IDX_C242628753630FD ON module (couv_id_id)');
        $this->addSql('CREATE INDEX IDX_C24262869877BE0 ON module (finex_id_id)');
        $this->addSql('CREATE INDEX IDX_C2426283C78F64D ON module (cctp_id_id)');
        $this->addSql('CREATE INDEX IDX_C2426283A26C75B ON module (finin_id_id)');
        $this->addSql('CREATE INDEX IDX_C242628E4FA4F11 ON module (remp_id_id)');
        $this->addSql('CREATE INDEX IDX_C2426287E98A9BF ON module (gamm_id_id)');
    }
}
