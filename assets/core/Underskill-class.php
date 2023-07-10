<?php

namespace Core\Entity;

use \PDO;
use \PDOException;
use \Exception;
use \Error;

class Underskill
{
    /* attributs (propriete properties) */
    private int $id;
    private string $description;

    /** Constructeur */
    public function __construct($id = 0, $description = "")
    {
        $this->id = $id;
        $this->description = $description;
    }

    /** Accesseurs */
    // setters magiques
    public function __set($attribut, $valeur)
    {
        $this->$attribut = $valeur;
    }

    // getters magiques
    public function __get($attribut)
    {
        return $this->$attribut;
    }

    public function creer()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=workskill";
        $sql = "INSERT INTO competence (id, description) VALUES (:id, :description)";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $query = $pdo->prepare($sql);

            $query->bindParam(":id", $this->id, PDO::PARAM_INT);
            $query->bindParam(":description", $this->description, PDO::PARAM_STR);

            $query->execute();
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    public function existe()
    {
        $dsn = "mysql:host=localhost;port=3306;dbname=workskill";
        $sql = "SELECT * FROM competence (description, nom_metier) VALUES (:description, :nom_metier)";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $pdo->prepare($sql);

            $query->bindParam(":description", $this->description, PDO::PARAM_STR);

            $query->execute();

            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    public function modifier()
    {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "UPDATE competence (id, description) WHERE id=:id, description=:description";

        try {
            $pdo = new PDO($dsn, "root", "");


            $query = $pdo->prepare($sql);

            $query->bindParam(":id", $this->id, PDO::PARAM_INT);
            $query->bindParam(":description", $this->description, PDO::PARAM_STR);

            //mettre a jour l'id de l'objet courant
            $query->execute();
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    public function supprimer()
    {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "DELETE FROM competence (id, description) WHERE id=:id, description=:description";

        try {
            $pdo = new PDO($dsn, "root", "");


            $query = $pdo->prepare($sql);

            $query->bindParam(":id", $this->id, PDO::PARAM_INT);
            $query->bindParam(":description", $this->description, PDO::PARAM_STR);

            //mettre a jour l'id de l'objet courant
            $query->execute();
        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();
        }
    }

    // récupère une seule ligne de la table en fonction de l'id fourni
    public static function findById(int $id): string
    {
        $sql = "SELECT description FROM competence WHERE id_competence = :id;";
        $dsn = "mysql:host=localhost;port=3306;dbname=workskill;charset=utf8";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $pdo->prepare($sql);
            $query->bindParam("id", $id, PDO::PARAM_INT);

            if ($query->execute()) {
                // $query-> setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, __CLASS__);

                $result = $query->fetch();
                return $result["description"];
            }
        } catch (PDOException | Exception | Error $e) {
            echo $e->getMessage();
        }
    }
}
