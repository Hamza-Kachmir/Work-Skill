<?php
session_name("workskill");
session_start();
$_SESSION["connecter"] = 0;

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    require_once "./assets/core/config.php";

    $sql = "SELECT * FROM administrateur WHERE email LIKE :email;";

    $query = $dbo->prepare($sql);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetch();
    if ($results) {
        if (password_verify($password, $results['hash_pwd'])) {
            $_SESSION["connecter"] = 1;
            header("Location: ../../panel.php");
        } else {
            echo 'Mot de passe incorrect';
        }
    } else {
        echo 'Email non trouvé';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORK SKILL <?= $title ?></title>
    <link rel="icon" type="image/png" href="assets/img/Wslogo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="assets/js/app.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <?php
                if ($_SERVER['REQUEST_URI'] == '/index.php' || $_SERVER['REQUEST_URI'] == '/') {
                    if ($_SESSION["connecter"] == 1) {
                        echo "<a href='assets/core/logout.php'><li class='logout'>Logout</li></a>";
                    } else {
                        echo "<a><li class='mod'>Admin</li></a>";
                    }
                } else {
                ?><a class="homebutton" href="/"><i class="fa-solid fa-house fa-xl"></i></a><?php
                                                                                        }
                                                                                            ?>
                <label class="switch">
                    <input type="checkbox" />
                    <span class="slider">
                        <span class="circle"></span>
                    </span>
                </label>
            </ul>
        </nav>
        <div class="modal_container">

            <section class="modal">
                <button class="close"><i class="closing fa-regular fa-rectangle-xmark"></i>
                </button>
                <h1>
                    <span>Work</span> Skill
                </h1>
                <form class="login" method="post">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <div class="valid">
                        <div class="memory">
                            <input type="checkbox">
                            <label for="sesouvenir">Se souvenir de moi</label>
                        </div>
                        <button>Connexion</button>
                    </div>
                </form>
            </section>
        </div>
    </header>