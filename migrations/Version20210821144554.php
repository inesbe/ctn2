<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210821144554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur ADD nom_destinataire VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD code_postale VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur DROP nom_destinataire, DROP adresse, DROP ville, DROP pays, DROP code_postale');
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
