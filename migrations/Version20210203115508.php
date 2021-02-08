<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210203115508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE incidencia (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) DEFAULT NULL, fecha_creacion TIME NOT NULL, estado VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cliente ADD incidencia_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cliente ADD CONSTRAINT FK_F41C9B25E1605BE2 FOREIGN KEY (incidencia_id) REFERENCES incidencia (id)');
        $this->addSql('CREATE INDEX IDX_F41C9B25E1605BE2 ON cliente (incidencia_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cliente DROP FOREIGN KEY FK_F41C9B25E1605BE2');
        $this->addSql('DROP TABLE incidencia');
        $this->addSql('DROP INDEX IDX_F41C9B25E1605BE2 ON cliente');
        $this->addSql('ALTER TABLE cliente DROP incidencia_id');
    }
}
