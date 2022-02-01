<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220201140343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer CHANGE date_debut_contrat date_debut_contrat DATE NOT NULL, CHANGE date_entretien date_entretien DATE NOT NULL, CHANGE date_publication date_publication DATE NOT NULL, CHANGE date_archivage date_archivage DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer CHANGE date_debut_contrat date_debut_contrat DATETIME NOT NULL, CHANGE date_entretien date_entretien DATETIME NOT NULL, CHANGE date_publication date_publication DATETIME NOT NULL, CHANGE date_archivage date_archivage DATETIME DEFAULT NULL');
    }
}
