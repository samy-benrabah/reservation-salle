<?php

class User
{
    public $id;
    public $login;
    public $username;
    public $password;
    public $cpassword;
    public $titre;
    public $description;
    public $dateDebut;
    public $dateFin;

    private function connectDb()
    {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=reservationsalles;charset=utf8", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erreur de connexion :" . $e->getMessage();
        }

    }
    public function register($username, $password, $cpassword)
    {
        $db = $this->connectDb();
        $msg = '';
        $username = trim(htmlspecialchars($username));
        $password = trim(htmlspecialchars($password));
        $cpassword = trim(htmlspecialchars($cpassword));

        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $stmt->execute(array(':login' => $username));
        $row = $stmt->rowCount();

        if (!empty($username) && !empty($password) && !empty($cpassword)) {
            if (!$row) {
                if ($password == $cpassword) {
                    $crypted = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                    $query = $db->prepare("INSERT INTO utilisateurs (login,password) VALUES (:login,:crypted) ");
                    $query->execute([':login' => $username, ':crypted' => $crypted]);
                    $_SESSION['username'] = $_POST['username'];
                    header('Location:connexion.php');
                } else {
                    $msg = "Les mots de passes ne sont pas identiques";

                }
            } else {
                $msg = "Le login existe déjà ";
            }
        } else {
            $msg = " Veuillez remplir le formulaire";
        }
        return $msg;
    }

    public function login($username, $password)
    {
        $msg = '';
        $db = $this->connectDb();
        if (!empty($username) && !empty($password)) {
            $username = trim(htmlspecialchars($username));
            $password = trim(htmlspecialchars($password));
            $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login ");
            $stmt->bindValue('login', $username);
            $stmt->execute();
            $tab = $stmt->fetch(PDO::FETCH_OBJ);
            $hash = $tab->password;

            if ($stmt->rowCount()) {
                $decrypted = password_verify($password, $hash);

                if ($decrypted) {
                    $query = $db->prepare("SELECT * FROM utilisateurs WHERE password =:password ");
                    $query->bindValue('password', $decrypted);
                    $query->execute();
                    $_SESSION['user'] = $username;
                    $_SESSION['id'] = $tab->id;
                    header('Location:index.php');

                } else {
                    $msg = "Le mot de passe saisi n'est pas correct";
                }
            } else {
                $msg = " Le login saisi n'est pas correct";
            }
        } else {
            $msg = "Remplissez le formulaire";
        }
        return $msg;
    }

    public function update($new_username, $new_password, $cpassword)
    {

        $db = $this->connectDb();
        $msg = '';

        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login");
        $stmt->execute([':login' => $_SESSION['user']]);
        $tab = $stmt->fetch(PDO::FETCH_OBJ);
        $this->id = $tab->id;

        if (!empty($new_username) && !empty($new_password) && !empty($cpassword)) {
            if ($new_password == $cpassword) {
                $new_username = trim(htmlspecialchars($new_username));
                $new_password = trim(htmlspecialchars($new_password));
                $cpassword = trim(htmlspecialchars($cpassword));
                $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE login = :login");
                $stmt->execute([':login' => $new_username]);
                $tab = $stmt->fetch(PDO::FETCH_OBJ);

                if (!$stmt->rowCount()) {
                    $crypted = password_hash($new_password, PASSWORD_BCRYPT);
                    $query = $db->prepare("UPDATE utilisateurs SET login = :username, password = :password WHERE id = :id");
                    $query->bindParam('username', $new_username);
                    $query->bindParam('password', $crypted);
                    $query->bindParam('id', $this->id);
                    $query->execute();
                    $this->disconnect();
                    session_destroy();
                    header('Location:connexion.php');

                    // var_dump($this->id);
                } else {
                    $msg = "Ce login existe deja";
                }
            } else {
                $msg = "Les mots de passes ne sont pas identiques";
            }
        } else {
            $msg = "Veuillez remplir le formulaire";
        }
        return $msg;

    }

    public function disconnect()
    {
        unset($this->username);
        unset($this->id);
        unset($this->password);
        unset($this->new_password);
        unset($this->login);
        unset($this->id_utilisateur);

    }
    public function reservation($titre, $description, $dateDebut, $dateFin, $id_utilisateur)
    {
        $msg = '';
        $db = $this->connectDb();
        $query = $db->prepare("SELECT * FROM reservations WHERE debut= :debut or fin= :fin");
        $query->bindValue('debut', $dateDebut);
        $query->bindValue('fin', $dateFin);
        $query->execute();
        $tab = $query->fetch(PDO::FETCH_OBJ);
        $titre = trim(htmlspecialchars($titre));
        $description = trim(htmlspecialchars($description));
        $dateDebut = trim(htmlspecialchars($dateDebut));
        $dateFin = trim(htmlspecialchars($dateFin));
        $id_utilisateur = trim(htmlspecialchars($id_utilisateur));
        $today = date('Y-m-d H:i:s');
        $id_utilisateur = $_SESSION['id'];
        if (!$tab) {
            if (!empty($titre)) {
                if (!empty($description)) {
                    if (!empty($dateDebut)) {
                        if (!empty($dateFin)) {
                            if ($dateDebut < $dateFin) {
                                if ($today < $dateDebut) {

                                    try {

                                        $stmt = $db->prepare("INSERT INTO reservations ( titre, description, debut, fin, id_utilisateur) VALUES (:titre,:description, :debut, :fin,:id_utilisateur) ");
                                        $stmt->bindParam('titre', $titre);
                                        $stmt->bindParam('description', $description);
                                        $stmt->bindParam('debut', $dateDebut);
                                        $stmt->bindParam('fin', $dateFin);
                                        $stmt->bindParam('id_utilisateur', $id_utilisateur);
                                        $stmt->execute();
                                        echo 'Réservations réussie';
                                    } catch (PDOException $e) {
                                        $msg = "Erreur de connexion a la base de la donnée:" . $e->getMessage();
                                    }
                                } else {
                                    $msg = "La date de début doit être supérieur a celle actuelle";
                                }
                            } else {
                                $msg = "L'heure de début doit être inférieurs a celle de fin";
                            }

                        } else {
                            $msg = 'Choisissez une date de fin';
                        }
                    } else {
                        $msg = 'Choisissez une date de début';
                    }
                } else {
                    $msg = 'Mettre une description';
                }

            } else {
                $msg = 'Remplissez le titre';
            }
        } else {
            $msg = 'Ces horaires sont déjà réservés';
        }
        return $msg;
    }
    public function getId()
    {
        var_dump($id);
        return $this->id;
    }

}
