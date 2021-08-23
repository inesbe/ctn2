<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819005235 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis ADD matricule_chassis VARCHAR(255) NOT NULL, ADD metre_linaire INT NOT NULL, ADD largeur INT NOT NULL, ADD hauteur INT NOT NULL, ADD tare INT NOT NULL, ADD numero_plomb INT NOT NULL, ADD date_changement DATE NOT NULL, ADD date_enlevment DATE NOT NULL, ADD nature VARCHAR(255) NOT NULL, ADD nb_unite INT NOT NULL, ADD temeprature INT NOT NULL, ADD poids_brute INT NOT NULL, ADD unite_payante INT NOT NULL, ADD nb_colis INT NOT NULL, ADD poids_unitaire INT NOT NULL, ADD marchandises VARCHAR(255) NOT NULL, ADD emballage VARCHAR(255) NOT NULL, ADD nom_destinataire VARCHAR(255) NOT NULL, ADD adresse VARCHAR(255) NOT NULL, ADD code_postale INT NOT NULL, ADD pays VARCHAR(255) NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD remarque VARCHAR(255) NOT NULL, ADD bl INT NOT NULL, ADD etat_bl TINYINT(1) NOT NULL, ADD etat INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis DROP matricule_chassis, DROP metre_linaire, DROP largeur, DROP hauteur, DROP tare, DROP numero_plomb, DROP date_changement, DROP date_enlevment, DROP nature, DROP nb_unite, DROP temeprature, DROP poids_brute, DROP unite_payante, DROP nb_colis, DROP poids_unitaire, DROP marchandises, DROP emballage, DROP nom_destinataire, DROP adresse, DROP code_postale, DROP pays, DROP ville, DROP remarque, DROP bl, DROP etat_bl, DROP etat');
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
