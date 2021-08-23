<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819012444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis CHANGE matricule_chassis matricule_chassis VARCHAR(255) DEFAULT NULL, CHANGE metre_linaire metre_linaire INT DEFAULT NULL, CHANGE largeur largeur INT DEFAULT NULL, CHANGE hauteur hauteur INT DEFAULT NULL, CHANGE tare tare INT DEFAULT NULL, CHANGE numero_plomb numero_plomb INT DEFAULT NULL, CHANGE date_changement date_changement DATE DEFAULT NULL, CHANGE date_enlevment date_enlevment DATE DEFAULT NULL, CHANGE nature nature VARCHAR(255) DEFAULT NULL, CHANGE nb_unite nb_unite INT DEFAULT NULL, CHANGE temeprature temeprature INT DEFAULT NULL, CHANGE poids_brute poids_brute INT DEFAULT NULL, CHANGE unite_payante unite_payante INT DEFAULT NULL, CHANGE nb_colis nb_colis INT DEFAULT NULL, CHANGE poids_unitaire poids_unitaire INT DEFAULT NULL, CHANGE marchandises marchandises VARCHAR(255) DEFAULT NULL, CHANGE emballage emballage VARCHAR(255) DEFAULT NULL, CHANGE nom_destinataire nom_destinataire VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE code_postale code_postale INT DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE remarque remarque VARCHAR(255) DEFAULT NULL, CHANGE bl bl INT DEFAULT NULL, CHANGE etat_bl etat_bl TINYINT(1) DEFAULT NULL, CHANGE etat etat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chassis CHANGE matricule_chassis matricule_chassis VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE metre_linaire metre_linaire INT NOT NULL, CHANGE largeur largeur INT NOT NULL, CHANGE hauteur hauteur INT NOT NULL, CHANGE tare tare INT NOT NULL, CHANGE numero_plomb numero_plomb INT NOT NULL, CHANGE date_changement date_changement DATE NOT NULL, CHANGE date_enlevment date_enlevment DATE NOT NULL, CHANGE nature nature VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nb_unite nb_unite INT NOT NULL, CHANGE temeprature temeprature INT NOT NULL, CHANGE poids_brute poids_brute INT NOT NULL, CHANGE unite_payante unite_payante INT NOT NULL, CHANGE nb_colis nb_colis INT NOT NULL, CHANGE poids_unitaire poids_unitaire INT NOT NULL, CHANGE marchandises marchandises VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE emballage emballage VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_destinataire nom_destinataire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code_postale code_postale INT NOT NULL, CHANGE pays pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE remarque remarque VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE bl bl INT NOT NULL, CHANGE etat_bl etat_bl TINYINT(1) NOT NULL, CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
