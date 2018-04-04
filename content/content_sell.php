<h1 id="p">Vendre un objet</h1>

<form name="sell" action="index.php?page=sell" method="post">
    <p>Voulez-vous vendre ou mettre aux enchères?</p>
    <select name="type" id="type">
        <option value="1" selected="selected">Enchère</option>
        <option value="2">Vente directe</option>
    </select>
    <p>Voulez-vous ajouter une photo?</p>
    <select name="pict" id="pict">
        <option value="1" selected="selected">Oui</option>
        <option value="2">Non</option>
    </select>
    <p>Titre:</p>
    <input name="title" type="text">
    <div id="priceauction">
        <p>Prix de départ:</p>
        <input name="pricea" type="number">
        <p>Date de fin d'enchère:</p>
        <input name="enddate" type="datetime-local">
    </div>
    <div id="pricedirect">
        <p>Prix:</p>
        <input name="price" type="number">

    </div>
    <p>Description:</p>
    <textarea name="description"></textarea>
    <div id="pictureupload">
        <p>Image:</p>
        <input type="file" name="pic">
    </div>

    <input type="submit" value="Vendre">
</form>



<?php

if (isset($_POST['title']) && isset($_POST['price']) && isset($_POST['description']) ){
    if(isset($_FILES['pic'])){
        echo 'pictureOKOKOKOKOK';
        if($_FILES['pic']['error']!=0){
            ?><p>Erreur lors de l'envoi du fichier</p><?php
        }
        else if($_FILES['pic']['size']>2000000){
            echo '<p>Le fichier est trop grand. La taille limite est de 2 Mo.</p>';
        }
        else{
            $infosfichier = pathinfo($_FILES['pic']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (!in_array($extension_upload, $extensions_autorisees)){
                ?><p>Extension de fichier non autorisée</p><?php
            }
            else{

                move_uploaded_file($_FILES['img']['tmp_name'], 'data/'.$_POST['psd'].'.'.$extension_upload);
                $db = Database::connect();
                $file_name = $_POST['psd'].'.'.$extension_upload;

                if(isset($_POST['enddate'])){
                    $req=$db->prepare('INSERT INTO item(pricea, pic, description, title, enddate) VALUES(:pricea, :pic, :description, :title, :enddate)');
                    $req->execute(array('pricea'=>$_POST['pricea'], 'pic'=>$file_name, 'description'=>$_POST['description'], 'title'=>$_POST['title'], 'enddate'=>$_POST['enddate']));
                    echo '<p>L\'objet a bien été mis aux enchères.</p>';
                }
                else{
                    $req=$db->prepare('INSERT INTO item(price, pic, description, title) VALUES(:price, :pic, :description, :title)');
                    $req->execute(array('price'=>$_POST['price'], 'pic'=>$file_name, 'description'=>$_POST['description'], 'title'=>$_POST['title']));
                    echo '<p>L\'objet a bien été mis en vente directe.</p>';
                }
            }

        }
    }
    else{
        $db = Database::connect();
        if(isset($_POST['enddate'])){
            $req=$db->prepare('INSERT INTO item(pricea,description, title, enddate) VALUES(:pricea,:description, :title, :enddate)');
            $req->execute(array('pricea'=>$_POST['pricea'], 'description'=>$_POST['description'], 'title'=>$_POST['title'], 'enddate'=>$_POST['enddate']));
            echo '<p>L\'objet a bien été mis aux enchères.</p>';
        }
        else{
            $req=$db->prepare('INSERT INTO item(price,description, title) VALUES(:price, :description, :title)');
            $req->execute(array('price'=>$_POST['price'], 'description'=>$_POST['description'], 'title'=>$_POST['title']));
            echo '<p>L\'objet a bien été mis en vente directe.</p>';
        }
    }


    $req->closeCursor();

}
else {echo '<p>Veuillez remplir le formulaire</p>';}
?>
