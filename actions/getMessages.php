<?php 
  include_once '../includes/dbh.php';    // import database connection
  // Get todays statistics
  $query = "SELECT *
      FROM `messages` ORDER BY timestamp DESC LIMIT 10";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
  $data = [];
  while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
  }
  header("Content-Type: application/json");
  echo json_encode($data);
?>