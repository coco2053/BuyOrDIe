<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612142955 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, brand_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, discount_price DOUBLE PRECISION DEFAULT NULL, reference VARCHAR(255) DEFAULT NULL, INDEX IDX_D34A04AD44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_property (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, property_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_404276494584665A (product_id), INDEX IDX_40427649549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_property_value (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_880DE715549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE product_property ADD CONSTRAINT FK_404276494584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_property ADD CONSTRAINT FK_40427649549213EC FOREIGN KEY (property_id) REFERENCES product_property_value (id)');
        $this->addSql('ALTER TABLE product_property_value ADD CONSTRAINT FK_880DE715549213EC FOREIGN KEY (property_id) REFERENCES product_property (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD44F5D008');
        $this->addSql('ALTER TABLE product_property DROP FOREIGN KEY FK_404276494584665A');
        $this->addSql('ALTER TABLE product_property_value DROP FOREIGN KEY FK_880DE715549213EC');
        $this->addSql('ALTER TABLE product_property DROP FOREIGN KEY FK_40427649549213EC');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_property');
        $this->addSql('DROP TABLE product_property_value');
    }
}
