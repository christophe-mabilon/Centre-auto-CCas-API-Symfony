<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210906213639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classified_ad (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, region_id INT NOT NULL, user_id INT NOT NULL, garage_id INT NOT NULL, brand_id INT NOT NULL, reference VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, year INT NOT NULL, kilometre INT NOT NULL, fuel VARCHAR(255) NOT NULL, type_of_vehicle VARCHAR(255) NOT NULL, gearbox VARCHAR(255) NOT NULL, car_doors INT NOT NULL, places INT NOT NULL, photos JSON NOT NULL, model_complement VARCHAR(255) DEFAULT NULL, model_complement2 VARCHAR(255) DEFAULT NULL, power INT NOT NULL, prime_eco TINYINT(1) DEFAULT NULL, top_ocass TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_on_at DATETIME NOT NULL, INDEX IDX_6869CB767975B7E7 (model_id), INDEX IDX_6869CB7698260155 (region_id), INDEX IDX_6869CB76A76ED395 (user_id), INDEX IDX_6869CB76C4FFF555 (garage_id), INDEX IDX_6869CB7644F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE garage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, image_garage VARCHAR(255) DEFAULT NULL, street_number INT NOT NULL, street_name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_on_at DATETIME NOT NULL, INDEX IDX_9F26610BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, model_id INT NOT NULL, INDEX IDX_3D0AE6DC44F5D008 (brand_id), INDEX IDX_3D0AE6DC7975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, date_of_registration DATETIME NOT NULL, roles JSON NOT NULL, updated_on DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classified_ad ADD CONSTRAINT FK_6869CB767975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE classified_ad ADD CONSTRAINT FK_6869CB7698260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE classified_ad ADD CONSTRAINT FK_6869CB76A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE classified_ad ADD CONSTRAINT FK_6869CB76C4FFF555 FOREIGN KEY (garage_id) REFERENCES garage (id)');
        $this->addSql('ALTER TABLE classified_ad ADD CONSTRAINT FK_6869CB7644F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE garage ADD CONSTRAINT FK_9F26610BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE manufacturer ADD CONSTRAINT FK_3D0AE6DC44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE manufacturer ADD CONSTRAINT FK_3D0AE6DC7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classified_ad DROP FOREIGN KEY FK_6869CB7644F5D008');
        $this->addSql('ALTER TABLE manufacturer DROP FOREIGN KEY FK_3D0AE6DC44F5D008');
        $this->addSql('ALTER TABLE classified_ad DROP FOREIGN KEY FK_6869CB76C4FFF555');
        $this->addSql('ALTER TABLE classified_ad DROP FOREIGN KEY FK_6869CB767975B7E7');
        $this->addSql('ALTER TABLE manufacturer DROP FOREIGN KEY FK_3D0AE6DC7975B7E7');
        $this->addSql('ALTER TABLE classified_ad DROP FOREIGN KEY FK_6869CB7698260155');
        $this->addSql('ALTER TABLE classified_ad DROP FOREIGN KEY FK_6869CB76A76ED395');
        $this->addSql('ALTER TABLE garage DROP FOREIGN KEY FK_9F26610BA76ED395');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE classified_ad');
        $this->addSql('DROP TABLE garage');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE `user`');
    }
}
