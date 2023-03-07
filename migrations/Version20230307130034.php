<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307130034 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artefact ADD type_artefact_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artefact ADD CONSTRAINT FK_8D158D2DFE3DC572 FOREIGN KEY (type_artefact_id) REFERENCES type_artefact (id)');
        $this->addSql('CREATE INDEX IDX_8D158D2DFE3DC572 ON artefact (type_artefact_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artefact DROP FOREIGN KEY FK_8D158D2DFE3DC572');
        $this->addSql('DROP INDEX IDX_8D158D2DFE3DC572 ON artefact');
        $this->addSql('ALTER TABLE artefact DROP type_artefact_id');
    }
}
