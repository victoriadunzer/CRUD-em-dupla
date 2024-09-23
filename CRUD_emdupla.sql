create database CRUDEm2VJ;
use CRUDEm2VJ; 

CREATE TABLE professor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);
CREATE TABLE aulas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sala VARCHAR(50) NOT NULL
);
CREATE TABLE diario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_professor INT,
    id_aula INT,
    hora_aula TIME NOT NULL,
    FOREIGN KEY (id_professor) REFERENCES professor(id),
    FOREIGN KEY (id_aula) REFERENCES aulas(id)
); 

INSERT INTO professor (nome) VALUES 
('Maria Silva'),
('João Pereira'),
('Ana Costa');
INSERT INTO aulas (sala) VALUES 
('Sala 101'),
('Sala 102'),
('Laboratório de Química');
INSERT INTO diario (id_professor, id_aula, hora_aula) VALUES 
(1, 1, '08:00:00'),  -- Maria Silva, Sala 101
(2, 2, '09:30:00'),  -- João Pereira, Sala 102
(3, 3, '14:00:00');  -- Ana Costa, Laboratório de Química