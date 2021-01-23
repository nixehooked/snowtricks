<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200613073229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD trick_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id)');
        $this->addSql('CREATE INDEX IDX_9474526CB281BE2E ON comment (trick_id)');
        $this->addSql('ALTER TABLE image CHANGE alternatif alternatif VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE trick CHANGE groups_id groups_id INT DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE image_id image_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB281BE2E');
        $this->addSql('DROP INDEX IDX_9474526CB281BE2E ON comment');
        $this->addSql('ALTER TABLE comment DROP trick_id');
        $this->addSql('ALTER TABLE image CHANGE alternatif alternatif VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE trick CHANGE groups_id groups_id INT DEFAULT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE image_id image_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
