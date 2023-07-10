<?php

namespace Core\Entity;

use Error;
use Exception;
use PDO;
use PDOException;

class Metier 
{
    private string $nom_metier;
    private string $nom_theme;

    //initialisation
    public function __construct($nom_metier = "", $nom_theme = "")
    {
        $this->nom_metier = $nom_metier;
        $this->nom_theme = $nom_theme;
    }

    //Les accesseurs

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

    public function __get($property)
    {
        return $this->$property;
    }

    public function creer()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=workskill";
        $sql = "INSERT INTO metier (nom_metier, nom_theme) 
        VALUES (:nom_metier, (SELECT nom_theme FROM theme WHERE nom_theme = :nom_theme))";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $pdo->prepare($sql);

            $query->bindParam(":nom_metier", $this->nom_metier, PDO::PARAM_STR);
            $query->bindParam(":nom_theme", $this->nom_theme, PDO::PARAM_STR);

            $query->execute();

        } catch (PDOException | Exception | Error $e) {
            echo $e->getMessage();
        }
    }


    public function modifier()
    {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "UPDATE metier (nom_metier)  WHERE nom_metier=:nom_metier";

        try {
            $pdo = new PDO($dsn, "root", "");


            $query = $pdo->prepare($sql);

            $query->bindParam(":nom_metier", $this->nom_metier, PDO::PARAM_STR);

            //mettre a jour l'id de l'objet courant
            $query->execute();
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    public function supprimer() {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "DELETE FROM metier (nom_metier) WHERE nom_metier=:nom_metier";

        try {
        $pdo = new PDO($dsn, "root", "");


        $query = $pdo-> prepare($sql);

        $query->bindParam(":nom_metier", $this->nom_metier, PDO::PARAM_STR);

        //mettre a jour l'id de l'objet courant
        $query-> execute();

        } catch(PDOException | Exception | error $e) {
            echo $e-> getMessage();
        }
    }
}