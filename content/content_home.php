
<h1>Bienvenue</h1>
<p>Voici des objets qui pourraient vous interesser</p>

<?php
$db = Database::connect();
$req = $db->prepare('SELECT * FROM item');
while($data= $req->fetch()){
    echo $data['title'];
}