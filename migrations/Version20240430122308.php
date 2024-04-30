<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430122308 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gout (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fruit ADD gout_id INT NOT NULL');
        $this->addSql('ALTER TABLE fruit ADD CONSTRAINT FK_A00BD29766B054CC FOREIGN KEY (gout_id) REFERENCES gout (id)');
        $this->addSql('CREATE INDEX IDX_A00BD29766B054CC ON fruit (gout_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fruit DROP FOREIGN KEY FK_A00BD29766B054CC');
        $this->addSql('DROP TABLE gout');
        $this->addSql('DROP INDEX IDX_A00BD29766B054CC ON fruit');
        $this->addSql('ALTER TABLE fruit DROP gout_id');
    }
}
