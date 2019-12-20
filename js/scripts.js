var firstTimeSetup = true;
var team_1_score = 0;
var team_2_score = 0;
var team_3_score = 0;
var lastMessageId;
var multiplier = 1;
var maxCalories = 2000;
var url = 'ws://192.168.1.205:599';
var connection;
resetGame();

function resetGame() {
    firstTimeSetup = true;
    team_1_score, team_2_score, team_3_score = 0;
    lastMessageId = undefined;
    mulitplier = 1;
    websocketSetup();
    updateData();
    updateGamestate(team_1_score, team_2_score, team_3_score);
}


function websocketSetup() {
    connection = new WebSocket(url);
    connection.onopen = function(evt) { onOpen(evt) };
    connection.onerror = function(evt) { onError(evt) };
    connection.onclose = function(evt) { onClose(evt) };
}
// Called when a WebSocket connection is established with the server
function onOpen(evt) {
    console.log("Connected");
    connection.send(0);
}
// Called when a WebSocket error occurs
function onError(evt) {
    console.log("ERROR: " + evt.data);
}
// Called when the WebSocket connection is closed
function onClose(evt) {
    // Log disconnection state
    console.log("Disconnected");
    // Try to reconnect after a few seconds
    setTimeout(function() { websocketSetup(url) }, 2000);
}

/**
 * Update gamescreen every second for new messages
 */
function updateData() {
    reqwest({
        url: 'actions/getMessages.php',
        contentType: 'application/json',
        success: successHandler,
        error: errorHandler
    })
}
setInterval(updateData, 1000);

/**
 * Something went wrong while getting data
 * @param {*} error 
 */
function errorHandler(error) {
    console.log('Error while reloading Data ', error);
}

/**
 * Update message board with latest messages
 * @param {*} data The last 10 messages from the database
 */
function setMessageBoard(data) {
    let tableData = document.getElementById("messageTable");
    tableData.innerHTML = "";
    data.forEach(message => {
        let messageDate = new Date(message.timestamp);
        messageDate = messageDate.getHours() + ":" + messageDate.getMinutes() + ":" + messageDate.getSeconds();
        let teamName = message.team == 0 ? "Qerstman" : message.team == 1 ? "Rudolph" : message.team == 2 ? "Elf" : "None";
        let html = `
            <tr>
                <td class="col s12">
                    <div class="row">
                        <div class="col s2 center">
                            <p class="bold">${message.name}</p>
                            <p>Team: ${teamName}</p>
                            <p>${messageDate}</p>
                        </div>
                        <div class="col s10">
                            <p>${message.message}</p>
                        </div>
                    </div>
                </td>
            </tr>`;
        tableData.innerHTML += html;
    });
}
/**
 * Show latest message in the top bar
 * @param {*} data 
 * @param {*} lastMessageDate 
 */
function popUp(data, lastMessageDate) {
    let lastMessageTime = lastMessageDate.getHours() + ":" + lastMessageDate.getMinutes() + ":" + lastMessageDate.getSeconds();
    let teamName = data['team'] == 0 ? "Qerstman" : data['team'] == 1 ? "Rudolph" : data['team'] == 2 ? "Elf" : "None";
    document.getElementById("messageBox").innerHTML = `
        <div class="row z-depth-5">
            <div class="col s4 center backgroundGreen">
                <h5 class="white-text bold">${data['name']}</h5>
                <p class="white-text">Team: ${teamName}</p>
                <p class="white-text">${lastMessageTime}</p>
            </div>
            <div class="col s8 backgroundLightGreen">
                <p class="white-text">${data['message']}<p>
            </div>
        </div>
    `;
}

/**
 * Add the last message characters as score to the selected team
 * @param {*} team 
 * @param {*} calories 
 */
