<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
$comment = $_POST['comment'];
$id = $_POST['id'];
$OP = $_SESSION['user'];
$commentId;


$existingComments = [];
if (file_exists("comments.txt"))
{
  $string = file_get_contents("comments.txt");
  $existingComments = json_decode($string, true);
}

$commentId = sizeof($existingComments);

if (empty($_SESSION['user']))
{
  header('Location:login.html');
  exit;
}

// 1. Create user object
//    (Make an associative array that represents the new user)

if (!empty($_POST['comment']) && isset($_POST['id'])){



  $submittedComment= [

      "comment" => $comment,
      "OP" => $OP,
      "id" => $id,
      "CommentId" => $commentId,

  ];



}
echo "Data: ";
echo $comment;
echo " : ";
echo $OP;
echo " : ";
echo $id;


// 2. Read existing users from a file (if it exists; else initialize
//    to empty array):



// 3. Add new user to the end of the existing users:
$existingComments[] = $submittedComment;

// 4. Save all users back to file:
$string = json_encode($existingComments);
file_put_contents("comments.txt", $string);

header('Location:viewThread.php');
 ?>
