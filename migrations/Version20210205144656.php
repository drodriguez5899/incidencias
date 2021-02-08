<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210205144656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lineas_de_incidencia ADD incidencia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lineas_de_incidencia ADD CONSTRAINT FK_7FA37BA1E1605BE2 FOREIGN KEY (incidencia_id) REFERENCES incidencia (id)');
        $this->addSql('CREATE INDEX IDX_7FA37BA1E1605BE2 ON lineas_de_incidencia (incidencia_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lineas_de_incidencia DROP FOREIGN KEY FK_7FA37BA1E1605BE2');
        $this->addSql('DROP INDEX IDX_7FA37BA1E1605BE2 ON lineas_de_incidencia');
        $this->addSql('ALTER TABLE lineas_de_incidencia DROP incidencia_id');
    }
}
