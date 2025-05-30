<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250530202432 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create proverb_category table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE proverb_category (id SERIAL NOT NULL, proverb_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5077679F9EE15F57 ON proverb_category (proverb_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5077679F12469DE2 ON proverb_category (category_id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb_category ADD CONSTRAINT FK_5077679F9EE15F57 FOREIGN KEY (proverb_id) REFERENCES proverb (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb_category ADD CONSTRAINT FK_5077679F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb_category DROP CONSTRAINT FK_5077679F9EE15F57
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE proverb_category DROP CONSTRAINT FK_5077679F12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE proverb_category
        SQL);
    }
}
