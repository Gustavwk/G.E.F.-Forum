<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <header id="GEFHoved">
        <mainImg>
          <img src="josukeGif.gif" alt="Josuke siger hej">
        </mainImg>
        <h1>Velkommen til G.E.F Forum</h1>
        <?php if (!empty($_SESSION['user'])) : ?>
          <nav id="mainNavBar">
            <a href="logaf.php"><input type="button" value="Log af" /></a>
            <a href="startThread"><input type="button" value="Start Tråd" /></a>
            <a href="forum.php"><input type="button" value="Forum" /></a>
          </nav>
        <?php else : header('Location:login.html'); ?>
        <?php endif; ?>
      </header>

        <?php
        $id = $_POST['id'];
        if ($id == null){
          echo "id er null";
        }
        $sessionUser = $_SESSION['user'];
        $comments = [];

        if (file_exists("comments.txt"))
        {
          $string = file_get_contents("comments.txt");
          $comments = json_decode($string, true);
        }


        $existingSubmissions = [];
        if (file_exists("submissions.txt"))
        {
          $string = file_get_contents("submissions.txt");
          $existingSubmissions = json_decode($string, true);
        }


      echo $id;
      echo "<br>";
      echo $sessionUser;

      foreach ($comments as $c) {
        if ($c['OP'] == $sessionUser){
          echo "<br>";
          echo $c['comment'];
          echo "<button type='button' formaction ='editComment.php?'>Rediger Kommentar</button>";



        }
      }



          ?>






      <footer>
        <p>
         G.E.F er lavet af Gustav Weber, Emma Rasmussen og Freja Høy heraf navnet G.E.F.
       </p>
      </footer>
      </body>
      </html>
