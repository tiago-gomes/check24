<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200619104143 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, name VARCHAR(35) DEFAULT NULL, url VARCHAR(125) NOT NULL, comment VARCHAR(255) NOT NULL, createdAt DATE DEFAULT NULL, updatedAt DATE DEFAULT NULL, deletedAt DATE DEFAULT NULL, UNIQUE INDEX UNIQ_9474526CF47645AE (url), UNIQUE INDEX UNIQ_9474526C9474526C (comment), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(254) DEFAULT NULL, description TEXT DEFAULT NULL, author VARCHAR(254) DEFAULT NULL, createdAt DATE DEFAULT NULL, updatedAt DATE DEFAULT NULL, deletedAt DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(35) DEFAULT NULL, last_name VARCHAR(35) DEFAULT NULL, email VARCHAR(75) NOT NULL, password VARCHAR(75) NOT NULL, createdAt DATE DEFAULT NULL, updatedAt DATE DEFAULT NULL, deletedAt DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D64935C246D5 (password), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE user');
    }
}
