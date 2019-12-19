<!DOCTYPE html>
<html lang="nl">
<?php
include_once 'includes/head.html';  // import head
?>

<body>
  <!-- content -->
  <main>
    <div class="row">
      <div class="col s12 m8 offset-m2 center offset">
        <form action="actions/sendMessage.php" method="POST">
          <h2>Verstuur een bericht</h2>
          <p>Het aantal karakters dat je bericht bevat zijn de caloriën voor je gekozen team</p>
          <div class="input-field col s12">
            <input 
              placeholder="Van wie is dit bericht?"
              name="name"
              id="name"
              type="text"
              class="validate"
              data-length="30"
              required>
            <label for="naam">Naam</label>
            <span class="helper-text" data-error="Dit is een verplicht veld"></span>
          </div>
          <div class="input-field col s12">
            <textarea 
              placeholder="Wat is je bericht?"
              name="message"
              id="message"
              class="materialize-textarea"
              data-length="200"
              required></textarea>
            <label for="message">Bericht</label>
          </div>
          <div class="input-field col s12">
            <select name="team" id="team" type="text" class="validate" required>
              <option value="0">Team Qerstman</option>
              <option value="1">Team Rudolph</option>
              <option value="2">Team Elf</option>
            </select>
            <label>Team</label>
          </div>
          <div class="col s12 center">
            <button class="btn-large waves-effect waves-light backgroundLightGreen" type="submit" name="submit" value="submit">Verstuur
              <i class="material-icons right">send</i>
            </button>
          </div>
        </form>
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
  <!-- scripts -->
  <script>
      $(document).ready(function() {
        $('input#name, textarea#message').characterCounter();
        $('select').formSelect();
    });
  </script>
  <?php
  // Error popup for form
  if (isset($_GET['empty'])) {
    if ($_GET['empty'] == 'name') {?>
      <script>
        window.M.toast({
          html: 'Van wie komt dit bericht?'
        })
      </script>
    <?php
    } if ($_GET['empty'] == 'message') {?>
      <script>
        window.M.toast({
          html: 'Hey, ik wil graag ook een berichtje!'
        })
      </script>
    <?php
    }
  }?>
</body>

</html>