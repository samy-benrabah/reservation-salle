<?php

class db
{

    private $localhost = "localhost";
    private $username = "root";
    private $database = "reservationsalles";
    private $password = "";

    protected function connection()
    {

        // création de ma base de donnée

        $db = "mysql:host=" . $this->localhost . ";dbname=" . $this->database;
        $pdo = new PDO($db, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}
