# POO

## P001

### PHP

    LANCER LE SERVEUR WEB AVEC PHP

    php -S localhost:87

    ON PEUT UTILISER LES URLS SANS EXTENSION POUR index.php
    
    localhost:87/mapage
    localhost:87/mondossier/
    localhost:87/mondossier/mapage

    MAIS PAS LES URLS AVEC EXTENSIONS QUI RENVERRONT DES ERREURS

    localhost:87/mapage.php
    localhost:87/mondossier/mapage.php

## BaseTrait ET __callStatic

    ON MET EN PLACE UN GENERATEUR DE CODE DE CLASSE
    ET EN PLUS UN GENERATEUR DE CODE DE METHODE STATIC
    GRACE A UN TRAIT COMMUN A TOUTES LES CLASSES 
    BaseTrait

    // https://www.php.net/manual/fr/language.oop5.overloading.php#object.callstatic

    Exception: LA CLASSE App SERT DE CLASSE BOOTSTRAP, DONC NE PEUT PAS FAIRE UN use BaseTrait


## SQLITE

    SI BESOIN, INSTALLER LE MODULE PDO SQLITE3
    sudo apt install php-sqlite3

    https://www.sqlitetutorial.net/

    CREATE TABLE IF NOT EXISTS content (
        id          INTEGER PRIMARY KEY,
        title       VARCHAR(160),
        image       VARCHAR(160),
        category    VARCHAR(160),
        code        TEXT
    )

    NOTE:
    CREATE TABLE EST DIFFERENT DE SQL

    COLONNE OBLIGATOIRE:
        id          INTEGER PRIMARY KEY,

    INSERT EST IDENTIQUE A SQL

    SELECT EST IDENTIQUE

