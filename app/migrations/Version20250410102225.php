<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410102225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE manga_tag (manga_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_52E8F5BA7B6461 (manga_id), INDEX IDX_52E8F5BABAD26311 (tag_id), PRIMARY KEY(manga_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE manga_tag ADD CONSTRAINT FK_52E8F5BA7B6461 FOREIGN KEY (manga_id) REFERENCES manga (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE manga_tag ADD CONSTRAINT FK_52E8F5BABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B783DDC4978F');
        $this->addSql('DROP INDEX IDX_389B783DDC4978F ON tag');
        $this->addSql('ALTER TABLE tag DROP mangas_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE manga_tag DROP FOREIGN KEY FK_52E8F5BA7B6461');
        $this->addSql('ALTER TABLE manga_tag DROP FOREIGN KEY FK_52E8F5BABAD26311');
        $this->addSql('DROP TABLE manga_tag');
        $this->addSql('ALTER TABLE tag ADD mangas_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B783DDC4978F FOREIGN KEY (mangas_id) REFERENCES manga (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_389B783DDC4978F ON tag (mangas_id)');
    }
}
