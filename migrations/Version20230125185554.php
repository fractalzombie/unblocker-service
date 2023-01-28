<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230125185554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Subnet table migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE subnet (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', external_id VARCHAR(32) DEFAULT NULL, address VARCHAR(15) NOT NULL, mask SMALLINT NOT NULL, country VARCHAR(64) NOT NULL, state VARCHAR(16) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', UNIQUE INDEX UNIQ_91C242169F75D7B0 (external_id), UNIQUE INDEX UNIQ_91C24216D4E6F817F6FC330 (address, mask), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE subnet');
    }
}
