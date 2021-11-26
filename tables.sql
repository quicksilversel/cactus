CREATE TABLE plant (
    id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    plantName varchar(255) NOT NULL,
    needsWatering tinyint(1) NOT NULL, 
    isCritical tinyint(1) NOT NULL, 
    lastWatered DATE DEFAULT NULL
);

-- if needs watering, needsWatering = 1
-- if in critical condiiton, isCritical = 1
INSERT INTO plant VALUES 
(1, 'cactus', 1, 0, '2021-11-13'),
(2, 'croton', 0, 0, '2021-11-21'),
(3, 'snake plant', 0, 1, '2021-11-21')
;
