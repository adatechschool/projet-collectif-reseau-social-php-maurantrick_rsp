<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>ReSoC - Connexion</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
include "menu.php";
?>
<div id="wrapper">
    <aside>
        <h2>Présentation</h2>
        <p>Bienvenu sur notre réseau social.</p>
    </aside>
    <main>
        <article>
            <h2>Connexion</h2>
            <?php
            /**
             * TRAITEMENT DU FORMULAIRE
             */
            // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
            $enCoursDeTraitement = isset($_POST['email']);
            if ($enCoursDeTraitement)
            {
                // on ne fait ce qui suit que si un formulaire a été soumis.
                // Etape 2: récupérer ce qu'il y a dans le formulaire @todo: c'est là que votre travaille se situe
                $emailAVerifier = $_POST['email'];
                $passwdAVerifier = $_POST['motpasse'];

                // Etape 3 : Ouvrir une connexion avec la base de donnée.
                include "donnees.php";
                // Etape 4 : Petite sécurité
                $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                $passwdAVerifier = md5($passwdAVerifier);
                // NB: md5 est pédagogique mais n'est pas recommandée pour une vraie sécurité
                // Etape 5 : construction de la requête
                $lInstructionSql = "SELECT * "
                    . "FROM users "
                    . "WHERE "
                    . "email LIKE '" . $emailAVerifier . "'";
                // Etape 6: Vérification de l'utilisateur
                $res = $mysqli->query($lInstructionSql);
                $user = $res->fetch_assoc();
                if ( ! $user OR $user["password"] != $passwdAVerifier)
                {
                    echo "La connexion a échouée.";
                } else
                {
                    echo "Votre connexion est un succès : " . $user['alias'] . ".";
                    // Etape 7 : Se souvenir que l'utilisateur s'est connecté pour la suite
                    $_SESSION['connected_id'] = $user['id'];
                    // Redirection vers la page wall.php de l'utilisateur
                    header("Location: wall.php?user_id=" . $user['id']);
                    exit();
                }
            }
            ?>
            <form action="login.php" method="post">
                <dl>
                    <dt><label for='email'>E-Mail</label></dt>
                    <dd><input type='email' name='email' required></dd>
                    <dt><label for='motpasse'>Mot de passe</label></dt>
                    <dd><input type='password' name='motpasse' required></dd>
                </dl>
                <input type='submit' value='Connexion'>
            </form>
            <p>
                Pas de compte?
                <a href='registration.php'>Inscrivez-vous.</a>
            </p>
        </article>
    </main>
</div>
</body>
</html>