function addKcal(team, calories) {
    let progressBar = document.getElementById(`${team}_progress`);
    let Kcal = document.getElementById(`${team}_Kcal`)
    switch(team) {
        case 0:
            newScore = team_1_score + calories*multiplier;
            if (newScore >= maxCalories) {
                progressBar.style.width = "100%";
                Kcal.innerHTML = `${maxCalories} / ${maxCalories} Kcal`
                winScenario(1);
            } else {
                team_1_score = newScore;
                progressBar.style.width = ((team_1_score/maxCalories)*100) + "%";
                Kcal.innerHTML = `${team_1_score} / ${maxCalories} Kcal`
            }
            break;
        case 1:
            newScore = team_2_score + calories*multiplier;
            if (newScore >= maxCalories) {
                progressBar.style.width = "100%";
                Kcal.innerHTML = `${maxCalories} / ${maxCalories} Kcal`
                winScenario(2);
            } else {
                team_2_score = newScore;
                progressBar.style.width = ((team_2_score/maxCalories)*100) + "%";
                Kcal.innerHTML = `${team_2_score} / ${maxCalories} Kcal`
            }
            break;
        case 2:
            newScore = team_3_score + calories*multiplier;
            if (newScore >= maxCalories) {
                progressBar.style.width = "100%";
                Kcal.innerHTML = `${maxCalories} / ${maxCalories} Kcal`
                winScenario(3);
            } else {
                team_3_score = newScore;
                progressBar.style.width = ((team_3_score/maxCalories)*100) + "%";
                Kcal.innerHTML = `${team_3_score} / ${maxCalories} Kcal`
            }
            break;
    };
    updateGamestate(team_1_score, team_2_score, team_3_score);
}

/**
 * Do all game logic when succesfully retrieved latest messages from database
 * @param {*} data 
 */
function successHandler(data) {
    if (data.length > 0) {
        if (firstTimeSetup) {
            firstTimeSetup = false;
            setMessageBoard(data);
        }
        // check for new message
        let currentDate = new Date()
        currentDate = currentDate.getFullYear()
            +'-'+
            (currentDate.getMonth()+1)
            +'-'+
            currentDate.getDate()
            +' '+
            currentDate.getHours()
            + ":" +
            currentDate.getMinutes()
            + ":" +
            currentDate.getSeconds();
        let lastMessageDate = new Date(data[0]['timestamp']);
        // Is the last message from the last 30 seconds
        if ((Date.parse(currentDate) - Date.parse(lastMessageDate)) < (30*1000)) {
            // Did we already show this message
            if (data[0]['id'] !== lastMessageId) {
                lastMessageId = data[0]['id'];
                // Update message history
                setMessageBoard(data);
                // Show popup with new message
                popUp(data[0], lastMessageDate);
                // Increase Kcal for team
                addKcal(parseInt(data[0]['team']), data[0]['message'].length);
            } 
        } else {
            document.getElementById("messageBox").innerHTML = "";
        }
    }
}

/**
 * Trigger the ESP32 for the winning team
 * @param {*} winningTeam 
 */
function winScenario(winningTeam) {
    team_1_score = 0;
    team_2_score = 0;
    team_3_score = 0;
    console.log(`Team ${winningTeam} won!`);
    connection.send(winningTeam);
    updateGamestate(team_1_score, team_2_score, team_3_score, winningTeam);
}

function updateGamestate(team_1, team_2, team_3, teamWon) {
    // A team has won
    if (teamWon) {
        // request with team won and reset scores
        reqwest({
            url: 'actions/updateGamestate.php',
            method: 'post',
            data: {score_1: team_1, score_2: team_2, score_3: team_3, team: teamWon},
            success: successHandlerGamestate,
            error: errorHandlerGamestate
        });
    } else {
        // Simply update team scores
        reqwest({
            url: 'actions/updateGamestate.php',
            method: 'post',
            data: {score_1: team_1, score_2: team_2, score_3: team_3},
            success: successHandlerGamestate,
            error: errorHandlerGamestate
        });
    } 
}
function successHandlerGamestate(data) {
    console.log("updated gamestate");
}
function errorHandlerGamestate(error) {
    console.log("Updating the gamestate went wrong: ", error);
}
