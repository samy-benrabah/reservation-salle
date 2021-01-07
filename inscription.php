
<?php
require 'User.php';
session_start();
$user = new User();
$msg_error = '';
if (isset($_POST['submit'])) {
    $submit = $_POST['submit'];
    $username = $_POST['login'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $msg_error = $user->register($_POST['login'], $_POST['password'], $_POST['cpassword']);

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
    <li> <a href="index.php"> Accueil</a></li>
    <li><a href="connexion.php">Connexion</a> </li>
    </ul>
    </div>
    </section>
    </header>
    <main>
    <section>
        <div class="block">


    <h2>Inscription</h2>

        <form action="inscription.php" method="POST">
        <?php
if ($msg_error != '') {?>
    <p class="error"><?php echo $msg_error; ?></p>
<?php }?>
        <label for="" name="login">Login</label>
    <input type="text" name="login">
    <label for="" name="password">Password</label>
    <input type="password" name="password">
    <label for="" name="cpassword">Confirm Password</label>
    <input type="password" name="cpassword">
    <input type="submit" name="submit" value="Inscription">

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
