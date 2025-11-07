<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251107002157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE chargement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE chargement_produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE produit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transporteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chargement (id INT NOT NULL, client_id INT NOT NULL, transporteur_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3632875819EB6921 ON chargement (client_id)');
        $this->addSql('CREATE INDEX IDX_3632875897C86FA4 ON chargement (transporteur_id)');
        $this->addSql('COMMENT ON COLUMN chargement.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE chargement_produit (id INT NOT NULL, chargement_id INT DEFAULT NULL, produit_id INT DEFAULT NULL, quantite INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F14CDAD5B8FBE502 ON chargement_produit (chargement_id)');
        $this->addSql('CREATE INDEX IDX_F14CDAD5F347EFB ON chargement_produit (produit_id)');
        $this->addSql('COMMENT ON COLUMN chargement_produit.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE produit (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN produit.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE transporteur (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN transporteur.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('ALTER TABLE chargement ADD CONSTRAINT FK_3632875819EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chargement ADD CONSTRAINT FK_3632875897C86FA4 FOREIGN KEY (transporteur_id) REFERENCES transporteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chargement_produit ADD CONSTRAINT FK_F14CDAD5B8FBE502 FOREIGN KEY (chargement_id) REFERENCES chargement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chargement_produit ADD CONSTRAINT FK_F14CDAD5F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE chargement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE chargement_produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE produit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE transporteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE chargement DROP CONSTRAINT FK_3632875819EB6921');
        $this->addSql('ALTER TABLE chargement DROP CONSTRAINT FK_3632875897C86FA4');
        $this->addSql('ALTER TABLE chargement_produit DROP CONSTRAINT FK_F14CDAD5B8FBE502');
        $this->addSql('ALTER TABLE chargement_produit DROP CONSTRAINT FK_F14CDAD5F347EFB');
        $this->addSql('DROP TABLE chargement');
        $this->addSql('DROP TABLE chargement_produit');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE transporteur');
        $this->addSql('DROP TABLE "user"');
    }
}
