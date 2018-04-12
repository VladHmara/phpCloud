<?php
/**
 * Created by PhpStorm.
 * User: alina
 * Date: 12.04.2018
 * Time: 20:51
 */

class LoginController
{
    static private function connectDB()
    {
        $host = '127.0.0.1';
        $db = 'myclouddb';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);
        return $pdo;
    }

    static public function LogIn($data){
        $pdo = LoginController::connectDB();
        $query = $pdo->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $email = htmlentities($data['email']);
        $password = htmlentities($data['password']);
        $query->bindParam(1, $email);
        $query->bindParam(2, $password);
        $query->execute();

        return $query->fetch();
    }
}