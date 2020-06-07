<?php

/**
 * Nom du projet  : Evaluation Films
 * Nom du fichier : register.php
 * Auteur         : Diogo Canas Almeida
 * Date           : 29 mai 2020
 * Description    : Page d'inscription
 * Version        : 1.0
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/inc/inc.all.php';
session_start();

$nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$verifPassword = filter_input(INPUT_POST, 'verifPassword', FILTER_SANITIZE_STRING);
$registerButton = filter_input(INPUT_POST, 'register');
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Page d'inscription</title>
</head>

<body>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . 'html/navbar.php'; ?>
  <div class="container">
    <?php
    if (isset($registerButton)) {
      if (!empty($nickname) && !empty($email) && !empty($password) && !empty($verifPassword)) {
        if ($password == $verifPassword) {
          if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (UserManager::exist($nickname, $email)) {
              if (UserManager::create($nickname, $email, $password)) {
                showSuccess("L'inscription a fonctionné! Merci de confirmer votre adresse mail avant de vous connecter.");
              } else {
                showError("L'inscription a échoué.");
              }
            } else {
              showError("Ce/cette nickname et/ou adresse mail est déjà utilisée.");
            }
          } else {
            showError("Votre adresse mail n'est pas valide.");
          }
        } else {
          showError("Les mots de passes ne correspondent pas.");
        }
      } else {
        showError("Veuillez remplir tous les champs.");
      }
    }
    ?>
    <form method="POST" action="register.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nickname">Nickname</label>
        <input type="text" class="form-control" id="nickname" name="nickname" value="<?= $nickname ?>" autofocus required>
      </div>
      <div class="form-group">
        <label for="email">Adresse mail</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $email ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="verifPassword">Vérification du mot de passe</label>
        <input type="password" class="form-control" id="verifPassword" name="verifPassword" required>
      </div>
      <button type="submit" class="btn btn-primary" name="register">S'inscrire</button>
    </form>
  </div>
  <?php
  include_once $_SERVER['DOCUMENT_ROOT'] . 'html/footer.php';
  ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>