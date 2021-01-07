<?php
session_start();
require 'User.php';
$user = new User();
$msg_error = '';
if (isset($_POST['submit'])) {
    $msg_error = $user->login($_POST['login'], $_POST['password']);

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
    <li> <a href="accueil.php"> Accueil</a></li>
    <li><a href="inscription.php"> Inscription</a></li>
    </ul>
    </div>
    </section>
    </header>
    <main>
    <section>
        <div class="block">


    <h2>Connexion</h2>
    <?php if ($msg_error != '') {?><p class="error"><?php echo $msg_error ?></p>
<?php }?>
        <form action="connexion.php" method="POST">

            <label for="" name="login">Login</label>
            <input type="text" name="login" >
            <label for="" name="password">Password</label>
            <input type="password" name="password" >
            <input type="submit" name="submit" value="Connexion">
        </form>
    <div class="bottom-text">
            <a href="index.php">Mot de passe oublié ?</a>
        </div>
        <div class="socials">
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href=""><i class="fa fa-pinterest"></i></a>
                <a href=""><i class="fa fa-linkedin"></i></a>
        </div>
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
