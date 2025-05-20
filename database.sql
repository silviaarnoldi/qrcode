
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
CREATE TABLE UTENTE (
    ID INTEGER PRIMARY KEY AUTO_INCREMENT,
    USERNAME VARCHAR(255),
    PASSWORD VARCHAR(255),
    NOME VARCHAR(255),
    COGNOME VARCHAR(255)
);

INSERT INTO macchinari (nome, descrizione) VALUES
('Macchinario 1', 'Descrizione del macchinario 1');
INSERT INTO UTENTE (USERNAME, PASSWORD, NOME, COGNOME) VALUES
('admin', '1a01b60f1adf59e6cc9349e49d68d6b9', 'Claudio', 'Chigioni'),
('admin2', '1a01b60f1adf59e6cc9349e49d68d6b9', 'Silvia', 'Arnoldi');

-- Per test carica qualche file dopo upload
