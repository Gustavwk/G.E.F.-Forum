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
          </nav>
        <?php else : ?>
          <nav id="mainNavBar">
            <a href="signup.html"><input type="button" value="Opret profil" /></a>
            <a href="login.html"><input type="button" value="Log ind" /></a>
          </nav>
        <?php endif; ?>
      </header>
      <?php

      $submissions = [];

      if (file_exists("submissions.txt"))
      {
        $string = file_get_contents("submissions.txt");
        $submissions = json_decode($string, true);
      }

      foreach ($submissions as $s) {
        $id = $s["id"];
        $OP = $s["OP"];
        $title = $s["title"];
        echo "<a href='viewThread.php?id=$id'> $title</a>";
        echo " - $OP";
        echo "<br>";
      }
      ?>


      <footer>
        <p>
         G.E.F er lavet af Gustav Weber, Emma Rasmussen og Freja Høy heraf navnet G.E.F.
       </p>
      </footer>
  </body>
</html>
