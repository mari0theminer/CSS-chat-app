<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114110435 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat_message DROP FOREIGN KEY FK_FAB3FC1659574F23');
        $this->addSql('DROP INDEX IDX_FAB3FC1659574F23 ON chat_message');
        $this->addSql('ALTER TABLE chat_message DROP send_to_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat_message ADD send_to_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chat_message ADD CONSTRAINT FK_FAB3FC1659574F23 FOREIGN KEY (send_to_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FAB3FC1659574F23 ON chat_message (send_to_id)');
    }
}
