<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251107214856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, relation_language_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1E67002EE (relation_language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE snippet (id INT AUTO_INCREMENT NOT NULL, relation_category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, syntax LONGTEXT NOT NULL, INDEX IDX_961C8CD576C725F8 (relation_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1E67002EE FOREIGN KEY (relation_language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE snippet ADD CONSTRAINT FK_961C8CD576C725F8 FOREIGN KEY (relation_category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1E67002EE');
        $this->addSql('ALTER TABLE snippet DROP FOREIGN KEY FK_961C8CD576C725F8');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE snippet');
    }
}
