<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819013506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
        $this->addSql('ALTER TABLE vrack ADD marchandises VARCHAR(255) NOT NULL, ADD nb_colis INT NOT NULL, ADD poids_brute INT NOT NULL, ADD poids_unitaire INT NOT NULL, ADD nom_destinataire VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD code_postale INT NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD matricule_vrac VARCHAR(255) NOT NULL, ADD bl INT NOT NULL, ADD etat INT NOT NULL, ADD etat_bl TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vrack DROP marchandises, DROP nb_colis, DROP poids_brute, DROP poids_unitaire, DROP nom_destinataire, DROP adresse, DROP code_postale, DROP pays, DROP ville, DROP matricule_vrac, DROP bl, DROP etat, DROP etat_bl');
    }
}
