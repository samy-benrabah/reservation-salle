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

?>
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
    <title>Document</title>
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
    <table  class="table table-bordered table-dark">
<?php
$db = new PDO("mysql:host=localhost;dbname=reservationsalles;charset=utf8", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$query = $db->prepare("SELECT * FROM utilisateurs RIGHT JOIN reservations ON reservations.id_utilisateur = utilisateurs.id");
$query->execute();
$allresult = $query->fetchAll(PDO::FETCH_ASSOC);
$tab_jour = [];
$tab_heure = [];

for ($i = 0; $i <= 5; $i++) {
    $today = date('Y-m-d');
    $jour = date('Y-m-d', strtotime("+" . $i . "day", strtotime($today)));
    array_push($tab_jour, $jour);
}
for ($j = 14; $j <= 23; $j++) {
    $heure = date('H:i:s', strtotime($j . ":00:00"));
    array_push($tab_heure, $heure);
}
$debut_evenement = date('Y-m-d H:i:s', strtotime("$jour $heure"));

for ($i = 0;isset($tab_jour[$i]); $i++) {
    echo " <tr class = border-dark>" . "<th scope = row >" . date('d-m-Y', strtotime($tab_jour[$i]));
    if (date('D', strtotime($tab_jour[$i])) !== 'Sat') {
        if (date('D', strtotime($tab_jour[$i])) !== 'Sun') {
            for ($j = 0;isset($tab_heure[$j]); $j++) {
                echo "<td>" . date('H', strtotime($tab_heure[$j])) . "h";
                $date_event = date('Y-m-d H:i:s', strtotime($tab_jour[$i] . " " . $tab_heure[$j]));
                for ($k = 0;!empty($allresult[$k]); $k++) {
                    if (strtotime($allresult[$k]['debut']) <= strtotime($date_event) && strtotime($allresult[$k]['fin']) >= strtotime($date_event)) {
                        echo "<br>" . "<h5>" . "Réservé par :   " . " " . $allresult[$k]['login'] . "</h5>";
                        echo "<br>" . "<b>" . "<i>" . "Evènement :" . " " . $allresult[$k]['titre'] . "<i>" . "<b>";
                        ?>
                                <form method=get action="reservation.php">
                                    <input type="hidden" id="id" name="id" value="<?php echo $allresult[$k]['id'] ?>">
                                    <input type=submit value="Voir la réservation" class="btn btn-outline-info btn-sm">
                                </form>
                          <?php }
                }
                echo "</td>";
            }
            echo "</td>";
        } else {
            echo "<td colspan = 12>" . "Indisponible" . "</td>" . "</tr>";
        }

    } else {
        echo "<td colspan = 12>" . "Indisponible" . "</td>" . "</tr>";
    }

}
echo "</th>" . "</tr>";
return $allresult;
?>
</table>
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
