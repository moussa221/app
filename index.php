<?php 
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require('vendor/autoload.php');

include_once 'function/function.php';
include_once 'function/addPost.class.php';
$bdd = bdd();

if(!isset($_SESSION['id'])){
    header('Location: inscription.php');
}
else {
    
    if(isset($_POST['name']) AND isset($_POST['sujet'])){
    
    $addPost = new addPost($_POST['name'],$_POST['sujet']);
    $verif = $addPost->verif();
    if($verif == "ok"){
        if($addPost->insert()){
            
        }
    }
    else {/*Si on a une erreur*/
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
        <h1>Bienvenue sur le forum des développeurs</h1> 
                <div id="Cforum">
                    <?php 
                    echo 'Bienvenue: <strong>'.$_SESSION['pseudo'].'</strong>  - <a href="deconnexion.php">Deconnexion</a> ';
                    if(isset($_GET['categorie'])){ /*SI on est dans une categorie*/
                        $_GET['categorie'] = htmlspecialchars($_GET['categorie']);
                        ?>
                        <div class="categories">
                        <h1><?php echo $_GET['categorie']; ?></h1>
                        </div>
                    <a href="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">Ajouter un sujet</a>
                    <?php 
                    $requete = $bdd->prepare('SELECT * FROM sujet WHERE categorie = :categorie ');
                    $requete->execute(array('categorie'=>$_GET['categorie']));
                    while($reponse = $requete->fetch()){
                        ?>
                        <div class="categories">
                            <a href="index.php?sujet=<?php echo $reponse['name'] ?>"><h1><?php echo $reponse['name'] ?></h1></a>
                        </div>
                        <?php
                    }
                    ?>
                    
                        
                        <?php
                    }
                    
                    else if(isset($_GET['sujet'])){ /*SI on est dans une categorie*/
                        $_GET['sujet'] = htmlspecialchars($_GET['sujet']);
                        ?>
                        <div class="categories">
                        <h1><?php echo $_GET['sujet']; ?></h1>
                        </div>
                    
                    <?php 
                    $requete = $bdd->prepare('SELECT * FROM postSujet WHERE sujet = :sujet ');
                    $requete->execute(array('sujet'=>$_GET['sujet']));
                    while($reponse = $requete->fetch()){
                        ?>
                    <div class="post">
                        <?php 
                        $requete2 = $bdd->prepare('SELECT * FROM membres WHERE id = :id');
                        $requete2->execute(array('id'=>$reponse['auteur']));
                        $membres = $requete2->fetch();
                        echo $membres['pseudo']; echo ': <br>';
                        
                        echo $reponse['contenu'];
                        ?>
                    </div> 
                    <?php
                    
                    }
                    ?>
                    
                    <form method="post" action="index.php?sujet=<?php echo $_GET['sujet']; ?>"><br>
                        <p><hr>
                            <h1><strong><u>Commentaires:</u></strong></h1>
                            <div class="ui form">
                                <div class="field">
                                    <textarea name="sujet" placeholder="Votre message..." ></textarea><br>
                                </div>
                            <input type="hidden" name="name" value="<?php echo $_GET['sujet']; ?>" /><br>
                            <input class="btn btn-primary" type="submit" value="Ajouter à la conversation" /><br>
                            <?php 
                            if(isset($erreur)){
                                echo $erreur;
                            }
                            ?>
                        </p>
                        </form>
                    <?php
                    }
                    else { /*Si on est sur la page normal*/
                        
                        
                    
                            $requete = $bdd->query('SELECT * FROM categories');
                            while($reponse = $requete->fetch()){
                            ?>
                                <div class="categories">
                                    <a href="index.php?categorie=<?php echo $reponse['name']; ?>"><?php echo $reponse['name']; ?></a>
                                </div>
                    
                        <?php 
                        }
                        
                    }
                    ?>
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
                <<p>&copy; Forum 2019-2020</p>>
            </nav>
        </footer>
    </body>
</html>
    <?php
}
?>

    
