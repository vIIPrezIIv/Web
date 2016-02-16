DROP DATABASE IF EXISTS vetclinic;
CREATE DATABASE vetclinic;
USE vetclinic;

CREATE TABLE owner (
	owner_id INT(10) PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(45),
    lastname VARCHAR(45),
    phone VARCHAR(12),
    street_address VARCHAR(45),
    city VARCHAR(20),
    postal_code VARCHAR(8)
);

CREATE TABLE vet (
	vet_id INT(10) PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(45),
    lastname VARCHAR(45)
);

CREATE TABLE pet (
	pet_id INT(10) PRIMARY KEY AUTO_INCREMENT,
    petname VARCHAR(45),
    owner_id INT(10),
    breed VARCHAR(20),
		FOREIGN KEY (owner_id)
			REFERENCES owner (owner_id)
);

CREATE TABLE appointment (
	appointment_id INT(10) PRIMARY KEY AUTO_INCREMENT,
	vet_id INT(10) NOT NULL,
    pet_id INT(10) NOT NULL,
    appt_time DATETIME,
		FOREIGN KEY (vet_id)
			REFERENCES vet (vet_id),
		FOREIGN KEY (pet_id)
			REFERENCES pet (pet_id)
);

CREATE TABLE access (
	accessId INT PRIMARY KEY AUTO_INCREMENT,
	accessRole ENUM ('tech', 'vet', 'manager'),
	userName VARCHAR(12)
);

CREATE USER 'manager'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT, UPDATE ON vetclinic.access TO 'manager'@'localhost'; 

CREATE USER 'tech'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT, UPDATE, DELETE, INSERT ON vetclinic.pet TO 'tech'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON vetclinic.owner TO 'tech'@'localhost';
GRANT SELECT, UPDATE, DELETE, INSERT ON vetclinic.appointment TO 'tech'@'localhost';

CREATE USER 'vet'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT ON vetclinic.appointment TO 'vet'@'localhost';