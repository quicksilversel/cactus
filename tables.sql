-- database for plants owned by user

-- if needs watering, needsWatering = 1; otherwise 0
-- if in critical condiiton, isCritical = 1; otherwise 0
CREATE TABLE plant (
    id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    plantName varchar(255) NOT NULL,
    humidity int NOT NULL,
    currentHumidity int NOT NULL,
    needsWatering tinyint(1) NOT NULL, 
    isCritical tinyint(1) NOT NULL, 
    lastWatered DATE DEFAULT NULL
);

-- database that stores optimal temperature, humidity, and native habitat by plant
CREATE TABLE plantData (
    id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    plantName varchar(255) NOT NULL,
    minTemp int NOT NULL,
    maxTamp int NOT NULL,
    minHumidity int NOT NULL,
    maxHumidity int NOT NULL,
    habitat varchar(255) NOT NULL,
);

-- sample values to plants
INSERT INTO plant VALUES 
(1, 'cactus', 20, 18, 1, 0, '2021-11-13'),
(2, 'croton', 70, 53, 0, 0, '2021-11-21'),
(3, 'snake plant', 40, 18, 0, 1, '2021-11-21');

-- sample values to plantData
INSERT INTO plantData VALUES 
(1, 'cactus', 7, 30, 40, 60, 'desert'),
(2, 'snake plant', 15, 30, 40, 60, 'tropical'),
(3, 'orchid', 20, 30, 40, 70, 'cosmopolitan'),


