<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190918143340 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, createdby_id INT NOT NULL, modifiedby_id INT DEFAULT NULL, car_type_id INT DEFAULT NULL, driver_id INT DEFAULT NULL, immatriculation VARCHAR(8) NOT NULL, location VARCHAR(255) DEFAULT NULL, chassis_number VARCHAR(50) NOT NULL, number_of_seats INT NOT NULL, number_of_doors INT NOT NULL, color VARCHAR(20) DEFAULT NULL, rent_per_km INT NOT NULL, rent_per_hour INT NOT NULL, rent_per_day INT NOT NULL, last_odometer INT NOT NULL, immatriculation_date DATETIME NOT NULL, first_contract_date DATETIME DEFAULT NULL, catalog_value INT DEFAULT NULL, residual_value INT DEFAULT NULL, transmission VARCHAR(20) NOT NULL, fuel_case VARCHAR(20) NOT NULL, co2emission DOUBLE PRECISION DEFAULT NULL, horse_power INT NOT NULL, power INT DEFAULT NULL, fuel_quantity INT DEFAULT NULL, services VARCHAR(255) DEFAULT NULL, costs VARCHAR(255) DEFAULT NULL, contracts VARCHAR(255) DEFAULT NULL, status VARCHAR(20) NOT NULL, inavailability_start_date DATE DEFAULT NULL, tags VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, modified DATETIME DEFAULT NULL, version_history INT NOT NULL, INDEX IDX_773DE69D7975B7E7 (model_id), INDEX IDX_773DE69DF0B5AF0B (createdby_id), INDEX IDX_773DE69D17617F72 (modifiedby_id), INDEX IDX_773DE69D96E7774F (car_type_id), INDEX IDX_773DE69DC3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_brand (id INT AUTO_INCREMENT NOT NULL, createdby_id INT NOT NULL, modifiedby_id INT DEFAULT NULL, label VARCHAR(100) NOT NULL, logo VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, modified DATETIME DEFAULT NULL, version_history INT NOT NULL, INDEX IDX_C3F97C8FF0B5AF0B (createdby_id), INDEX IDX_C3F97C8F17617F72 (modifiedby_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, createdby_id INT NOT NULL, modifiedby_id INT DEFAULT NULL, label VARCHAR(100) NOT NULL, year INT DEFAULT NULL, created DATETIME NOT NULL, modified DATETIME DEFAULT NULL, version_history INT NOT NULL, INDEX IDX_83EF70E44F5D008 (brand_id), INDEX IDX_83EF70EF0B5AF0B (createdby_id), INDEX IDX_83EF70E17617F72 (modifiedby_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_type (id INT AUTO_INCREMENT NOT NULL, createdby_id INT NOT NULL, modifiedby_id INT DEFAULT NULL, label VARCHAR(25) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, modified DATETIME DEFAULT NULL, version_history INT NOT NULL, INDEX IDX_47B44385F0B5AF0B (createdby_id), INDEX IDX_47B4438517617F72 (modifiedby_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, name VARCHAR(150) NOT NULL, birthdate DATE NOT NULL, avatar VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(15) NOT NULL, address LONGTEXT NOT NULL, city VARCHAR(20) NOT NULL, country VARCHAR(255) NOT NULL, id_card_type VARCHAR(20) DEFAULT NULL, id_card_number VARCHAR(50) DEFAULT NULL, id_card_proof VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D7975B7E7 FOREIGN KEY (model_id) REFERENCES car_model (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DF0B5AF0B FOREIGN KEY (createdby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D17617F72 FOREIGN KEY (modifiedby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D96E7774F FOREIGN KEY (car_type_id) REFERENCES car_type (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_brand ADD CONSTRAINT FK_C3F97C8FF0B5AF0B FOREIGN KEY (createdby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_brand ADD CONSTRAINT FK_C3F97C8F17617F72 FOREIGN KEY (modifiedby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_model ADD CONSTRAINT FK_83EF70E44F5D008 FOREIGN KEY (brand_id) REFERENCES car_brand (id)');
        $this->addSql('ALTER TABLE car_model ADD CONSTRAINT FK_83EF70EF0B5AF0B FOREIGN KEY (createdby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_model ADD CONSTRAINT FK_83EF70E17617F72 FOREIGN KEY (modifiedby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_type ADD CONSTRAINT FK_47B44385F0B5AF0B FOREIGN KEY (createdby_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_type ADD CONSTRAINT FK_47B4438517617F72 FOREIGN KEY (modifiedby_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car_model DROP FOREIGN KEY FK_83EF70E44F5D008');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D7975B7E7');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D96E7774F');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DF0B5AF0B');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69D17617F72');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC3423909');
        $this->addSql('ALTER TABLE car_brand DROP FOREIGN KEY FK_C3F97C8FF0B5AF0B');
        $this->addSql('ALTER TABLE car_brand DROP FOREIGN KEY FK_C3F97C8F17617F72');
        $this->addSql('ALTER TABLE car_model DROP FOREIGN KEY FK_83EF70EF0B5AF0B');
        $this->addSql('ALTER TABLE car_model DROP FOREIGN KEY FK_83EF70E17617F72');
        $this->addSql('ALTER TABLE car_type DROP FOREIGN KEY FK_47B44385F0B5AF0B');
        $this->addSql('ALTER TABLE car_type DROP FOREIGN KEY FK_47B4438517617F72');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE car_brand');
        $this->addSql('DROP TABLE car_model');
        $this->addSql('DROP TABLE car_type');
        $this->addSql('DROP TABLE user');
    }
}
