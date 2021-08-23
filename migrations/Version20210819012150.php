<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819012150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur CHANGE num_plomb num_plomb INT DEFAULT NULL, CHANGE date_chargement date_chargement DATE DEFAULT NULL, CHANGE date_enlevement date_enlevement DATE DEFAULT NULL, CHANGE poids_tare poids_tare INT DEFAULT NULL, CHANGE poids_brute poids_brute INT DEFAULT NULL, CHANGE unite_payante unite_payante INT DEFAULT NULL, CHANGE nb_colis nb_colis INT DEFAULT NULL, CHANGE temperature temperature INT DEFAULT NULL, CHANGE prorietaire prorietaire VARCHAR(255) DEFAULT NULL, CHANGE bl bl INT DEFAULT NULL, CHANGE etat etat INT DEFAULT NULL, CHANGE bl_etat bl_etat TINYINT(1) DEFAULT NULL, CHANGE num_container num_container INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conteneur CHANGE num_plomb num_plomb INT NOT NULL, CHANGE date_chargement date_chargement DATE NOT NULL, CHANGE date_enlevement date_enlevement DATE NOT NULL, CHANGE poids_tare poids_tare INT NOT NULL, CHANGE poids_brute poids_brute INT NOT NULL, CHANGE unite_payante unite_payante INT NOT NULL, CHANGE nb_colis nb_colis INT NOT NULL, CHANGE temperature temperature INT NOT NULL, CHANGE prorietaire prorietaire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE bl bl INT NOT NULL, CHANGE etat etat INT NOT NULL, CHANGE bl_etat bl_etat TINYINT(1) NOT NULL, CHANGE num_container num_container INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
