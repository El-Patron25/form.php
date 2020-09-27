
-- Create DataBase
CREATE DATABASE IF NOT EXISTS project1;

-- Create Table Account
CREATE TABLE account(
    id INT NOT NULL AUTO_INCREMENT,
    gebruikersnaam VARCHAR(250) UNIQUE,
    email VARCHAR (250) UNIQUE NOT NULL,
    password VARCHAR (250) NOT NULL,
    PRIMARY KEY(id)
    );
    
    -- Create Table Persoon
    CREATE TABLE persoon(
        id INT NOT NULL AUTO_INCREMENT,
        voornaam VARCHAR(250) NOT NULL,
        tussenvoegsel VARCHAR(250),
        achternaam VARCHAR(250) NOT NULL,
        account_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY(account_id) REFERENCES account(id)
        
        );

    SELECT account.gebruikersnaam, persoon.voornaam, persoon.achternaam FROM account
    INNER JOIN persoon ON account.id = persoon.account_id