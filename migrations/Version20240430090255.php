<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430090255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fruit_color (fruit_id INT NOT NULL, color_id INT NOT NULL, INDEX IDX_114174D6BAC115F0 (fruit_id), INDEX IDX_114174D67ADA1FB5 (color_id), PRIMARY KEY(fruit_id, color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fruit_color ADD CONSTRAINT FK_114174D6BAC115F0 FOREIGN KEY (fruit_id) REFERENCES fruit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fruit_color ADD CONSTRAINT FK_114174D67ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fruit DROP colors');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fruit_color DROP FOREIGN KEY FK_114174D6BAC115F0');
        $this->addSql('ALTER TABLE fruit_color DROP FOREIGN KEY FK_114174D67ADA1FB5');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE fruit_color');
        $this->addSql('ALTER TABLE fruit ADD colors VARCHAR(255) NOT NULL');
    }
}
