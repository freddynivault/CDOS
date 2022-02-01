<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201143702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE upload (id INT AUTO_INCREMENT NOT NULL, namepdf VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, intitule_poste VARCHAR(255) DEFAULT NULL, description_poste VARCHAR(255) DEFAULT NULL, missions VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, logo_structure VARCHAR(255) DEFAULT NULL, nombre_candidature INT DEFAULT NULL, experience INT DEFAULT NULL, convention_collective VARCHAR(255) DEFAULT NULL, outils VARCHAR(255) DEFAULT NULL, temps_travail INT DEFAULT NULL, date_debut_contrat DATE DEFAULT NULL, date_entretien DATE DEFAULT NULL, date_publication DATE DEFAULT NULL, date_archivage DATE DEFAULT NULL, salaire INT DEFAULT NULL, formation VARCHAR(255) DEFAULT NULL, competences VARCHAR(255) DEFAULT NULL, qualites VARCHAR(255) DEFAULT NULL, type_contrat VARCHAR(255) DEFAULT NULL, categorie_contrat VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE upload');
    }
}
