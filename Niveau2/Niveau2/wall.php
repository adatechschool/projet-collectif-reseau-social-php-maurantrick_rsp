<?php
session_start();
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include "menu.php"
    ?>
    <div id="wrapper">
        <?php
        /**
         * Etape 1: Le mur concerne un utilisateur en particulier
         * La première étape est donc de trouver quel est l'id de l'utilisateur
         * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
         * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
         * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
         */
        $userId = intval($_GET['user_id']);
        ?>

        <aside>
            <?php
            /**
             * Etape 2: se connecter à la base de donnée
             */
            include "donnees.php"           ?>
            <?php
            /**
             * Etape 3: récupérer le nom de l'utilisateur
             */
            $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
            //echo "<pre>" . print_r($user, 1) . "</pre>";

            ?>
            <img src="user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez tous les message de l'utilisatrice :
                    n° <?php echo $user["id"] ?>.
                    <?php echo $user["alias"] ?>
                    <?php
                    if ($_SESSION['connected_id'] == $user['id']) {
                        echo "<p> C'est mon mur, je peux publier. </p>";
                    } else {
                        echo "<p> Ce n'est pas mon mur.</p>";
                    }
                    ?>
                    <!-- <dt><label for='nouveau message'>Nouveau message :</label></dt>
                        <dd><input type='nouveau message'name='newmsg'></dd>
                        <input type="submit"> -->
                </p>

                <!-- <?php
                        if ($connectedUserId == $wallUserId) {
                            echo '<form action="user.php" method="post">
                    <textarea name="message" placeholder="Écrivez un message..."></textarea>
                    <button type="submit">Publier</button>
                    </form>';
                        }
                        ?> -->

            </section>
        </aside>
        <main>
            <?php
            $enCoursDeTraitement = isset($_POST['message']);
            if ($enCoursDeTraitement) {
                $monMessage = $_POST['message'];
                $sanitizedMessage = $mysqli->real_escape_string($monMessage);

                $instructionSQL = "INSERT INTO posts "
                    . "(id, user_id, content, created, parent_id) "
                    . "VALUES (NULL, "
                    . $_SESSION['connected_id'] . ", "
                    . "'" . $sanitizedMessage . "',"
                    . "NOW(), "
                    . "NULL);";

                $ok = $mysqli->query($instructionSQL);
                if (!$ok) {
                    echo "Impossible d'ajouter le message: " . $mysqli->error;
                } else {
                    echo "Message posté en tant que :" . $listAuteurs[$authorId];
                    header('Refresh:0; url=wall.php?user_id=' . $_SESSION['connected_id']);
                }
            }
            ?>

            <div <?php if ($_SESSION['connected_id'] !== $user['id']) {
                        echo " style='display: none'";
                    } ?>>
                <article>
                    <h3>Publier un nouveau message:</h3>
                    <form action="wall.php" method="post">
                        <input type='hidden'>
                        <dl>
                            <dt><label for='message'>Message</label></dt>
                            <dd><textarea name='message'></textarea></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                </article>
            </div>
            <?php
            /**
             * Etape 3: récupérer tous les messages de l'utilisatrice
             */

            $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, users.id as author_id, 
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
            }

            /**
             * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
             */

            while ($post = $lesInformations->fetch_assoc()) {

                // echo "<pre>" . print_r($post, 1) . "</pre>";
            ?>
                <article>
                    <h3>
                        <time datetime='2020-02-01 11:12:13'><?php echo $post['created'] ?></time>
                    </h3>
                    <address>
                        <a href="wall.php?user_id=<?php echo $post['author_id']; ?>">
                            <?php echo $post['author_name'] ?>
                        </a>
                    </address>
                    <div>

                        <p><?php echo $post['content'] ?></p>
                    </div>
                    <footer>
                        <small>💖<?php echo $post['like_number'] ?></small>
                        <a href="">#️⃣<?php echo $post['taglist'] ?></a>,

                    </footer>
                </article>
            <?php } ?>


        </main>
    </div>
</body>

</html>