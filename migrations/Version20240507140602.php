<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507140602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, admintype INT NOT NULL, adminstatus INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bookindorder (id INT AUTO_INCREMENT NOT NULL, hotel VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, bookingdate VARCHAR(255) NOT NULL, orderdate VARCHAR(255) NOT NULL, description VARCHAR(1600) DEFAULT NULL, cabs INT NOT NULL, rent INT NOT NULL, status INT DEFAULT NULL, month VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, cabdatacount VARCHAR(255) DEFAULT NULL, time VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, destname VARCHAR(255) NOT NULL, deststatus INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, notification VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setdest (id INT AUTO_INCREMENT NOT NULL, destid_id INT NOT NULL, price VARCHAR(255) NOT NULL, status INT NOT NULL, clientname VARCHAR(255) NOT NULL, hotelid INT NOT NULL, INDEX IDX_BDA53BA18BD886F2 (destid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, adminid_id INT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, status INT NOT NULL, INDEX IDX_8D93D6492786CAC (adminid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE setdest ADD CONSTRAINT FK_BDA53BA18BD886F2 FOREIGN KEY (destid_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492786CAC FOREIGN KEY (adminid_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE setdest DROP FOREIGN KEY FK_BDA53BA18BD886F2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492786CAC');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE bookindorder');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE setdest');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
