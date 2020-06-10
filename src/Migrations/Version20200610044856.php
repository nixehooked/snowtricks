<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200610044856 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE trick_group');
        $this->addSql('ALTER TABLE trick ADD groups_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trick ADD CONSTRAINT FK_D8F0A91EF373DCF FOREIGN KEY (groups_id) REFERENCES `group` (id)');
        $this->addSql('CREATE INDEX IDX_D8F0A91EF373DCF ON trick (groups_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE trick_group (trick_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_A6EF447AB281BE2E (trick_id), INDEX IDX_A6EF447AFE54D947 (group_id), PRIMARY KEY(trick_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE trick_group ADD CONSTRAINT FK_A6EF447AB281BE2E FOREIGN KEY (trick_id) REFERENCES trick (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trick_group ADD CONSTRAINT FK_A6EF447AFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trick DROP FOREIGN KEY FK_D8F0A91EF373DCF');
        $this->addSql('DROP INDEX IDX_D8F0A91EF373DCF ON trick');
        $this->addSql('ALTER TABLE trick DROP groups_id');
    }
}
