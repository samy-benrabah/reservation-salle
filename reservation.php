<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
<title>Reservation</title>
</head>
<body>
<header>
    <section>
    <div class="header">
    <ul>
    <li> <a href="accueil.php"> Accueil</a></li>
    <li> <a href="index.php"> Index</a></li>
    <li> <a href="reservation-form.php"> Reservation</a></li>
    <form action="" method="post">
    <li><input type="submit" name ="deconnexion" value="Deconnexion"></li>
    </form>
    </ul>
    </div>
    </section>
    </header>
<main>
<div class="block-planning">
<?php

if (isset($_GET['id'])) {
    $db = new PDO("mysql:host=localhost;dbname=reservationsalles;charset=utf8", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $db->prepare("SELECT utilisateurs.id, login ,titre, description, debut ,fin ,id_utilisateur FROM utilisateurs RIGHT JOIN reservations ON reservations.id_utilisateur = utilisateurs.id WHERE (reservations.id = :id)");
    $stmt->execute(['id' => $_GET['id']]);
    $tab = $stmt->fetch(PDO::FETCH_ASSOC);

    ?>
<table  class="table table-bordered table-dark">
<?php
foreach ($tab as $key => $value) {
        echo " <tr class = border-dark>" . "<th scope = row >" . $key . " " . ":" . " " . $value . "</th>" . "</tr>" . "<br>";

    }
    ?>
</table>
<?php }?>

</div>
</main>
<footer>
        <div>
            <p>
               <strong>Copyright &#169 . Samy&Morad . All Right Reserved Lemok</strong>
            </p>
        </div>
    </footer>
</body>

</html>