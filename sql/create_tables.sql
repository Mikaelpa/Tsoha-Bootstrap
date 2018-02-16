-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Ohjaaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(60) NOT NULL,
    kansalaisuus varchar(60),
    s_vuosi DATE
);

CREATE TABLE Näyttelijä(
    id SERIAL PRIMARY KEY,
    nimi varchar(60) NOT NULL,
    kansalaisuus varchar(60),
    s_vuosi DATE
);

CREATE TABLE Arvostelu(
    id SERIAL PRIMARY KEY,
    elokuva_id INTEGER REFERENCES Elokuva(id)
    kirjoittaja varchar(60) NOT NULL,
    sisältö varchar(500)
);

CREATE TABLE Tyylilaji(
    id SERIAL PRIMARY KEY,
    nimi varchar(60) NOT NULL  
);

CREATE TABLE Elokuva(
  id SERIAL PRIMARY KEY,
--  näyttelijä_id INTEGER REFERENCES Näyttelijä(id),
--  ohjaaja_id INTEGER REFERENCES Ohjaaja(id),
  tyyli_id varchar(50),
  nimi varchar(60) NOT NULL, 
  kuvaus varchar(300) NOT NULL
--  julkaisuvuosi DATE
);

CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
tunnus varchar(20) NOT NULL,
salasana varchar(20) NOT NULL
);