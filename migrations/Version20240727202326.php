<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use UnBlockerService\Domain\Common\Enum\DatabasePlatform;
use UnBlockerService\Domain\Common\Helper\DatabaseHelper;

final class Version20240727202326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create subnet table';
    }

    public function up(Schema $schema): void
    {
        match (DatabaseHelper::getPlatformFromConnection($this->connection)) {
            DatabasePlatform::SQLite => $this->upSQLite(),
            DatabasePlatform::MySQL => $this->upMySQL(),
        };
    }

    public function upMySQL(): void
    {
        $this->addSql(
            <<<SQL
                    CREATE TABLE subnet (
                      id            CHAR(36)    NOT NULL PRIMARY KEY,
                      external_id   VARCHAR(32) DEFAULT NULL,
                      address       VARCHAR(15) NOT NULL,
                      mask          SMALLINT    NOT NULL,
                      state         VARCHAR(16) NOT NULL,
                      country       VARCHAR(64) NOT NULL,
                      created_at    DATETIME    NOT NULL,
                      updated_at    DATETIME    NOT NULL
                    ) DEFAULT       CHARACTER   SET utf8mb4;
                SQL
        );

        $this->addSql(
            <<<SQL
                    CREATE UNIQUE INDEX UNIQ_91C242169F75D7B0
                        ON subnet (external_id);
                SQL
        );

        $this->addSql(
            <<<SQL
                    CREATE UNIQUE INDEX UNIQ_91C24216D4E6F817F6FC330
                        ON subnet (address, mask);
                SQL
        );
    }

    public function upSQLite(): void
    {
        $this->addSql(
            <<<SQL
                    CREATE TABLE subnet (
                        id          CHAR(36)    NOT NULL,
                        external_id VARCHAR(32) DEFAULT NULL,
                        address     VARCHAR(15) NOT NULL,
                        mask        SMALLINT    NOT NULL,
                        state       VARCHAR(16) NOT NULL,
                        country     VARCHAR(64) NOT NULL,
                        created_at  DATETIME    NOT NULL,
                        updated_at  DATETIME    NOT NULL,
                        PRIMARY KEY (id)
                    );
                SQL
        );

        $this->addSql(
            <<<SQL
                    CREATE UNIQUE INDEX UNIQ_91C242169F75D7B0
                        ON subnet (external_id);
                SQL
        );

        $this->addSql(
            <<<SQL
                    CREATE UNIQUE INDEX UNIQ_91C24216D4E6F817F6FC330
                        ON subnet (address, mask);
                SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE subnet');
    }
}
