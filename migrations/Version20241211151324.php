<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241211151324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C4D8CCBCC');
        $this->addSql('DROP INDEX IDX_6A2CA10C4D8CCBCC ON media');
        $this->addSql('ALTER TABLE media DROP watch_history_id');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE subscribed_at subscribed_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494D8CCBCC');
        $this->addSql('DROP INDEX IDX_8D93D6494D8CCBCC ON user');
        $this->addSql('ALTER TABLE user DROP watch_history_id');
        $this->addSql('ALTER TABLE watch_history ADD watcher_id INT NOT NULL, ADD media_id INT NOT NULL');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8C300AB5D FOREIGN KEY (watcher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE watch_history ADD CONSTRAINT FK_DE44EFD8EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8C300AB5D ON watch_history (watcher_id)');
        $this->addSql('CREATE INDEX IDX_DE44EFD8EA9FDD75 ON watch_history (media_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE media ADD watch_history_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4D8CCBCC FOREIGN KEY (watch_history_id) REFERENCES watch_history (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4D8CCBCC ON media (watch_history_id)');
        $this->addSql('ALTER TABLE playlist_subscription CHANGE subscribed_at subscribed_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD watch_history_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494D8CCBCC FOREIGN KEY (watch_history_id) REFERENCES watch_history (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494D8CCBCC ON user (watch_history_id)');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8C300AB5D');
        $this->addSql('ALTER TABLE watch_history DROP FOREIGN KEY FK_DE44EFD8EA9FDD75');
        $this->addSql('DROP INDEX IDX_DE44EFD8C300AB5D ON watch_history');
        $this->addSql('DROP INDEX IDX_DE44EFD8EA9FDD75 ON watch_history');
        $this->addSql('ALTER TABLE watch_history DROP watcher_id, DROP media_id');
    }
}
