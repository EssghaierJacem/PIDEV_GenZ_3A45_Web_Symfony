<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216200736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, note INT DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, date_publication DATE NOT NULL, INDEX IDX_8F91ABF0A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_h (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, num_commande VARCHAR(255) DEFAULT NULL, prix DOUBLE PRECISION DEFAULT NULL, code_promo VARCHAR(255) DEFAULT NULL, type_paiement VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, date_commande DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE destination (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, attractions VARCHAR(255) DEFAULT NULL, accomodation VARCHAR(255) DEFAULT NULL, devise VARCHAR(255) NOT NULL, multimedia VARCHAR(255) DEFAULT NULL, accessibilite TINYINT(1) DEFAULT NULL, cuisine_locale VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, lieu VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, organisateur VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE guide (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nationalite VARCHAR(255) DEFAULT NULL, langues_parlees VARCHAR(255) DEFAULT NULL, experiences VARCHAR(255) DEFAULT NULL, tarif_horaire DOUBLE PRECISION DEFAULT NULL, num_tel INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, categorie_h_id INT DEFAULT NULL, nom_h VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, nbr_etoile INT DEFAULT NULL, capacite INT NOT NULL, tarif_par_nuit DOUBLE PRECISION NOT NULL, INDEX IDX_4852DD9CA76ED395 (user_id), INDEX IDX_4852DD9C31FF9B85 (categorie_h_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, event_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, tel INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, INDEX IDX_AB55E24FA76ED395 (user_id), INDEX IDX_AB55E24F71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, nom_client VARCHAR(255) NOT NULL, prenom_client VARCHAR(255) DEFAULT NULL, num_tel INT DEFAULT NULL, quantite INT DEFAULT NULL, date_reservation DATE DEFAULT NULL, qr_code VARCHAR(255) DEFAULT NULL, INDEX IDX_42C84955A76ED395 (user_id), UNIQUE INDEX UNIQ_42C8495582EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournee (id INT AUTO_INCREMENT NOT NULL, destination_id INT DEFAULT NULL, guide_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE DEFAULT NULL, duree VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, tarif DOUBLE PRECISION DEFAULT NULL, monuments VARCHAR(255) DEFAULT NULL, tranche_age VARCHAR(255) DEFAULT NULL, moyen_transport VARCHAR(255) DEFAULT NULL, INDEX IDX_EBF67D7E816C6140 (destination_id), INDEX IDX_EBF67D7ED7ED1D4B (guide_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, cin INT NOT NULL, photo VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_destination (user_id INT NOT NULL, destination_id INT NOT NULL, INDEX IDX_97DDF73FA76ED395 (user_id), INDEX IDX_97DDF73F816C6140 (destination_id), PRIMARY KEY(user_id, destination_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vol (id INT AUTO_INCREMENT NOT NULL, destination_id INT DEFAULT NULL, compagnie_a VARCHAR(255) NOT NULL, num_vol INT NOT NULL, aeroport_depart VARCHAR(255) NOT NULL, aeroport_arrivee VARCHAR(255) NOT NULL, date_depart DATE NOT NULL, date_arrivee DATE NOT NULL, duree_vol INT NOT NULL, tarif DOUBLE PRECISION NOT NULL, INDEX IDX_95C97EB816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C31FF9B85 FOREIGN KEY (categorie_h_id) REFERENCES categorie_h (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE tournee ADD CONSTRAINT FK_EBF67D7E816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
        $this->addSql('ALTER TABLE tournee ADD CONSTRAINT FK_EBF67D7ED7ED1D4B FOREIGN KEY (guide_id) REFERENCES guide (id)');
        $this->addSql('ALTER TABLE user_destination ADD CONSTRAINT FK_97DDF73FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_destination ADD CONSTRAINT FK_97DDF73F816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vol ADD CONSTRAINT FK_95C97EB816C6140 FOREIGN KEY (destination_id) REFERENCES destination (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CA76ED395');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C31FF9B85');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA76ED395');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F71F7E88B');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495582EA2E54');
        $this->addSql('ALTER TABLE tournee DROP FOREIGN KEY FK_EBF67D7E816C6140');
        $this->addSql('ALTER TABLE tournee DROP FOREIGN KEY FK_EBF67D7ED7ED1D4B');
        $this->addSql('ALTER TABLE user_destination DROP FOREIGN KEY FK_97DDF73FA76ED395');
        $this->addSql('ALTER TABLE user_destination DROP FOREIGN KEY FK_97DDF73F816C6140');
        $this->addSql('ALTER TABLE vol DROP FOREIGN KEY FK_95C97EB816C6140');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie_h');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE destination');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE guide');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE tournee');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_destination');
        $this->addSql('DROP TABLE vol');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
