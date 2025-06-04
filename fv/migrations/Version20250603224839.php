<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603224839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, fecha DATETIME NOT NULL, tipo VARCHAR(255) NOT NULL, usuario_id INT DEFAULT NULL, campanya_id BINARY(16) DEFAULT NULL, INDEX IDX_47860B05DB38439E (usuario_id), INDEX IDX_47860B056C8FFE79 (campanya_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evento ADD CONSTRAINT FK_47860B05DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evento ADD CONSTRAINT FK_47860B056C8FFE79 FOREIGN KEY (campanya_id) REFERENCES campanya (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE evento DROP FOREIGN KEY FK_47860B05DB38439E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE evento DROP FOREIGN KEY FK_47860B056C8FFE79
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE evento
        SQL);
    }
}
