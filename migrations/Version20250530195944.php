<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530195944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create proverb & proverb_content tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE proverb (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN proverb.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN proverb.updated_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE proverb_content (id SERIAL NOT NULL, proverb_id INT NOT NULL, content TEXT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_767F4D9C9EE15F57 ON proverb_content (proverb_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb_content ADD CONSTRAINT FK_767F4D9C9EE15F57 FOREIGN KEY (proverb_id) REFERENCES proverb (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb_content DROP CONSTRAINT FK_767F4D9C9EE15F57
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE proverb
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE proverb_content
        SQL);
    }
}
