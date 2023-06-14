<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418164449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flights DROP FOREIGN KEY FK_FC74B5EA6B12898B');
        $this->addSql('ALTER TABLE flights DROP FOREIGN KEY FK_FC74B5EAE260C194');
        $this->addSql('ALTER TABLE arrival_cities DROP FOREIGN KEY FK_732035DB3CCE3900');
        $this->addSql('ALTER TABLE departure_cities DROP FOREIGN KEY FK_24CE7D7F3CCE3900');
        $this->addSql('DROP TABLE arrival_cities');
        $this->addSql('DROP TABLE departure_cities');
        $this->addSql('ALTER TABLE cities CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_FC74B5EA6B12898B ON flights');
        $this->addSql('DROP INDEX IDX_FC74B5EAE260C194 ON flights');
        $this->addSql('ALTER TABLE flights ADD departure_city_id INT NOT NULL, ADD arrival_city_id INT NOT NULL, DROP departure_city_id_id, DROP arrival_city_id_id, CHANGE flight_nb flight_nb VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE flights ADD CONSTRAINT FK_FC74B5EA918B251E FOREIGN KEY (departure_city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE flights ADD CONSTRAINT FK_FC74B5EA4067ACA7 FOREIGN KEY (arrival_city_id) REFERENCES cities (id)');
        $this->addSql('CREATE INDEX IDX_FC74B5EA918B251E ON flights (departure_city_id)');
        $this->addSql('CREATE INDEX IDX_FC74B5EA4067ACA7 ON flights (arrival_city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE arrival_cities (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, INDEX IDX_732035DB3CCE3900 (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE departure_cities (id INT AUTO_INCREMENT NOT NULL, city_id INT NOT NULL, INDEX IDX_24CE7D7F3CCE3900 (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE arrival_cities ADD CONSTRAINT FK_732035DB3CCE3900 FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE departure_cities ADD CONSTRAINT FK_24CE7D7F3CCE3900 FOREIGN KEY (city_id) REFERENCES cities (id)');
        $this->addSql('ALTER TABLE cities CHANGE name name VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE flights DROP FOREIGN KEY FK_FC74B5EA918B251E');
        $this->addSql('ALTER TABLE flights DROP FOREIGN KEY FK_FC74B5EA4067ACA7');
        $this->addSql('DROP INDEX IDX_FC74B5EA918B251E ON flights');
        $this->addSql('DROP INDEX IDX_FC74B5EA4067ACA7 ON flights');
        $this->addSql('ALTER TABLE flights ADD departure_city_id_id INT NOT NULL, ADD arrival_city_id_id INT NOT NULL, DROP departure_city_id, DROP arrival_city_id, CHANGE flight_nb flight_nb VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE flights ADD CONSTRAINT FK_FC74B5EA6B12898B FOREIGN KEY (arrival_city_id_id) REFERENCES arrival_cities (id)');
        $this->addSql('ALTER TABLE flights ADD CONSTRAINT FK_FC74B5EAE260C194 FOREIGN KEY (departure_city_id_id) REFERENCES departure_cities (id)');
        $this->addSql('CREATE INDEX IDX_FC74B5EA6B12898B ON flights (arrival_city_id_id)');
        $this->addSql('CREATE INDEX IDX_FC74B5EAE260C194 ON flights (departure_city_id_id)');
    }
}
