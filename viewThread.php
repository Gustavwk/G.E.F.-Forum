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
        <?php else : ?>
          <nav id="mainNavBar">
            <a href="forum.php"><input type="button" value="Forum" /></a>
            <a href="signup.html"><input type="button" value="Opret profil" /></a>
            <a href="login.html"><input type="button" value="Log ind" /></a>
          </nav>
        <?php endif; ?>
      </header>

      <?php
      $existingSubmissions = [];

      if (file_exists("submissions.txt"))
      {
        $string = file_get_contents("submissions.txt");
        $existingSubmissions = json_decode($string, true);
      }

      if(isset($_GET['id'])){
        $id = $_GET['id'];
        $currentSubmission = $existingSubmissions[$id];
        $op = $currentSubmission['OP'];
        $title=$currentSubmission['title'];
        $curretnSubmissionContent = $currentSubmission['submission'];


        echo "<h3>" . $title . "</h3>";
        echo "<br>";
        echo $curretnSubmissionContent;
        echo "<br>";
        echo " af ";
        echo $op;
        echo "<br>";
        echo "<br>";


      }else{
        echo "Ingen tråd valgt!";
      }
      echo "<br>";
      echo "<h5>Kommentarer:</h5> ";
      echo "<br>";
      echo "<br>";
      echo "<br>";


      $comments = [];

      if (file_exists("comments.txt"))
      {
        $string = file_get_contents("comments.txt");
        $comments = json_decode($string, true);
      }

      foreach ($comments as $c) {
        if ($c['id'] == $id){
          echo $c['comment'];
          echo "<br>";
          echo " af ";
          echo $c['OP'];
          echo "<br>";
          echo "<br>";
        }
      }



      ?>
      <?php if (!empty($_SESSION['user'])) : ?>
      <br>
      Kommenter:
      <form method="post" action="createComment.php">
      <br>
      <textarea name="comment" cols="30" rows="2" wrap="type"></textarea>
      <br>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" name="submitButton" value="Kommenter">
      </form>
      <?php endif; ?>

      <?php
      $hasCommitedComments = False;
      if (!empty($_SESSION['user'])){
      foreach ($comments as $c) {
        if ($c['OP']==$_SESSION['user'] && $c['id'] == $id){
          $hasCommitedComments= True;
        }
      }
    }
?>
    <?php if ($hasCommitedComments == True) : ?>
      <form method="post" action="viewComments.php">
        <input type="submit" name="submitButton" value="Rediger Kommentarer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
    <?php endif; ?>

      <footer>
        <p>
         G.E.F er lavet af Gustav Weber, Emma Rasmussen og Freja Høy heraf navnet G.E.F.
       </p>
      </footer>
      </body>
      </html>
