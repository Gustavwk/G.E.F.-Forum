<?php
  // 1. Create user object
  //    (Make an associative array that represents the new user)

if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstname'])
    && !empty($_POST['lastname'])){



    $user = [
        "username" => $_POST["username"],
        "password" => $_POST["password"],
        "firstname" => $_POST["firstname"],
        "lastname" => $_POST["lastname"],
    ];

    header('Location:login.html');
  }


 else {
  echo "fill forms";
  exit();
}

  // 2. Read existing users from a file (if it exists; else initialize
  //    to empty array):
  $users = [];
  if (file_exists("users.txt"))
  {
    $string = file_get_contents("users.txt");
    $users  = json_decode($string, true);
  }


  // 3. Add new user to the end of the existing users:
  $users[] = $user;

  // 4. Save all users back to file:
  $string = json_encode($users);
  file_put_contents("users.txt", $string);

?>
