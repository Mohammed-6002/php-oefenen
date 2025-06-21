-- DATABASE aanmaken
CREATE DATABASE IF NOT EXISTS leerlingen_beoordeling;
USE leerlingen_beoordeling;

-- Leerlingentabel
CREATE TABLE leerling (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    klas VARCHAR(50) NOT NULL
);

-- Toetsentabel
CREATE TABLE toets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    leerling_id INT NOT NULL,
    vak VARCHAR(100) NOT NULL,
    cijfer DECIMAL(4,2) NOT NULL,
    FOREIGN KEY (leerling_id) REFERENCES leerling(id) ON DELETE CASCADE
);

-- Voorbeeldleerlingen
INSERT INTO leerling (naam, klas) VALUES
('Fatima El Idrissi', '3A'),
('Lars de Vries', '3A'),
('Aylin Demir', '3B');

-- Voorbeeldtoetsen
INSERT INTO toets (leerling_id, vak, cijfer) VALUES
(1, 'Nederlands', 7.5),
(1, 'Wiskunde', 6.8),
(2, 'Biologie', 8.1),
(2, 'Wiskunde', 5.9),
(3, 'Nederlands', 7.9),
(3, 'Aardrijkskunde', 6.5);
