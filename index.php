<?php require('utilities/utils.php');
/**
 * Created by PhpStorm.
 * User: Arnaud
 * Date: 26/01/2018
 * Time: 13:44
 */

if(isset($_GET['page'])){
    $page = $_GET['page'];
}
else{
    $page="home";
}

$authorized = checkpage($page);


    entete(getPageTitle($page), array("css/bootstrap.css"));
    echo'
<nav id="menu">';

    navbar($page);
    echo '</nav>
<div id="content">';
    if($authorized){
        require('content/content_'.$page.'.php');
    }
    else{
        echo'<p>Page non disponible</p>';
    }
    echo '</div>';
    pied();
