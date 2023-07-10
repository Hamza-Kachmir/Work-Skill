<?php

session_name('workskill');
session_start();

require "./assets/core/config.php";

// Search Theme

$searchtheme = $_POST["theme"] ?? "";
$sql = "SELECT * FROM theme WHERE nom_theme LIKE :searchtheme";
$resulttheme = $dbo->prepare($sql);
$resulttheme->bindValue(':searchtheme', "$searchtheme%");
$resulttheme->execute();

if (isset($_POST['theme'])) {
  while ($row = $resulttheme->fetch()) : ?>
    <a href="./panel.php?searchtheme=<?= htmlspecialchars($row['nom_theme']); ?>"><?= htmlspecialchars($row['nom_theme']); ?></a>
  <?php endwhile;
}


$searchmetier = $_POST["metier"] ?? "";
$sql = "SELECT * FROM metier WHERE nom_metier LIKE :searchmetier AND nom_theme LIKE :searchtheme ORDER BY nom_metier";
$resultmetier = $dbo->prepare($sql);
$resultmetier->bindValue(':searchmetier', "$searchmetier%");
$resultmetier->bindValue(':searchtheme', $_SESSION['theme']);
$resultmetier->execute();

if (isset($_POST['metier'])) {
  while ($row = $resultmetier->fetch()) : ?>
    <a href="./panel.php?searchcompetence=<?= htmlspecialchars($row['nom_metier']); ?>"><?= htmlspecialchars($row['nom_metier']); ?></a>
  <?php endwhile;
}

$searchcompetence = $_POST["competence"] ?? "";
$sql = "SELECT *
FROM famille_competence WHERE nom_famille_competence LIKE :searchmetier";
$resulthcompetence = $dbo->prepare($sql);
$resulthcompetence->bindValue(':searchmetier', "$searchcompetence%");
$resulthcompetence->execute();

if (isset($_POST['competence'])) {
  while ($row = $resulthcompetence->fetch()) : ?>
    <a href="./panel.php?searchsouscompetence=<?= htmlspecialchars($row['nom_famille_competence']); ?>"><?= htmlspecialchars($row['nom_famille_competence']); ?></a>
  <?php endwhile;
}

$searchsouscompetence = $_POST["souscompetence"] ?? "";
$sql = "SELECT *
FROM competence c
JOIN famille_competence fc ON fc.nom_famille_competence = c.nom_famille_competence
JOIN metier m ON m.nom_metier = c.nom_metier
WHERE c.nom_famille_competence LIKE :searchmetier AND m.nom_metier LIKE :searchmetierr";
$resultsouscompetence = $dbo->prepare($sql);
$resulthcompetence->bindValue(':searchtheme', "$searchsouscompetence%");
$resultsouscompetence->bindValue(':searchmetier', $_SESSION['competence']);
$resultsouscompetence->bindValue(':searchmetierr', $_SESSION['metier']);
$resultsouscompetence->execute();

if (isset($_POST['souscompetence'])) {
  while ($row = $resultsouscompetence->fetch()) : ?>
    <a href="./panel.php?searchquestion=<?= htmlspecialchars($row['description']); ?>"><?= htmlspecialchars($row['description']); ?></a>
  <?php endwhile;
}

$searchquestion = $_POST["question"] ?? "";
$sql = "SELECT * FROM question
JOIN competence ON competence.id_competence = question.id_competence
WHERE competence.description LIKE :searchtheme AND question LIKE :searchmetier";
$resultquestion = $dbo->prepare($sql);
$resultquestion->bindValue(':searchmetier', "$searchquestion%");
$resultquestion->bindValue(':searchtheme', $_SESSION['question']);
$resultquestion->execute();

if (isset($_POST['question'])) {
  while ($row = $resultquestion->fetch()) : ?>
    <a href="./panel.php?searchreponse=<?= htmlspecialchars($row['question']); ?>"><?= htmlspecialchars($row['question']); ?></a>
  <?php endwhile;
}

$sql2 = "SELECT * FROM reponse JOIN question ON question.id_question = reponse.id_question
WHERE question.question LIKE :searchtheme";
$resultreponse = $dbo->prepare($sql2);
$resultreponse->bindValue(':searchtheme', $_SESSION['reponse']);
$resultreponse->execute();

if (isset($_POST['reponse'])) {
  while ($row = $resultreponse->fetch()) : ?>
    <a href="./panel.php?searchreponse=<?= htmlspecialchars($row['reponse']); ?>"><?= htmlspecialchars($row['reponse']); ?></a>

<?php endwhile;
}