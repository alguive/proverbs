<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\CategoryStatusEnum;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250531094029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add attribute status to category';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE category ADD status VARCHAR(255) DEFAULT 'enabled' NOT NULL
        SQL);

        $this->addSql(
            \sprintf(
                "UPDATE category SET status = '%s' WHERE status IS NULL",
                CategoryStatusEnum::ENABLED->value
            )
        );

        $this->addSql(
            \sprintf(
                "ALTER TABLE category ALTER COLUMN status SET DEFAULT '%s'",
                CategoryStatusEnum::ENABLED->value
            )
        );

        $this->addSql(<<<'SQL'
            ALTER TABLE category ALTER COLUMN status SET NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE category DROP status
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb ALTER status SET DEFAULT 'disabled'
        SQL);
    }
}
