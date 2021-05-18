<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518190724 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(128) NOT NULL, strength INT NOT NULL, defense INT NOT NULL, description LONGTEXT DEFAULT NULL, health_point INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('INSERT INTO characters (name, strength, defense, description, health_point) VALUES ("Gimli", 75, 20, "Gimli est un nain\nComme George, Gimli a la barbe soyeuse parce qu\'il boit de la bière !", 200), ("Legolas", 80, 17, "Legolas est un elfe\nIl peut vous prédire le temps en fonction du nombre d\'orcs qu\'il a tué le jour même.", 175)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE characters');
    }
}
