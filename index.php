<?php
require 'User.php';
$user = new User();
session_start();
if (isset($_SESSION['user'])) {
    if (isset($_POST['deconnexion'])) {
        $user->disconnect();
        session_destroy();
        header('Location:connexion.php');
    }
}
if (isset($_POST['modification'])) {
    header('Location:profil.php');
}
if (isset($_POST['reservation'])) {
    header('Location:reservation-form.php');
}
if (isset($_POST['planning'])) {
    header('Location:planning.php');
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">



    <title>Reservation-Salle</title>
</head>
<body>
    <header>
    <section>
    <div class="header">
    <ul>
    <li><a href="reservation-form.php">Reservation</a> </li>
    <form action="" method="post">
    <li><input type="submit" name ="deconnexion" value="Deconnexion"></li>
    </form>
    </ul>
    </div>
    </section>
    </header>
    <main>
    <section>
        <div class="block">


    <h2>Bonjour <?php echo $_SESSION['user'] ?>!</h2>

        <form action="" method="POST">

            <input type="submit" name="modification" value="Modifier mon Profil">
            <input type="submit" name="reservation" value="Reserver Maintenant !">
            <input type="submit" name="planning" value="Voir le planning !">

        </form>


    </div>
    </section>
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
