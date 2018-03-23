<h1 id="p">Vendre un objet</h1>

<form name="sell" action="content_sell.php" method="post">
    <p>Voulez-vous vendre ou mettre aux enchères?</p>
    <select name="type">
        <option value="auction" selected="selected">Enchère</option>
        <option value="direct">Vente directe</option>
    </select>
    <p>Titre:</p>
    <input name="title" type="text">
    <div id="price"></div>
    <p>Description:</p>
    <textarea name="description"></textarea>
    <p>Image:</p>
    <input type="file" name="pic">
    <input type="submit" value="Vendre">
</form>



<?php

if (isset($_POST['title'])){
    $db = Database::connect();
    $req=$db->prepare('INSERT INTO item(seller,price,description) VALUES(:seller,:price,:description)');
    $req->execute(array('seller'=>$_COOKIE['login'], 'price'=>$_POST['price'], 'description'=>$_POST['description']));
    $req->closeCursor();
?><p>Votre objet a bien été mis en vente</p> <?php
}

?>
