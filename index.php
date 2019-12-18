<!DOCTYPE html>
<html lang="nl">
<?php
include_once 'includes/head.html';  // import head
?>

<body>
    <!-- content -->
    <main>
        <div class="row">
            <div class="col s8">
                <div class="row">
                    <!-- Incomming message -->
                    <div class="col s8 offset-s2 backgroundGreen" id="messageBox">
                    </div>
                </div>
                <div class="row">
                    <h2 class="center">Kcal race!</h2>
                    <p class="center">Voed je team met berichten, 1st to 2000 Kcal wins!</p>
                    <!-- Qerstman -->
                    <div class="row">
                        <div class="col s2">
                            <img class="responsive-img" src="images/team_1.jpg">
                        </div>
                        <div class="col s10">
                            <h4 id="0_Kcal">0 / 2000 Kcal</h4>
                            <div class="progress">
                                <div class="progress-bar backgroundGreen" id="0_progress" style="width: 1%;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Rudolph -->
                    <div class="row">
                        <div class="col s2">
                            <img class="responsive-img" src="images/team_2.jpg">
                        </div>
                        <div class="col s10">
                            <h4 id="1_Kcal">0 / 2000 Kcal</h4>
                            <div class="progress">
                                <div class="progress-bar backgroundLightGreen" id="1_progress" style="width: 1%;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Elf -->
                    <div class="row">
                        <div class="col s2">
                            <img class="responsive-img" src="images/team_3.jpg">
                        </div>
                        <div class="col s10">
                            <h4 id="2_Kcal">0 / 2000 Kcal</h4>
                            <div class="progress">
                                <div class="progress-bar backgroundDarkGreen" id="2_progress" style="width: 1%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Messages -->
            <div id="messageArea" class="col s4">
                <table class="bordered striped" >
                    <thead>
                        <tr>
                            <th class="center">Berichten</th>
                        </tr>
                    </thead>
                    <tbody id="messageTable" class="dataTable">
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- footer -->
    <?php
    include_once 'includes/footer.html';
    ?>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/reqwest/2.0.5/reqwest.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</body>

</html>