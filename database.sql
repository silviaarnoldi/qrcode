
CREATE DATABASE IF NOT EXISTS macchinari_db;
USE macchinari_db;

CREATE TABLE IF NOT EXISTS macchinari (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255),
  descrizione TEXT
);

CREATE TABLE IF NOT EXISTS file_manutenzione (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_macchinario INT,
  nome_file VARCHAR(255),
  path_file VARCHAR(255),
  tipo_file VARCHAR(50),
  FOREIGN KEY (id_macchinario) REFERENCES macchinari(id)
);

INSERT INTO macchinari (nome, descrizione) VALUES
('Macchinario 1', 'Descrizione del macchinario 1');

-- Per test carica qualche file dopo upload
