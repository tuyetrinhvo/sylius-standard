<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210304102341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Migrations for sendinblue';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sendinblue_email_configuration (
          id INT AUTO_INCREMENT NOT NULL,
          emailKey VARCHAR(255) NOT NULL,
          templateId INT NOT NULL,
          senderId INT DEFAULT NULL,
          UNIQUE INDEX UNIQ_AC7A0AEC7CAEE9B0 (emailKey),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payplug_refund_history CHANGE createdAt createdAt DATETIME NOT NULL');
        $this->addSql('ALTER TABLE sylius_adjustment DROP FOREIGN KEY FK_ACA6E0F27BE036FC');
        $this->addSql('DROP INDEX IDX_ACA6E0F27BE036FC ON sylius_adjustment');
        $this->addSql('ALTER TABLE sylius_adjustment DROP shipment_id, DROP details');
        $this->addSql('ALTER TABLE sylius_shipment DROP adjustments_total');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sendinblue_email_configuration');
        $this->addSql('ALTER TABLE payplug_refund_history CHANGE createdAt createdAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sylius_adjustment ADD shipment_id INT DEFAULT NULL, ADD details JSON NOT NULL');
        $this->addSql('ALTER TABLE
          sylius_adjustment
        ADD
          CONSTRAINT FK_ACA6E0F27BE036FC FOREIGN KEY (shipment_id) REFERENCES sylius_shipment (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_ACA6E0F27BE036FC ON sylius_adjustment (shipment_id)');
        $this->addSql('ALTER TABLE sylius_shipment ADD adjustments_total INT NOT NULL');
    }
}
