<?php

namespace Core\Entity;

use Error;
use Exception;
use PDO;
use PDOException;

class Skill
{
    private string $nom_famille_competence;

    //initialisation
    public function __construct($nom_famille_competence = "")
    {
        $this->nom_famille_competence = $nom_famille_competence;
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
        $sql = "INSERT INTO famille_competence (nom_famille_competence) VALUES (:nom_famille_competence)";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $query = $pdo->prepare($sql);

            $query->bindParam(":nom_famille_competence",$this->nom_famille_competence, PDO::PARAM_STR);


            $query->execute();

        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();

        }
    }

    public function existe()
        {
            $dsn = "mysql:host=localhost;port=3306;dbname=workskill";
            $sql = "SELECT * FROM famille_competence (nom_famille_competence) VALUES (:nom_famille_competence)";
    
            try {
                $pdo = new PDO($dsn, "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                $query = $pdo->prepare($sql);
    
                $query->bindParam(":nom_famille_competence", $this->nom_famille_competence, PDO::PARAM_STR);
    
                $query->execute();
    
                return $query->fetch(PDO::FETCH_ASSOC);
    
            } catch (PDOException | Exception | error $e) {
                echo $e->getMessage();
            }
        }

    public function modifier()
    {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "UPDATE famille_competence (nom_famille_competence) WHERE nom_famille_competence=:nom_famille_competence";

        try {
            $pdo = new PDO($dsn, "root", "");


            $query = $pdo->prepare($sql);

            $query->bindParam(":nom_famille_competence", $this->nom_famille_competence, PDO::PARAM_STR);

            //mettre a jour l'id de l'objet courant
            $query->execute();
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    public function supprimer() {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "DELETE FROM famille_competence nom WHERE nom_famille_de_competence=:nom_famille_de_competence";

        try {
        $pdo = new PDO($dsn, "root", "");


        $query = $pdo-> prepare($sql);

        $query-> bindParam(":nom_famille_de_competence", $this-> nom_famille_de_competence, PDO::PARAM_STR);

        //mettre a jour l'id de l'objet courant
        $query-> execute();

        } catch(PDOException | Exception | error $e) {
            echo $e-> getMessage();
        }

    }
}
