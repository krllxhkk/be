CREATE TABLE Allergeen (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Naam VARCHAR(100) NOT NULL,
    Omschrijving VARCHAR(255) NOT NULL
);

INSERT INTO Allergeen (Naam, Omschrijving) VALUES
('Pinda', 'Pinda-allergie'),
('Melk', 'Melk-allergie'),
('Gluten', 'Gluten-intolerantie'),
('Ei', 'Ei-allergie');