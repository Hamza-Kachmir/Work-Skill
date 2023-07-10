<?php

namespace Core\Entity;

use Error;
use Exception;
use PDO;
use PDOException;

class Theme 
{
    private string $nom_theme;

    //initialisation
    public function __construct($nom_theme = "")
    {
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
        $sql = "INSERT INTO theme (nom_theme) VALUES (:nom_theme)";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $pdo->prepare($sql);

            $query->bindParam(":nom_theme", $this->nom_theme, PDO::PARAM_STR);

            $query->execute();

        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }
        public function existe()
        {
            $dsn = "mysql:host=localhost;port=3306;dbname=workskill";
            $sql = "SELECT * FROM theme WHERE nom_theme = :nom_theme";
    
            try {
                $pdo = new PDO($dsn, "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                $query = $pdo->prepare($sql);
    
                $query->bindParam(":nom_theme", $this->nom_theme, PDO::PARAM_STR);
    
                $query->execute();
    
                return $query->fetch(PDO::FETCH_ASSOC);
    
            } catch (PDOException | Exception | error $e) {
                echo $e->getMessage();
            }
        }

        public function modifier()
        {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "UPDATE theme (nom_theme) WHERE nom_theme=:nom_theme";

        try {
            $pdo = new PDO($dsn, "root", "");


            $query = $pdo->prepare($sql);

            $query->bindParam(":nom_theme", $this->nom_theme, PDO::PARAM_STR);

            //mettre a jour l'id de l'objet courant
            $query->execute();
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    public function supprimer() {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "DELETE FROM theme (nom_theme) WHERE nom_theme=:nom_theme";

        try {
        $pdo = new PDO($dsn, "root", "");


        $query = $pdo-> prepare($sql);

        $query->bindParam(":nom_theme", $this->nom_theme, PDO::PARAM_STR);

        //mettre a jour l'id de l'objet courant
        $query-> execute();

        } catch(PDOException | Exception | error $e) {
            echo $e-> getMessage();
        }

    }
}