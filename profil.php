
<?php
session_start();
require 'User.php';
$msg_error = '';
$connect = new User();
$disconnect = new User();
if (isset($_POST['submit'])) {
    $msg_error = $connect->update($_POST['new_username'], $_POST['new_password'], $_POST['cpassword']);

}

if (isset($_POST['deconnexion'])) {
    $disconnect->disconnect();
    session_destroy();
    header('Location:connexion.php');
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">




    <title>Reservation-Salle</title>
</head>
<body>
    <header>
    <section>
    <div class="header">
    <ul>
    <li><a href="reservation-form.php">Reservation</a> </li>
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
        <div class="block" >


    <h2  >Ton login actuel est : <?php echo $_SESSION['user'] ?></h2>

    <?php if ($msg_error != '') {?><p class="error"><?php echo $msg_error ?></p>
<?php }?>
        <form action="profil.php" method="POST">



    <label for="" name="new_username">Nouveau Login</label>
    <input type="text" name="new_username" >

    <label for="" name="new_password">Nouveau mot de passe</label>
    <input type="password" name="new_password" >

    <label for="" name="cpassword">Confirmation nouveau mot de passe</label>
    <input type="password" name="cpassword" >

    <input type="submit" name="submit" value="Modifier mon profil">


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
