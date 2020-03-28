<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200324152834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse CHANGE adre_complement adre_complement VARCHAR(255) DEFAULT NULL, CHANGE adre_info adre_info VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE caracteristique CHANGE modu_id modu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cctp CHANGE cctp_image cctp_image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE commercial CHANGE comm_token comm_token VARCHAR(64) DEFAULT NULL, CHANGE comm_token_date comm_token_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE composant CHANGE fami_id fami_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis CHANGE gamm_id gamm_id INT DEFAULT NULL, CHANGE devi_prix devi_prix DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE maison CHANGE mais_cdp mais_cdp VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE module CHANGE devi_id devi_id INT DEFAULT NULL, CHANGE cctp_id cctp_id INT DEFAULT NULL, CHANGE fiex_id fiex_id INT DEFAULT NULL, CHANGE fiin_id fiin_id INT DEFAULT NULL, CHANGE couv_id couv_id INT DEFAULT NULL, CHANGE isol_id isol_id INT DEFAULT NULL, CHANGE modu_prix_unitaire modu_prix_unitaire DOUBLE PRECISION DEFAULT NULL, CHANGE modu_prix_total modu_prix_total DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adresse CHANGE adre_complement adre_complement VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE adre_info adre_info VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE caracteristique CHANGE modu_id modu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cctp CHANGE cctp_image cctp_image LONGBLOB NOT NULL');
        $this->addSql('ALTER TABLE commercial CHANGE comm_token comm_token VARCHAR(64) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE comm_token_date comm_token_date DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE composant CHANGE fami_id fami_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE devis CHANGE gamm_id gamm_id INT DEFAULT NULL, CHANGE devi_prix devi_prix DOUBLE PRECISION DEFAULT \'0\'');
        $this->addSql('ALTER TABLE maison CHANGE mais_cdp mais_cdp LONGBLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE module CHANGE devi_id devi_id INT DEFAULT NULL, CHANGE cctp_id cctp_id INT DEFAULT NULL, CHANGE fiex_id fiex_id INT DEFAULT NULL, CHANGE fiin_id fiin_id INT DEFAULT NULL, CHANGE couv_id couv_id INT DEFAULT NULL, CHANGE isol_id isol_id INT DEFAULT NULL, CHANGE modu_prix_unitaire modu_prix_unitaire DOUBLE PRECISION DEFAULT \'NULL\', CHANGE modu_prix_total modu_prix_total DOUBLE PRECISION DEFAULT \'NULL\'');
    }
}
