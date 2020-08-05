<?php session_start();
include_once 'function/function.php';
include_once 'function/addSujet.class.php';
$bdd = bdd();

if(isset($_POST['name']) AND isset($_POST['sujet'])){
    
    $addSujet = new addSujet($_POST['name'],$_POST['sujet'],$_POST['categorie']);
    $verif = $addSujet->verif();
    if($verif == "ok"){
        if($addSujet->insert()){
            header('Location: index.php?sujet='.$_POST['name']);
        }
    }
    else {/*Si on a une erreur*/
        $erreur = $verif;
    }
    
}



?>
<!DOCTYPE html>
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
 <h1>Ajouter un sujet</h1>
    
            <div id="Cforum">
                <?php  echo 'Bienvenue <strong>'.$_SESSION['pseudo'].'</strong>  - <a href="deconnexion.php">Deconnexion</a> '; ?>
                <form method="post" action="addSujet.php?categorie=<?php echo $_GET['categorie']; ?>">
                    <p>
                        <br><input class="form-control" type="text" name="name" placeholder="Nom du sujet..." required/><br>
                        <textarea class="form-control" name="sujet" placeholder="Contenu du sujet..."></textarea><br>
                        <input type="hidden" value="<?php echo $_GET['categorie']; ?>" name="categorie" />
                        <input class="btn btn-primary" type="submit" value="Ajouter votre sujet" />
                        <?php 
                        if(isset($erreur)){
                            echo $erreur;
                        }
                        ?>
                    </p>
                </form>
            </div>
</body>
</html>
