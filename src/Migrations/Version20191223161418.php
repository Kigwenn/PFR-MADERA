<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223161418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE composant_fournisseur');
        $this->addSql('DROP TABLE composant_module_composant');
        $this->addSql('DROP TABLE composant_module_module');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C960D6DC42');
        $this->addSql('DROP INDEX IDX_EC8486C960D6DC42 ON composant');
        $this->addSql('ALTER TABLE composant DROP modules_id');
        $this->addSql('ALTER TABLE composant_module ADD modu_id INT NOT NULL, ADD comp_id INT NOT NULL');
        $this->addSql('ALTER TABLE composant_module ADD CONSTRAINT FK_BCB404E427FCD2D5 FOREIGN KEY (modu_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE composant_module ADD CONSTRAINT FK_BCB404E44D0D3BCB FOREIGN KEY (comp_id) REFERENCES composant (id)');
        $this->addSql('CREATE INDEX IDX_BCB404E427FCD2D5 ON composant_module (modu_id)');
        $this->addSql('CREATE INDEX IDX_BCB404E44D0D3BCB ON composant_module (comp_id)');
        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628D960F9EE');
        $this->addSql('DROP INDEX IDX_C242628D960F9EE ON module');
        $this->addSql('ALTER TABLE module DROP composants_id');
        $this->addSql('ALTER TABLE remplissage ADD remp_prix_unitaire NUMERIC(6, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE composant_fournisseur (composant_id INT NOT NULL, fournisseur_id INT NOT NULL, INDEX IDX_996BE157F3310E7 (composant_id), INDEX IDX_996BE15670C757F (fournisseur_id), PRIMARY KEY(composant_id, fournisseur_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_module_composant (composant_module_id INT NOT NULL, composant_id INT NOT NULL, INDEX IDX_7794265A60CA0F61 (composant_module_id), INDEX IDX_7794265A7F3310E7 (composant_id), PRIMARY KEY(composant_module_id, composant_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE composant_module_module (composant_module_id INT NOT NULL, module_id INT NOT NULL, INDEX IDX_2B8A5E4F60CA0F61 (composant_module_id), INDEX IDX_2B8A5E4FAFC2B591 (module_id), PRIMARY KEY(composant_module_id, module_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE composant_fournisseur ADD CONSTRAINT FK_996BE15670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_fournisseur ADD CONSTRAINT FK_996BE157F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_composant ADD CONSTRAINT FK_7794265A60CA0F61 FOREIGN KEY (composant_module_id) REFERENCES composant_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_composant ADD CONSTRAINT FK_7794265A7F3310E7 FOREIGN KEY (composant_id) REFERENCES composant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_module ADD CONSTRAINT FK_2B8A5E4F60CA0F61 FOREIGN KEY (composant_module_id) REFERENCES composant_module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant_module_module ADD CONSTRAINT FK_2B8A5E4FAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE composant ADD modules_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C960D6DC42 FOREIGN KEY (modules_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_EC8486C960D6DC42 ON composant (modules_id)');
        $this->addSql('ALTER TABLE composant_module DROP FOREIGN KEY FK_BCB404E427FCD2D5');
        $this->addSql('ALTER TABLE composant_module DROP FOREIGN KEY FK_BCB404E44D0D3BCB');
        $this->addSql('DROP INDEX IDX_BCB404E427FCD2D5 ON composant_module');
        $this->addSql('DROP INDEX IDX_BCB404E44D0D3BCB ON composant_module');
        $this->addSql('ALTER TABLE composant_module DROP modu_id, DROP comp_id');
        $this->addSql('ALTER TABLE module ADD composants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628D960F9EE FOREIGN KEY (composants_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_C242628D960F9EE ON module (composants_id)');
        $this->addSql('ALTER TABLE remplissage DROP remp_prix_unitaire');
    }
}
