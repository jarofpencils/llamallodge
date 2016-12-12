<?php
require('db.php');
$query = "SELECT * FROM users WHERE ((username = :username) && (userpass = :userpass))";
      $statement = $db->prepare($query);
      if(!$statement)
      {
        exit("An error has occured. Prepared statement has failed catastrophically.");
      }

      $bind_results = $statement->bindValue(':username', $_SESSION['username']);
      if (!$bind_results)
      {
        exit("Failed to bind values.");
      }

      $bind_results = $statement->bindValue(':userpass', $_SESSION['userpass']);
      if (!$bind_results)
      {
        exit("Failed to bind values.");
      }

      $workQuery = $statement->execute();
      if(!$workQuery)
      {
        exit("Execution failed.");
      }

      $curUser = $statement -> fetch();
      $statement -> closeCursor();
      if($curUser != false)
      {
        Session["username"] = "";
        Session["login"] = true
      } else {
        header('Location: ../view/groups.php');
      }
?>
