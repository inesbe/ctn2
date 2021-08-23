<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819011032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur ADD num_plomb INT NOT NULL, ADD date_chargement DATE NOT NULL, ADD date_enlevement DATE NOT NULL, ADD poids_tare INT NOT NULL, ADD poids_brute INT NOT NULL, ADD unite_payante INT NOT NULL, ADD nb_colis INT NOT NULL, ADD temperature INT NOT NULL, ADD prorietaire VARCHAR(255) NOT NULL, ADD bl INT NOT NULL, ADD etat INT NOT NULL, ADD bl_etat TINYINT(1) NOT NULL, ADD num_container INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur DROP num_plomb, DROP date_chargement, DROP date_enlevement, DROP poids_tare, DROP poids_brute, DROP unite_payante, DROP nb_colis, DROP temperature, DROP prorietaire, DROP bl, DROP etat, DROP bl_etat, DROP num_container');
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
