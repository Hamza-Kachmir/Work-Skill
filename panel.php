<?php

$title = " - Page administrateur ";
require "./assets/core/header.php";
require_once "./assets/core/Theme-class.php";
require_once "./assets/core/Metier-class.php";
require_once "./assets/core/Skill-class.php";
require_once "./assets/core/Underskill-class.php";
require_once "./assets/core/Question-class.php";

use Core\Entity\Underskill;
use Core\Entity\Skill;
use Core\Entity\Theme;
use Core\Entity\Metier;

use Core\Entity\Question;

if(!isset($_SESSION["connecter"])){
    header("Location: index.php");
}

if (!empty($_POST)) {
    // Vérifier si le thème est défini dans le formulaire
    $nom_theme = isset($_POST["theme"]) ? htmlspecialchars($_POST["theme"]) : "";

    // Vérifier si un nouveau thème doit être ajouté
    if (isset($_POST['new-theme']) && !empty($_POST['new-theme'])) {
        // Récupérer le nom du nouveau thème
        $new_theme = htmlspecialchars($_POST['new-theme']);
        // Créer l'objet Theme pour ajouter le nouveau thème à la base de données
        $theme = new Theme();
        $theme->nom_theme = $new_theme;
        $theme->creer();
        // Utiliser le nouveau thème pour ajouter le métier
        $nom_theme = $new_theme;
    }

    // Créer l'objet Theme pour vérifier si le nom du thème est valide
    $theme = new Theme();
    $theme->nom_theme = $nom_theme;

    if (!$theme->existe()) {
        // Le nom du thème n'existe pas encore, ajouter le nouveau thème à la base de données
        $theme->creer();
    }

    // Vérifier si le métier est défini dans le formulaire
    $nom_metier = isset($_POST["metier"]) ? htmlspecialchars($_POST["metier"]) : "";

    if (!empty($nom_theme) && !empty($nom_metier)) {
        // Créer l'objet Metier
        $metier = new Metier();
        $metier->nom_metier = $nom_metier;
        $metier->nom_theme = $nom_theme;
        $metier->creer();

        // Vérifier si la compétence est définie dans le formulaire
        if (isset($_POST["competence"]) && $_POST["competence"] != "") {
            // Créer l'objet Skill
            $skill = new Skill();
            $skill->nom_famille_competence = strip_tags($_POST["competence"]);

            // Vérifier si la compétence existe déjà dans la base de données
            if ($skill->existe()) {
                // La compétence existe déjà, afficher un message d'erreur et rediriger vers la page précédente
                $message = "La compétence existe déjà.";
                $_SESSION["message"] = $message;
                header("Location: " . $_SERVER["HTTP_REFERER"]);
                exit;
            } else {
                // La compétence n'existe pas encore, ajouter la nouvelle compétence à la base de données
                $skill->creer();
            }
        }

            // Vérifier si la sous-compétence existe déjà dans la base de données pour ce métier
            if (isset($_POST["souscompetence"]) && $_POST["souscompetence"] != "") {
                // Créer l'objet Underskill
                $underskill = new Underskill();
                $underskill->description = strip_tags($_POST["souscompetence"]);
                $underskill->nom_metier = $nom_metier;
                var_dump($skill);
                $underskill->nom_famille_competence = $skill->nom_famille_competence;
                
                // Vérifier si la sous-compétence existe déjà dans la base de données
                if ($underskill->existe()) {
                    // La sous-compétence existe déjà, afficher un message d'erreur et rediriger vers la page précédente
                    $message = "La sous-compétence existe déjà.";
                    $_SESSION["message"] = $message;
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                    exit;
                } else {
                    // La sous-compétence n'existe pas encore, ajouter la nouvelle sous-compétence à la base de données
                    $underskill->creer();
                }
            }
        }
    }        
?>

