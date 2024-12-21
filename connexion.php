<?php
// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Récupération des informations de connexion
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Vérification si les champs sont vides
  if (empty($username) || empty($password)) {
    echo "Erreur : les champs doivent être remplis.";
  } else {
    // Connexion à la base de données (à remplacer par vos informations)
    $servername = "localhost";
    $dbname = "nom_de_la_base";
    $dbusername = "nom_utilisateur";
    $dbpassword = "mot_de_passe";

    // Création de la connexion
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
      die("Erreur de connexion : " . $conn->connect_error);
    }

    // Requête pour vérifier les informations de connexion
    $sql = "SELECT * FROM utilisateurs WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Vérification si l'utilisateur existe
    if ($result->num_rows > 0) {
      // Récupération des informations de l'utilisateur
      $user = $result->fetch_assoc();
      echo "Bonjour, " . $user['username'] . " !";
    } else {
      echo "Erreur : identifiants incorrects.";
    }

    // Fermeture de la connexion
    $conn->close();
  }
}
?>
```

*Formulaire HTML (modifié)*
```
<form class="form-connexion" action="connexion.php" method="post">
  <h2>Connexion</h2>
  <div class="input-group">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
  </div>
  <div class="input-group">
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
  </div>
  <button type="submit">Se connecter</button>
  <p><a href="#">Mot de passe oublié ?</a></p>
</form>