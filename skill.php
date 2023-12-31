<?php

require "./assets/core/config.php";

$sql = "SELECT nom_famille_competence
FROM famille_competence";
$results = $dbo->prepare($sql);
$results->execute();
$rows = $results->fetchAll();
$_SESSION["metier"] = $_GET["metier"];

$list_theme = "SELECT nom_famille_competence FROM famille_competence";
$result_theme = $dbo->prepare($list_theme);
$result_theme->execute();
$rows_theme = $result_theme->fetchAll();


$title = " - Competences";
require "./assets/core/header.php";
?>
<main id="skill">
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
      <h2><?= $_SESSION["metier"] ?? $_GET["metier"]?></h2>
    </div>
  </div>
  <div class="cardskill-container">
    <?php
    for ($i = 0; $i < count($rows); $i++) : ?>
      <a class="<?= htmlspecialchars($rows[$i]['nom_famille_competence']); ?> disabledclick disabledcolor" href="underskill.php?famille=<?= htmlspecialchars($rows[$i]['nom_famille_competence']); ?>&famillesuivante=<?php if ($i + 1 < count($rows)) {
                                                                                                                                                                                                                        echo htmlspecialchars($rows[$i + 1]['nom_famille_competence']);
                                                                                                                                                                                                                      } ?>">
        <div class="opacity-<?= $i ?> disabledclick disabledcolor">
          <p><?= htmlspecialchars($rows[$i]['nom_famille_competence']); ?></p>
        </div>
      </a>
    <?php endfor; ?>
  </div>
  </div>
  <a class="btn-search test">Valider</a>
  </div>
  <script src="assets/js/function.js"></script>
</main>

<?php
require "./assets/core/footer.php";
$_SESSION["metier"] = $_GET["metier"];


?>