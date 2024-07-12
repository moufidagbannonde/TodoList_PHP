<?php

require_once ('./config/env.php');

abstract class Database
{
    protected function connectDB()
    {
        try {
            $bdd = new PDO("mysql:host=" . $_ENV["host"] . ";dbname=" . $_ENV["dbname"], $_ENV["username"], $_ENV["password"]);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie";
            return $bdd;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    protected function sendData($data, $sql)
    {
        try {
            $objBdd = $this->connectDB();
            $req = $objBdd->prepare($sql);
            $req->execute($data);
            echo " Requête aboutie";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }


    protected function getOneData($data, $sql)
    {
        try {
            $objBdd = $this->connectDB();
            $req = $objBdd->prepare($sql);
            $req->execute($data);
            $response = $req->fetch(PDO::FETCH_ASSOC);
            echo " Data received successfully";
            return $response;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    # $sql = "SELECT * FROM user WHERE username = ?" ;


    protected function getManyData($sql, $data = null)
    {
        try {
            $objBdd = $this->connectDB();
            $req = $objBdd->prepare($sql);
            $req->execute($data);
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            echo "All Datas received successfully";
            return $res;
        } catch (PDOException $e) {
            return "Une erreur s'est produite : " . $e->getMessage();
        }
    }

    # $sql = "SELECT * FROM user " ;
# $data = ;
}


















// echo '<pre>';
// var_dump($response);
// echo '</pre>';
// function updateUser()
// {
//     try {
//         $objBdds = connectDB();
//         $sql = "UPDATE user SET username = ?, password = ? WHERE username = Bamos AND password = moufid@123";
//         $res = $objBdds->prepare($sql);
//         $res->execute(["Nafiou", "nafiou@123"]);
//     } catch (PDOException $t) {
//         echo $t->getMessage();
//     }
// }


// new PDO($dns,$username,$password);
// $dns  = "mysql:host=localhost;dbname=todos";
// $username = "root";
// $password = "";

?>