<!DOCTYPE html>
<html lang="nl">
<?php
include_once 'includes/head.html';  // import head
// Start session
session_start();
?>

<body>
  <!-- content -->
  <main>
    <div class="row">
      <div class="col s8 offset-s2 center offset">
        <h1>Bedankt voor de mooie woordjes</h1>
        <h3>Je hebt <?= $_SESSION['calories']?> Kcal verzameld voor je team!</h3>
        <a class="waves-effect waves-light btn-large green white-text" href="message.php">Nog een berichtje sturen</a>
      </div>
    </div>
  </main>

  <!-- footer -->
  <?php
  include_once 'includes/footer.html';
  ?>
  <!-- Jquery via CDN and verify it has not been tampered with -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!-- Compiled and minified JavaScript -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>