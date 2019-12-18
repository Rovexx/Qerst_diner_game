<?php
if (isset($_POST['submit'])) {
  if (isset($_POST['name'])) {
    if (isset($_POST['message'])) {
      if (isset($_POST['team'])) {
        include_once '../includes/dbh.php';
        // Safely save form data
        $name = mysqli_real_escape_string($conn, htmlentities($_POST['name']));
        $message = mysqli_real_escape_string($conn, htmlentities($_POST['message']));
        $team = intval($_POST['team']);

        $query = "INSERT INTO `messages` (`name`, `message`, `timestamp`, `team`) 
          VALUES ('$name', '$message', CURRENT_TIMESTAMP, '$team')";
        
        mysqli_query($conn, $query)
          or die('Error ' . mysqli_error($conn) . ' with query ' . $query);
        mysqli_close($conn);
        // Start session
        session_start();
        $_SESSION['calories'] = strlen($message);
        $_SESSION['team'] = $team;
        header("Location: ../thankYou.php?add=success");
      } else {
        header("Location: ../message.php?empty=team");
      }
    } else {
      header("Location: ../message.php?empty=message");
    }
  } else {
    header("Location: ../message.php?empty=name");
  }
} else
{
  header("Location: ../index.php?redirect=success");
}
exit();