<?php
if (isset($_POST['score_1'], $_POST['score_2'], $_POST['score_3'])) {
  include_once '../includes/dbh.php';
  $score_1 = intval($_POST['score_1']);
  $score_2 = intval($_POST['score_2']);
  $score_3 = intval($_POST['score_3']);
  if (isset($_POST['team'])) {
    $winningTeam = intval($_POST['team']);

    // Get current amount of rounds won for the team
    $query = "SELECT `won_times_team_$winningTeam` FROM `gamestate` WHERE `id` = 1";
    $result = mysqli_query($conn, $query)
      or die('Error ' . mysqli_error($conn) . ' with query ' . $query);
    $won_times = intval(mysqli_fetch_all($result, MYSQLI_NUM)[0][0]) + 1;
    // Reset scores and add winning team one win
    $query = "UPDATE `gamestate`
      SET `team_1_score` = '$score_1',
      `team_2_score` = '$score_2',
      `team_3_score` = '$score_3',
      `won_times_team_$winningTeam` = '$won_times'
      WHERE `gamestate`.`id` = 1";
    mysqli_query($conn, $query)
      or die('Error ' . mysqli_error($conn) . ' with query ' . $query);
    mysqli_close($conn);
  } else {
    $query = "UPDATE `gamestate` 
      SET `team_1_score` = '$score_1',
      `team_2_score` = '$score_2',
      `team_3_score` = '$score_3'
      WHERE `gamestate`.`id` = 1";

    mysqli_query($conn, $query)
      or die('Error ' . mysqli_error($conn) . ' with query ' . $query);
    mysqli_close($conn);
  }
} else {
  header("Content-Type: application/json");
  echo json_encode("Error no data recieved");
}
exit();