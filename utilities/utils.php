<?php

class Database {
    public static function connect() {
        $dsn = 'mysql:dbname=platalbay;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }
}




$pages=array(
    array(
        "name"=>"home",
        "title"=>"Modal Web Home Page",
        "menutitle"=>"Home"
    ),
    array(
        "name"=>"sell",
        "title"=>"Mettre un objet en vente",
        "menutitle"=>"Vendre"
    ),
    array(
        "name"=>"buy",
        "title"=>"Acheter ou enchérir sur un objet",
        "menutitle"=>"Acheter ou enchérir"
    ));


function checkpage($name){
    global $pages;
    foreach ($pages as $page){
        if($page['name']==$name) return true;
    }
    return false;
}

function getPageTitle($name){
    global $pages;
    foreach ($pages as $page){
        if($page['name']==$name) return $page['title'];
    }
}



function navbar($pageactive){
    global $pages;
    echo'<ul>';
    foreach($pages as $page){
        echo'<li';
        if($pages==$pageactive) echo'class="active"';
        echo'><a href="index.php?page='.$page['name'].'">'.$page['menutitle'].'</a></li>';
    }
    echo'</ul>';
}

function entete($name, $css){
    echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.getPageTitle($name).'</title>';





    echo'
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("h1").css("color","red");
    });
    </script>
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    

    
    
</head>
<body>
<div class="head">
        <h1>Platal Bay</h1>
        <p>Site de vente, d\'achat et d\'enchères du platal</p>
    </div>';

}

function pied(){
}