<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217144355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE couverture ADD couv_prix_unitaire NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE finition_exterieur ADD fiex_prix_unitaire NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE finition_interieur ADD fiin_prix_unitaire NUMERIC(6, 2) NOT NULL');
        $this->addSql('ALTER TABLE huisseries DROP huis_prix');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE couverture DROP couv_prix_unitaire');
        $this->addSql('ALTER TABLE finition_exterieur DROP fiex_prix_unitaire');
        $this->addSql('ALTER TABLE finition_interieur DROP fiin_prix_unitaire');
        $this->addSql('ALTER TABLE huisseries ADD huis_prix DOUBLE PRECISION NOT NULL');
    }
}
