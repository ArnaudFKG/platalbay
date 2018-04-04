
<h1>Bienvenue</h1>
<p>Voici des objets qui pourraient vous interesser</p>

<?php
$db = Database::connect();
$req = $db->prepare('SELECT * FROM item');
$req->setFetchMode(PDO::FETCH_CLASS, 'Item');
$req->execute();
while($item = $req->fetch()){
    $item->display();
}