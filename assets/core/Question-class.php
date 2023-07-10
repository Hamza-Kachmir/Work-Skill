<?php

namespace Core\Entity;

use Error;
use Exception;
use PDO;
use PDOException;

class Question 
{
    private int $id;
    private string $question;

    //initialisation
    public function __construct($id = 0, $question = "")
    {
        $this->id = $id;
        $this->question = $question;
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
        $sql = "INSERT INTO question (id_question, question) VALUES :id, :question";

        try {
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $query = $pdo->prepare($sql);

            $query->bindParam(":id_question", $this->id_question, PDO::PARAM_INT);
            $query->bindParam(":question", $this->question, PDO::PARAM_STR);

            $query->execute();

        } catch (PDOException | Exception | error $e) {
            echo $e->getMessage();

        }
    }

    public function modifier()
    {
        $dsn = "mysql:host=localhost;dbname=workskill";
        $sql = "UPDATE question (id_question, question)  WHERE id_question=:id_question, question=:question";

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
        $sql = "DELETE FROM question (id_question, question) WHERE id_question=:id_question, question=:question";

        try {
        $pdo = new PDO($dsn, "root", "");


        $query = $pdo-> prepare($sql);

        $query->bindParam(":id_question", $this->id_question, PDO::PARAM_INT);
        $query->bindParam(":question", $this->question, PDO::PARAM_STR);

        //mettre a jour l'id de l'objet courant
        $query-> execute();

        } catch(PDOException | Exception | error $e) {
            echo $e-> getMessage();
        }
    }
}