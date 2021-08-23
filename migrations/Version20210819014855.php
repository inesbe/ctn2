<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210819014855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vrac (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reclamation CHANGE type type enum(\'Marchandise\', \'Passager\')');
        $this->addSql('ALTER TABLE vrack CHANGE code_emballage code_emballage VARCHAR(255) DEFAULT NULL, CHANGE marchandises marchandises VARCHAR(255) DEFAULT NULL, CHANGE nb_colis nb_colis INT DEFAULT NULL, CHANGE poids_brute poids_brute INT DEFAULT NULL, CHANGE poids_unitaire poids_unitaire INT DEFAULT NULL, CHANGE nom_destinataire nom_destinataire VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE code_postale code_postale INT DEFAULT NULL, CHANGE pays pays VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE matricule_vrac matricule_vrac VARCHAR(255) DEFAULT NULL, CHANGE bl bl INT DEFAULT NULL, CHANGE etat etat INT DEFAULT NULL, CHANGE etat_bl etat_bl TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vrac');
        $this->addSql('ALTER TABLE reclamation CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vrack CHANGE code_emballage code_emballage VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE marchandises marchandises VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nb_colis nb_colis INT NOT NULL, CHANGE poids_brute poids_brute INT NOT NULL, CHANGE poids_unitaire poids_unitaire INT NOT NULL, CHANGE nom_destinataire nom_destinataire VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE code_postale code_postale INT NOT NULL, CHANGE pays pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE matricule_vrac matricule_vrac VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE bl bl INT NOT NULL, CHANGE etat etat INT NOT NULL, CHANGE etat_bl etat_bl TINYINT(1) NOT NULL');
    }
}
