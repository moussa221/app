<?php session_start();
include_once 'function/function.php';
include_once 'function/connexion.class.php';
$bdd = bdd();
if(isset($_POST['pseudo']) AND isset($_POST['mdp'])){
    
    $connexion = new connexion($_POST['pseudo'],$_POST['mdp']);
    $verif = $connexion->verif();
    if($verif =="ok"){
      if($connexion->session()){
          header('Location: index.php');
      }
    }
    else {
        $erreur = $verif; 
    } 
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8' />
        <title>Le forum des dev</title>
        <link rel="stylesheet" type="text/css" href="css/general.css" />
        <link href='http://fonts.googleapis.com/css?family=Karla' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <head>
    <body>
        <div class="ui inverted massive menu">
            <a href="#" class="active item">Accueil </a>
            <div class="right menu">
                <a href="inscription.php" class="ui item">Inscription</a>
                <a href="connexion.php" class="ui item">connexion</a>
            </div>
        </div>
        <h1>Connexion:</h1>
        <div id="Cforum">
            <form method="post" action="connexion.php">
                <p>
                    <input class="form-control" name="pseudo" type="text" placeholder="Pseudo..." required /><br><br>
                    <input class="form-control" name="mdp" type="password" placeholder="Mot de passe..." required /><br><br>
                    <input class="btn btn-primary" type="submit" value="Connexion " />
                    <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                    ?>
                </p>
            </form>         
        </div>
        <footer class="footer">
            <nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Mon forum</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Contact<span class="sr-only">(current)</span></a>
                    </li>
                    </ul>
                </div>
                <p>&copy; Forum 2019-2020</p>
            </nav>
        </footer>
    </body>
</html>


