<?php
session_name('workskill');
session_start();

require "./assets/core/config.php";

// Search Index

$search = $_POST["q"];
$sql2 = "SELECT * FROM metier JOIN theme ON metier.nom_theme = theme.nom_theme WHERE nom_metier LIKE :search ORDER BY nom_metier";
$result = $dbo->prepare($sql2);
$result->bindValue(':search', "$search%");
$result->execute();

while ($row = $result->fetch()) : ?>
  <a href="./skill.php?metier=<?=htmlspecialchars($row['nom_metier']);?>" class="metierlist">
    <?=htmlspecialchars($row['nom_metier']); ?>
  </a>
<?php endwhile;
