<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200618111103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product_property DROP FOREIGN KEY FK_40427649549213EC');
        $this->addSql('DROP TABLE product_property_value');
        $this->addSql('DROP INDEX IDX_40427649549213EC ON product_property');
        $this->addSql('ALTER TABLE product_property ADD value VARCHAR(255) NOT NULL, DROP property_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_property_value (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, value VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_880DE715549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_property_value ADD CONSTRAINT FK_880DE715549213EC FOREIGN KEY (property_id) REFERENCES product_property (id)');
        $this->addSql('ALTER TABLE product_property ADD property_id INT DEFAULT NULL, DROP value');
        $this->addSql('ALTER TABLE product_property ADD CONSTRAINT FK_40427649549213EC FOREIGN KEY (property_id) REFERENCES product_property_value (id)');
        $this->addSql('CREATE INDEX IDX_40427649549213EC ON product_property (property_id)');
    }
}
