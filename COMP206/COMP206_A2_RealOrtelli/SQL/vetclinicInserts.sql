USE vetclinic;

INSERT INTO vet VALUES
    (NULL, 'Brielle', 'Travis'),
    (NULL, 'Nerea', 'Church'),
    (NULL, 'Giselle', 'Atkinson'),
    (NULL, 'Aphrodite',	'Long'),
    (NULL, 'Dara', 'Pate');

INSERT INTO owner VALUES
    (NULL, 'Madison', 'Vance', '589-543-7765', '4658 Ut St.', 'Neumnster', '12345'),
    (NULL, 'Ray', 'IsAwesome', '555-555-5555', '123 Mega Awesome St.', 'Middle-Earth', '12345'),
    (NULL, 'Aimee', 'Craft', '683-281-4167', '379-2454 Ante Av.', 'Lisciano Niccone', '16432'),
    (NULL, 'Sasha', 'Houston', '904-433-2747', '8481 Dolor. Ave', 'Erode', '12352'),
    (NULL, 'Nevada', 'Mcclure',	'553-687-3964', '134 Awesome', 'Map Map', '75456');

INSERT INTO pet VALUES
    (NULL, 'Gannon', 1,	'Kirby'),
    (NULL, 'Karly', 2, 'Conrad'),
    (NULL, 'Nora', 3, 'Watson'),
    (NULL, 'Lana', 4, 'Luna'),
    (NULL, 'Thaddeus', 5, 'Rose');

INSERT INTO appointment VALUES
    (NULL, 1, 1, '2011-10-30 09:32:40'),
    (NULL, 2, 2, '2011-10-30 09:33:40'),
    (NULL, 3, 3, '2011-10-30 09:34:40'),
    (NULL, 4, 4, '2011-10-30 09:35:40'),
    (NULL, 5, 5, '2011-10-30 09:36:40');

INSERT INTO access VALUES 
    (NULL, 'manager', 'lisa'), 
    (NULL, 'vet', 'heather'), 
    (NULL, 'vet', 'rob'), 
    (NULL, 'tech', 'natasha'); 
