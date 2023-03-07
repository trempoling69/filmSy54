<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230307145427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plan_artefact (plan_id INT NOT NULL, artefact_id INT NOT NULL, INDEX IDX_8370BA57E899029B (plan_id), INDEX IDX_8370BA57B52412E3 (artefact_id), PRIMARY KEY(plan_id, artefact_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plan_artefact ADD CONSTRAINT FK_8370BA57E899029B FOREIGN KEY (plan_id) REFERENCES plan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_artefact ADD CONSTRAINT FK_8370BA57B52412E3 FOREIGN KEY (artefact_id) REFERENCES artefact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plan_artefact DROP FOREIGN KEY FK_8370BA57E899029B');
        $this->addSql('ALTER TABLE plan_artefact DROP FOREIGN KEY FK_8370BA57B52412E3');
        $this->addSql('DROP TABLE plan_artefact');
    }
}