<div class="logoS">
    <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" style="enable-background: new 0 0 1000 1000" xml:space="preserve">
        <path class="st0" d="M372.22,937.82L17.67,795.3c-1.56-0.62-2.57-2.13-2.57-3.8V41.58c0-3.15,3.42-5.13,6.15-3.55L498.5,313.18
        c1.26,0.73,2.83,0.73,4.09,0L979.86,38.03c2.73-1.58,6.14,0.4,6.14,3.55v749.91c0,1.67-1.02,3.18-2.57,3.8l-354.5,142.51
        c-1.18,0.48-2.53,0.37-3.62-0.28l-122.66-73.09c-1.29-0.76-2.91-0.76-4.2,0.01l-122.61,73.08
        C374.75,938.19,373.41,938.29,372.22,937.82 M502.64,762.89l130.21,77.58c1.1,0.66,2.44,0.76,3.63,0.28l259.72-104.41
        c1.55-0.62,2.57-2.13,2.57-3.8V192.58c0-3.15-3.41-5.13-6.14-3.55L502.59,413.87c-1.26,0.73-2.83,0.73-4.09,0L108.48,189.03
        c-2.73-1.58-6.15,0.4-6.15,3.55v539.96c0,1.68,1.02,3.18,2.57,3.8l259.76,104.41c1.18,0.48,2.53,0.37,3.62-0.28l130.15-77.58
        C499.73,762.12,501.35,762.12,502.64,762.89 M640.23,791.1l211.28-84.95c1.55-0.62,2.57-2.13,2.57-3.8V309.5
        c0-3.3-3.69-5.25-6.41-3.38l-540.7,369.21c-1.15,0.78-2.62,0.93-3.9,0.39l-66.3-27.97c-1.52-0.64-2.51-2.13-2.51-3.78V422.15
        c0-3.18,3.46-5.15,6.19-3.52l134.16,79.67c1.95,1.16,4.46,0.51,5.62-1.43l40.36-67.97c1.16-1.94,0.52-4.45-1.43-5.61L153.21,265.36
        c-2.73-1.62-6.19,0.35-6.19,3.52v432.97c0,1.65,0.98,3.14,2.5,3.78l163.46,68.96c1.28,0.55,2.75,0.39,3.9-0.39l443.54-302.87
        c2.72-1.85,6.41,0.09,6.41,3.38V643.4c0,1.68-1.02,3.18-2.57,3.8l-116.26,46.74c-1.2,0.48-2.54,0.37-3.64-0.29l-56.92-34.29
        c-1.93-1.17-4.45-0.55-5.62,1.4l-40.79,67.71c-1.17,1.94-0.55,4.46,1.4,5.62l94.15,56.72C637.69,791.47,639.04,791.57,640.23,791.1" />
        <defs>
            <linearGradient id="0" x1="0.15" y1="0.85" x2="0.85" y2="0.15">
                <stop offset="0%" stop-color="#ad00a6" />
                <stop offset="60%" stop-color="#4458a1" />
                <stop offset="100%" stop-color="#00b2c6" />
            </linearGradient>
        </defs>
    </svg>
    <div class="title">
        <h1>
            <span>Work</span> Skill
        </h1>
        <h2>Administrateur</h2>
    </div>
</div>

<main>
    <div class="panel-container">
        <div class="panel-modify"><input type="search" name="theme" hx-post="searchpanel.php" hx-trigger="keyup changed delay:400ms, search" hx-target=".resulttheme" autocomplete="off" value="<?= $_GET['searchtheme'] ?? "" ?>" placeholder="Thème"><i class="fa-solid fa-plus"></i></div>
        <div class="resulttheme resultpanel"></div>
        <div class="panel-modify"><input type="search" name="metier" hx-post="searchpanel.php" hx-trigger="keyup changed delay:400ms, search" hx-target=".resultmetier" autocomplete="off" value="<?= $_GET['searchcompetence'] ?? "" ?>" placeholder="Métier"><i class="fa-solid fa-plus"></i></div>
        <div class="resultmetier resultpanel"></div>
        <div class="panel-modify"><input type="search" name="competence" hx-post="searchpanel.php" hx-trigger="keyup changed delay:400ms, search" hx-target=".resultcompetence" autocomplete="off" value="<?= $_GET['searchsouscompetence'] ?? "" ?>" placeholder=" competence"><i class="fa-solid fa-plus"></i></div>
        <div class="resultcompetence resultpanel"></div>
        <div class="panel-modify"><input type="search" name="souscompetence" hx-post="searchpanel.php" hx-trigger="keyup changed delay:400ms, search" hx-target=".resultsouscompetence" autocomplete="off" placeholder="sous-competence"><i class="fa-solid fa-plus"></i></div>
        <div class="resultsouscompetence resultpanel"></div>
        <div class="panel-modify"><input type="search" name="" id="" placeholder="Question"><i class="plus fa-solid fa-plus"></i></div>
        <div class="response">
            <div class="btn-response">
                <input type="text" name="" id="" placeholder="Réponse">
                <input type="radio" name="1" id="">
            </div>
            <div class="btn-response">
                <input type="text" name="" id="" placeholder="Réponse">
                <input type="radio" name="1" id="">
            </div>
            <div class="btn-response">
                <input type="text" name="" id="" placeholder="Réponse">
                <input type="radio" name="1" id="">
            </div>
        </div>
        <a class="btn-search test" href="panelusers.php">Panel suivant</a>
    </div>
</main>

<?php
$_SESSION['aaa'] = $_GET['searchtheme'] ?? "";
$_SESSION['aaaa'] = $_GET['searchcompetence'] ?? "";
$_SESSION['aaaaa'] = $_GET['searchsouscompetence'] ?? "";
require "./assets/core/footer.php";
?>