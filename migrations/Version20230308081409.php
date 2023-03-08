<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308081409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artefact (id INT AUTO_INCREMENT NOT NULL, type_artefact_id INT DEFAULT NULL, nom VARCHAR(45) DEFAULT NULL, details VARCHAR(512) DEFAULT NULL, INDEX IDX_8D158D2DFE3DC572 (type_artefact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE effet (id INT AUTO_INCREMENT NOT NULL, effet VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan (id INT AUTO_INCREMENT NOT NULL, effet_id INT DEFAULT NULL, reference VARCHAR(20) NOT NULL, duree INT DEFAULT NULL, echelle VARCHAR(10) DEFAULT NULL, dialogues VARCHAR(1000) DEFAULT NULL, INDEX IDX_DD5A5B7DE76D37FA (effet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plan_artefact (plan_id INT NOT NULL, artefact_id INT NOT NULL, INDEX IDX_8370BA57E899029B (plan_id), INDEX IDX_8370BA57B52412E3 (artefact_id), PRIMARY KEY(plan_id, artefact_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_artefact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artefact ADD CONSTRAINT FK_8D158D2DFE3DC572 FOREIGN KEY (type_artefact_id) REFERENCES type_artefact (id)');
        $this->addSql('ALTER TABLE plan ADD CONSTRAINT FK_DD5A5B7DE76D37FA FOREIGN KEY (effet_id) REFERENCES effet (id)');
        $this->addSql('ALTER TABLE plan_artefact ADD CONSTRAINT FK_8370BA57E899029B FOREIGN KEY (plan_id) REFERENCES plan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plan_artefact ADD CONSTRAINT FK_8370BA57B52412E3 FOREIGN KEY (artefact_id) REFERENCES artefact (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artefact DROP FOREIGN KEY FK_8D158D2DFE3DC572');
        $this->addSql('ALTER TABLE plan DROP FOREIGN KEY FK_DD5A5B7DE76D37FA');
        $this->addSql('ALTER TABLE plan_artefact DROP FOREIGN KEY FK_8370BA57E899029B');
        $this->addSql('ALTER TABLE plan_artefact DROP FOREIGN KEY FK_8370BA57B52412E3');
        $this->addSql('DROP TABLE artefact');
        $this->addSql('DROP TABLE effet');
        $this->addSql('DROP TABLE plan');
        $this->addSql('DROP TABLE plan_artefact');
        $this->addSql('DROP TABLE type_artefact');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
