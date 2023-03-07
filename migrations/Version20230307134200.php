<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307134200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan ADD effet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DE76D37FA FOREIGN KEY (effet_id) REFERENCES effet (id)');
        $this->addSql('CREATE INDEX IDX_DD5A5B7DE76D37FA ON plan (effet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DE76D37FA');
        $this->addSql('DROP INDEX IDX_DD5A5B7DE76D37FA ON plan');
        $this->addSql('ALTER TABLE plan DROP effet_id');
    }
}
