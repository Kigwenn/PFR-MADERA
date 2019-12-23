<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223142724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module DROP FOREIGN KEY FK_C242628D960F9EE');
        $this->addSql('DROP INDEX IDX_C242628D960F9EE ON module');
        $this->addSql('ALTER TABLE module DROP composants_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE module ADD composants_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE module ADD CONSTRAINT FK_C242628D960F9EE FOREIGN KEY (composants_id) REFERENCES composant_module (id)');
        $this->addSql('CREATE INDEX IDX_C242628D960F9EE ON module (composants_id)');
    }
}
