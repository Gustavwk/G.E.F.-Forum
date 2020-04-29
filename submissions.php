<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$title = $_POST['title'];
$submission = $_POST['submission'];
$OP = $_SESSION['user'];

$existingSubmissions = [];
if (file_exists("submissions.txt"))
{
  $string = file_get_contents("submissions.txt");
  $existingSubmissions = json_decode($string, true);
}
$numericalId = sizeof($existingSubmissions);


if (empty($_SESSION['user']))
{
  header('Location:login.html');
  exit;
}

// 1. Create user object
//    (Make an associative array that represents the new user)

if (!empty($_POST['title']) && !empty($_POST['submission'])){



  $threadItem = [

      "title" =>  $title,
      "submission" => $submission,
      "OP" => $OP,
      "id" => $numericalId,

  ];

$numericalId++;

}




// 2. Read existing users from a file (if it exists; else initialize
//    to empty array):



// 3. Add new user to the end of the existing users:
$existingSubmissions[] = $threadItem;

// 4. Save all users back to file:
$string = json_encode($existingSubmissions);
file_put_contents("submissions.txt", $string);

echo <<<END
<!doctype html>
<meta charset="utf-8">
<html>
  <head>
    <style>
    </style>
  </head>
  <style>
  </style>
  <body>
  <header id="GEFHoved">
    <mainImg>
      <img src="josukeGif.gif" alt="Josuke siger hej">
    </mainImg>
    <h1>Velkommen til G.E.F Forum</h1>
    <nav id="LoginNavBar">
      <!--Hyperlink reference med knap på-->
      <a href="forum.php"><input type="button" value="Forum" /></a>
      <a href="logaf.php"><input type="button" value="Log af" /></a>
    </nav>
  </header>




  </body>
</html>








END;
echo $title;
echo "<br> ";
echo $submission;
echo "<br> ";
echo $OP;
echo "<br> ";
echo $numericalId;
echo "<br> ";
echo <<<END
<!doctype html>
<meta charset="utf-8">
<html>
<body>
<footer>
  <p>
   G.E.F er lavet af Gustav Weber, Emma Rasmussen og Freja Høy heraf navnet G.E.F.
 </p>
</footer>
</body>
</html>
END;
 ?>
