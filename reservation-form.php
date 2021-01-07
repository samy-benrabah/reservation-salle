<?php
require 'User.php';
session_start();
$reservation = new User();
$disconnexion = new User();
$msg_error = '';
$id_utilisateur = '';

if (isset($_SESSION['user'])) {

    if (isset($_POST['submit'])) {
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $dateDebut = $_POST['date'] . ' ' . $_POST['heureDebut'];
        $dateFin = $_POST['date'] . ' ' . $_POST['heureFin'];
        $id_utilisateur = $_SESSION['id'];
        $msg_error = $reservation->reservation($titre, $description, $dateDebut, $dateFin, $id_utilisateur);

    }

    if (isset($_POST['deconnexion'])) {
        $disconnexion->disconnect();
        session_destroy();
        header('Location:connexion.php');
        // var_dump($_SESSION['user']);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
<header>
    <section>
    <div class="header">
    <ul>
    <li> <a href="profil.php"> Profil</a></li>
    <li> <a href="index.php"> Index</a></li>
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
        <h2>Reservation</h2>
        <?php if ($msg_error != '') {?>

            <p class="error"><?php echo $msg_error; ?></p>

        <?php }?>
    <form action="" method='POST'>

    <label for="titre" >Titre</label>
    <input type="text" name ="titre">

    <label for="description" >Description</label>
    <textarea name="description" id="" cols="45" rows="2"></textarea>

    <label for="date" >Date</label>
    <input type="date" name ="date">

    <label for="date" >Horaire</label>
<select name="heureDebut" id="debut">
                        <option value="14">de 14:00h</option>
                        <option value="15">de 15:00h</option>
                        <option value="16">de 16:00h</option>
                        <option value="17">de 17:00h</option>
                        <option value="18">de 18:00h</option>
                        <option value="19">de 19:00h</option>
                        <option value="20">de 20:00h</option>
                        <option value="21">de 21:00h</option>
                        <option value="22">de 22:00h</option>
                    </select>
                    <select name="heureFin" id="fin">
                        <option value="15">à 15:00h</option>
                        <option value="16">à 16:00h</option>
                        <option value="17">à 17:00h</option>
                        <option value="18">à 18:00h</option>
                        <option value="19">à 19:00h</option>
                        <option value="20">à 20:00h</option>
                        <option value="21">à 21:00h</option>
                        <option value="22">à 22:00h</option>
                        <option value="23">à 23:00h</option>
                    </select>



    <input type="submit" name="submit" value="Reserver">
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
