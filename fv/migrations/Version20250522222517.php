<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522222517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conjuro (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, nivel INT NOT NULL, escuela VARCHAR(255) NOT NULL, descripcion LONGTEXT DEFAULT NULL, componentes VARCHAR(255) DEFAULT NULL, requiere_concentracion TINYINT(1) NOT NULL, ritual TINYINT(1) NOT NULL, clases_permitidas JSON NOT NULL, tiempo_lanzamiento VARCHAR(255) NOT NULL, duracion VARCHAR(255) NOT NULL, alcance VARCHAR(255) NOT NULL, a_niveles_superiores LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE personaje_conjuros (personaje_id BINARY(16) NOT NULL, conjuro_id INT NOT NULL, INDEX IDX_3131A5BD121EFAFB (personaje_id), INDEX IDX_3131A5BD929FECF8 (conjuro_id), PRIMARY KEY(personaje_id, conjuro_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, correo VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_CORREO (correo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE personaje_conjuros ADD CONSTRAINT FK_3131A5BD121EFAFB FOREIGN KEY (personaje_id) REFERENCES personaje (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personaje_conjuros ADD CONSTRAINT FK_3131A5BD929FECF8 FOREIGN KEY (conjuro_id) REFERENCES conjuro (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personaje ADD jugador VARCHAR(255) NOT NULL, ADD trasfondo VARCHAR(255) NOT NULL, ADD experiencia INT NOT NULL, ADD raza VARCHAR(255) NOT NULL, ADD clases_niveles JSON NOT NULL, ADD clases_lanzadoras_conjuros JSON NOT NULL, ADD alineamiento VARCHAR(255) NOT NULL, ADD idiomas JSON NOT NULL, ADD inspiracion INT NOT NULL, ADD velocidad INT NOT NULL, ADD resistencias JSON NOT NULL, ADD vulnerabilidades JSON NOT NULL, ADD inmunidades JSON NOT NULL, ADD dado_golpe_tipo VARCHAR(255) NOT NULL, ADD xp_proximo_nivel INT NOT NULL, ADD estado_actual VARCHAR(255) NOT NULL, ADD competencias_herramientas JSON NOT NULL, ADD notas LONGTEXT DEFAULT NULL, ADD atributos JSON NOT NULL, ADD tiradas_salvacion JSON NOT NULL, ADD habilidades JSON NOT NULL, ADD puntos_golpe INT NOT NULL, ADD puntos_golpe_temporales INT NOT NULL, ADD iniciativa INT NOT NULL, ADD dados_golpe VARCHAR(255) NOT NULL, ADD magia TINYINT(1) NOT NULL, ADD cd_conjuro INT DEFAULT NULL, ADD ataque_conjuro INT DEFAULT NULL, ADD conjuros_extra JSON NOT NULL, ADD carga_maxima INT NOT NULL, ADD monedas VARCHAR(255) NOT NULL, ADD armas JSON NOT NULL, ADD equipo JSON NOT NULL, ADD rasgos_personalidad LONGTEXT NOT NULL, ADD ideales LONGTEXT NOT NULL, ADD vinculos LONGTEXT NOT NULL, ADD defectos LONGTEXT NOT NULL, CHANGE ca ca INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personaje_conjuros DROP FOREIGN KEY FK_3131A5BD121EFAFB');
        $this->addSql('ALTER TABLE personaje_conjuros DROP FOREIGN KEY FK_3131A5BD929FECF8');
        $this->addSql('DROP TABLE conjuro');
        $this->addSql('DROP TABLE personaje_conjuros');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('ALTER TABLE personaje DROP jugador, DROP trasfondo, DROP experiencia, DROP raza, DROP clases_niveles, DROP clases_lanzadoras_conjuros, DROP alineamiento, DROP idiomas, DROP inspiracion, DROP velocidad, DROP resistencias, DROP vulnerabilidades, DROP inmunidades, DROP dado_golpe_tipo, DROP xp_proximo_nivel, DROP estado_actual, DROP competencias_herramientas, DROP notas, DROP atributos, DROP tiradas_salvacion, DROP habilidades, DROP puntos_golpe, DROP puntos_golpe_temporales, DROP iniciativa, DROP dados_golpe, DROP magia, DROP cd_conjuro, DROP ataque_conjuro, DROP conjuros_extra, DROP carga_maxima, DROP monedas, DROP armas, DROP equipo, DROP rasgos_personalidad, DROP ideales, DROP vinculos, DROP defectos, CHANGE ca ca VARCHAR(255) NOT NULL');
    }
}
