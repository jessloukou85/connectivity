<?php
        include('DB/cnxion.php');
        $msg='';
        var_dump($_POST);
         if(isset($_POST['last_name'],$_POST['first_name'],$_POST['login'],$_POST['mail'],$_POST['password'])){
           $no = (string) htmlspecialchars ($_POST['last_name']);
           $pr = (string) htmlspecialchars ($_POST['first_name']);
           $sp = (string) htmlspecialchars ($_POST['login']);
           $ml = (string) htmlspecialchars ($_POST['mail']);
           $pw = (string)htmlspecialchars($_POST['password']);
           $pw = 'jess';
           $hash = password_hash($pw,PASSWORD_DEFAULT);
           var_dump($pw);
           var_dump($hash);

           if(!empty($no)and!empty($pr)and!empty($sp)and!empty($ml)and!empty($pw)){
              $mel = $db->prepare('SELECT * from users where mail =?');
              $mel->execute([$ml]);
              $melExist = $mel->rowcount();
              if($melExist){
                $msg = "cette adresse mail existe deja dans le base de donnée";
              }else{
                $req = $db->prepare('INSERT INTO `users`(`id`, `last_name`, `first_name`, `speudo`, `mail`, `password`) VALUES (null,?,?,?,?,?)');
                $res = $req->execute([$no,$pr,$sp,$ml,$pw]);
                if($res){
                     $msg = "l'utilisateur à bien été enregistré";
                  }else{
                     $msg = "erreur d'insertion reessayer!!!";
                    }
                  } 
            }else{
              $msg = "veuillez remplir tous les champs merci";
            }
        } 
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1><?php echo $msg; ?></h1>
<div class="container">

  <form method="post" action="">
    <div class="form-row">
      <div class="col-md-3 mb-3">
        <label for="form-label">Last name</label>
        <input type="text" class="form-control" name="last_name" required>
      </div>
      <div class="col-md-3 mb-3">
        <label for="form-label">First name</label>
        <input type="text" class="form-control" name="first_name" required>
      </div>
      <div class="col-md-3 mb-3">
        <label for="form-label">login</label>
        <input type="text" class="form-control" name="login" required>
      </div>
      <div class="col-md-3 mb-3">
        <label for="form-label">Mail</label>
        <input type="email" class="form-control" name="mail" required>
      </div>
      <div class="col-md-3 mb-3">
        <label for="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
    </div>
    <div>
      <button class="btn btn-primary" type="submit">sauvegarder</button>
    </div>
  </form>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  </body>
</html>
