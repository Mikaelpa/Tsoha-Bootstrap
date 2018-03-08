-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Näyttelijä(
    id SERIAL PRIMARY KEY,
    nimi varchar(60) NOT NULL,
    kansalaisuus varchar(60),
    s_vuosi DATE
);

CREATE TABLE Arvostelu(
    id SERIAL PRIMARY KEY,
    elokuva_id INTEGER REFERENCES Elokuva(id),
    kirjoittaja varchar(60) NOT NULL,
    sisältö varchar(500) NOT NULL,
    arvosana integer NOT NULL
);

CREATE TABLE Tyylilaji(
    id SERIAL PRIMARY KEY,
    nimi varchar(60) NOT NULL  
);

CREATE TABLE Elokuva(
  id SERIAL PRIMARY KEY,
  tyyli_id varchar(50) NOT NULL,
  nimi varchar(60) NOT NULL, 
  kuvaus varchar(300) NOT NULL

);

CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
tunnus varchar(20) NOT NULL,
salasana varchar(20) NOT NULL
);