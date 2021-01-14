<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210111104709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat_message ADD chat_room_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chat_message ADD CONSTRAINT FK_FAB3FC161819BCFA FOREIGN KEY (chat_room_id) REFERENCES chat_room (id)');
        $this->addSql('CREATE INDEX IDX_FAB3FC161819BCFA ON chat_message (chat_room_id)');
        $this->addSql('ALTER TABLE chat_room ADD hash VARCHAR(255) NOT NULL');
        $this->addSql('INSERT into chat_room (name, public,hash) VALUES ("MAIN Chat",1,"MAIN_CHAT")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE chat_message DROP FOREIGN KEY FK_FAB3FC161819BCFA');
        $this->addSql('DROP INDEX IDX_FAB3FC161819BCFA ON chat_message');
        $this->addSql('ALTER TABLE chat_message DROP chat_room_id');
        $this->addSql('ALTER TABLE chat_room DROP hash');
        $this->addSql('DELETE FROM chat_room Where hash="MAIN_CHAT";');

    }
}
