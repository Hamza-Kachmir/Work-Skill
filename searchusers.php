<?php
session_name('workskill');
session_start();

require "./assets/core/config.php";

// Search Panel Utilisateurs

$search = $_POST["user"];
$filter = "nom";
$sql2 = "SELECT * FROM utilisateurs WHERE nom LIKE :search ORDER BY :filter";
$result = $dbo->prepare($sql2);
$result->bindValue(':search', "$search%");
$result->bindValue(':filter', "$filter%");
$result->execute();

?>
<table>
  <thead>
    <tr>
      <td>Nom</td>
      <td>|</td>
      <td>Prenom</td>
      <td>|</td>
      <td>Metier</td>
      <td>|</td>
      <td>%</td>
      <td>|</td>
      <td>Date</td>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = $result->fetch()) : ?>

      <tr>
        <td><?= htmlspecialchars($row['nom']); ?></td>
        <td><?= htmlspecialchars($row['prenom']); ?></td>
        <td><?= htmlspecialchars($row['metier']); ?></td>
        <td><?= htmlspecialchars($row['pourcentage']) . "%" ?></td>
        <td><?= htmlspecialchars($row['finish_at']); ?></td>
      </tr>

    <?php endwhile; ?>
  </tbody>
</table>