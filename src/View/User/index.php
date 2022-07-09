<h1>Page membre</h1>

<?php 
    echo "Ceci est mon cookie : ".$_COOKIE['user'];
    var_dump($data);
?>

<form action="/PiePHP/user/delete" method="post">
    <button type="submit" name="delete">Supprimer le compte</button>
</form>

<form action="/PiePHP/user/disconnect" method="post">
    <button type="submit" name="disconnect">Déconnexion</button>
</form>
