<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250603001744 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE campanya ADD resumen_sesion LONGTEXT DEFAULT NULL, ADD estado_actual VARCHAR(100) NOT NULL, ADD localizacion_actual VARCHAR(255) NOT NULL, ADD dia_en_el_calendario VARCHAR(100) NOT NULL, ADD notas_director LONGTEXT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE campanya DROP resumen_sesion, DROP estado_actual, DROP localizacion_actual, DROP dia_en_el_calendario, DROP notas_director
        SQL);
    }
}
