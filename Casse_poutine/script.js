// TODO :
// - Press start menu

// Game constants
var canvas = document.getElementById("canvasElem");
var context = canvas.getContext("2d");
var GAME_ZONE_WIDTH = 600;
var GAME_ZONE_HEIGHT = 1300;

var KEY_RIGHT = 39;
var KEY_LEFT = 37;
var KEY_UP = 38;

var LINE_COUNT = 3;
var BRICK_BY_LINE_COUNT = 10;
var BRICK_WIDTH = 98;
var BRICK_HEIGHT = 50;
var BRICK_SPACE = 5;
var BRICK_HALF_SPACE = 3;
var BRICK_MARGIN_TOP = 40;
var BRICK_COLORS_1 = ["#EEEEEE", "#FFAAAA", "#FFFFAA", "#AAAAFF", "#FFAAFF", "#AAFFAA"];
var BRICK_COLORS_2 = ["#AAAAAA", "#CC0000", "#CCCC00", "#0000CC", "#CC00CC", "#00CC00"];

var BAR_WIDTH = 120;
var BAR_HEIGHT = 20;
var BAR_SPEED = 4;
var BAR_COLOR_1 = "#FFFFFF";
var BAR_COLOR_2 = "#777777";
var BAR_BORDER_COLOR = "#3333FF";
var BAR_BORDER_SIZE = 10;

var BALL_COLOR;
var BALL_SIZE = 12;
var BALL_SPEED = 2;

var BONUS_WIDTH = 48;
var BONUS_HEIGHT = 15;
var BONUS_COUNT = 8;
var BONUS_TEXTS = ["Spd++", "Spd--", "Three", "Super", "Bar++", "Bar--", "Stick", "Shoot"];
var BONUS_COLORS_1 = ["#FFFFFF", "#FFFFFF", "#FFFFFF", "#FFFFFF", "#FFFFFF", "#FFFFFF", "#FFFFFF", "#FFFFFF"];
var BONUS_COLORS_2 = ["#FF0000", "#FFFF00", "#00FFFF", "#0000FF", "#FF00FF", "#00FF00", "#000000", "#A0A0A0"];
var BONUS_RANDOM = 0.7;

var SUPER_BALL_DURATION = 10;
var SUPER_BALL_COLOR = "#FF0000";

var CANON_WIDTH = 2;
var CANON_HEIGHT = 6;
var MISSILE_WIDTH = 2;
var MISSILE_HEIGHT = 6;
var MISSILE_COUNT = 3;
var MISSILE_SPEED = 3;
var POWER_SHOOT_DURATION = 10;

var POWER_STICK_DURATION = 10;

var SCORE_BRICK = 100;
var SCORE_POWER = 50;
var SCORE_X = 10;
var SCORE_Y = 22;
var SCORE_COLOR = "#FF0000";

var LEVEL = ["01111111100222222220000000000",
  "01111111100222222220022222222",
  "01111111100333333330033333333"];
var LEVEL_COUNT = 3;


// Variables
var context;
var iGameLoopId;			// Game loop identifier
var bWin = 0;			// True if all bricks are destroyed

var aBricks;			// Brick array
var fBrickBound = (BRICK_SPACE + BRICK_HEIGHT) * LINE_COUNT + BRICK_MARGIN_TOP;	// Brick bound for collisions

var fBarX;				// Bar position
var fBarY;
var fBarMoveX = 0;
var fBarSizeFactor = 1;

var fBallX = [100, 100, 100];	// Ball position
var fBallY = [250, 250, 250];
var fPrevBallX = [100, 100, 100];	// Previous ball position
var fPrevBallY = [250, 250, 250];
var fBallDirX = [1, 1, 1];		// Ball direction
var fBallDirY = [-1, -1, -1];
var fBallSpeedFactor = 1;		// Ball speed factor [0.5; 2]
var bBallLaunched = 0;		// True if the ball is launched
var bBallAlive = [1, 0, 0];		// True if the ball is alive
var fBallSpeedMultiplicator = 1;	// Increase when a brick is destroyed
var fBallSizeFactor = 1;

var bKeyRightPressed = 0;
var bKeyLeftPressed = 0;

var fBonusX = 0;			// Bonus position
var fBonusY = 0;
var bBonusAlive = 0;		// True if the bonus is alive
var iBonusPower = 0;		// Bonus power identifier (super ball, 3 balls, ball speed * 2, ...)

var fPowerTimer = 0;

var bSuperBall = 0;			// True if the super ball is activated

var bPowerStick = 0;		// True if the stick power is activated
var bStick = [0, 0, 0];		// True if ball stick on bar
var fStickX = [0, 0, 0];		// Ball position according to bar when stick

var bPowerShoot = 0;		// True if the shoot power is activated
var fMissile1X = [0, 0, 0];		// Missile positions
var fMissile1Y = [0, 0, 0];
var fMissile2X = [0, 0, 0];
var fMissile2Y = [0, 0, 0];
var bMissile1Alive = [0, 0, 0];	// True if the missile is alive
var bMissile2Alive = [0, 0, 0];

var iScore = 0;

var iLifeCount = 3;

var iLevel = 1;

var bkgImagepp;
var bkgImageWin;
var bkgImage;			// Resources
var brickImage = [new Image(), new Image(), new Image(), new Image()];
var ballImage;
var lifeImage;
var barImage;
var missileImage;




/***************************************************************************************************************************/
/* Constructor													       */
/***************************************************************************************************************************/

// Initialize the game
window.addEventListener('load',
  function () {
    // Get the canvas
    var elem = document.getElementById('canvasElem');
    if (!elem || !elem.getContext) {
      return;
    }

    // Get the 2D context
    context = elem.getContext('2d');
    if (!context) {
      return;
    }

    // Initialize ball, bar and game zone
    GAME_ZONE_WIDTH = elem.width;
    GAME_ZONE_HEIGHT = elem.height;
    fBarX = (GAME_ZONE_WIDTH * 0.5) - (BAR_WIDTH * 0.5);
    fBarY = (GAME_ZONE_HEIGHT - BAR_HEIGHT) - 6;
    fBallX[0] = fBarX + BAR_WIDTH * 0.5;
    fBallY[0] = fBarY - BALL_SIZE;
    fPrevBallX[0] = fBallX[0];
    fPrevBallY[0] = fBallY[0];

    // Initialize the bricks
    createBricks(LINE_COUNT, BRICK_BY_LINE_COUNT, BRICK_WIDTH, BRICK_HEIGHT, BRICK_SPACE);

    // Game loop : 100 fps
    iGameLoopId = setInterval(refreshGame, 10);

    // Keyboard event listener
    window.document.onkeydown = onKeyDown;
    window.document.onkeypress = onKeyPress;
    window.document.onkeyup = onKeyUp;

    // Mouse event listener
    window.document.onclick = onClick;
    window.document.onmousemove = onMouseMove;


    // Accelerometer event listener
    if (window.DeviceMotionEvent != undefined) {
      window.ondevicemotion = onDeviceMotion;
    }

    bkgImagepp = new Image();
    bkgImagepp.src = "resources/poupou.png";

    // Load background image défaite
    bkgImage = new Image();
    bkgImage.src = "resources/loose.jpg";
    bkgImageWin = new Image();
    bkgImageWin.src = "resources/win.jpg";
    // Load brick image
    brickImage[0].src = "resources/vlad.png";
    brickImage[1].src = "resources/brick.png";
    brickImage[2].src = "resources/barb.png";
    brickImage[3].src = "resources/barb.png";

    // missile image
    missileImage = new Image();
    missileImage.src = "resources/missile.png";

    // Load ball image
    ballImage = new Image();
    ballImage.src = "resources/ball.png";
    barImage = new Image();
    barImage.src = "resources/bazz.png";
    // Load life image
    lifeImage = new Image();
    lifeImage.src = "resources/life.png";
  },
  false);





/***************************************************************************************************************************/
/* Update Operations												       */
/***************************************************************************************************************************/

// Update the game
function refreshGame() {
  // Clear the game zone
  context.clearRect(0, 0, GAME_ZONE_WIDTH, GAME_ZONE_HEIGHT);

  // Display the background
  context.drawImage(bkgImagepp, 0, 0);

  // Display the bricks
  displayBricks();

  // Test if the player win
  if (bWin) {
    if (iLevel == LEVEL_COUNT) {
      win();
    }
    else {
      bWin = 0;
      iLevel++;
      reinit();
      for (var i = 0; i < LINE_COUNT; i++) {
        for (var j = 0; j < BRICK_BY_LINE_COUNT; j++) {
          aBricks[i][j] = LEVEL[iLevel - 1][i * BRICK_BY_LINE_COUNT + j];
        }
      }
    }
  }

  // Power duration
  if (fPowerTimer > 0) {
    fPowerTimer -= 0.01;
    if (fPowerTimer <= 0) {
      bSuperBall = 0;
      bPowerStick = 0;
      bPowerShoot = 0;

      for (var i = 0; i < 3; i++) {
        bStick[0] = 0;
      }
    }
  }

  // Update and display the bar
  updateBar();
  displayBar();

  // Update and display missiles
  updateMissiles();
  displayMissiles();

  // Update the balls
  for (var i = 0; i < 3; i++) {
    if (bBallAlive[i]) {
      if (bBallLaunched && bStick[i] == 0) {
        // Compute the ball bounce on the bar and the game zone borders
        if (fBallX[i] - BALL_SIZE <= 0 || fBallX[i] + BALL_SIZE >= GAME_ZONE_WIDTH) {
          fBallDirX[i] *= -1;
        }
        if (fBallY[i] > GAME_ZONE_HEIGHT) {
          bBallAlive[i] = 0;
          if (bBallAlive[0] == bBallAlive[1] && bBallAlive[0] == bBallAlive[2]) {
            iLifeCount--;
            if (iLifeCount <= 0) {
              loose();
            }
            else {
              reinit();
            }
          }
        }
        else {
          if (fBallY[i] - BALL_SIZE <= 0) {
            fBallDirY[i] = Math.abs(fBallDirY[i]);
          }
          else {
            var fSpeed = Math.sqrt(fBallDirX[i] * fBallDirX[i] + fBallDirY[i] * fBallDirY[i]);

            // Bounce on the bar
            if ((fBallY[i] > (GAME_ZONE_HEIGHT - BAR_HEIGHT - BALL_SIZE - 2)) &&
              (fBallX[i] + BALL_SIZE >= fBarX) &&
              (fBallX[i] - BALL_SIZE <= (fBarX + BAR_WIDTH * fBarSizeFactor))) {
              var fBarHalfSize = BAR_WIDTH * fBarSizeFactor * 0.5;

              fBallDirX[i] /= fSpeed;
              fBallDirY[i] /= fSpeed;

              fBallDirY[i] = -Math.abs(fBallDirY[i]);
              fBallDirX[i] = (fBallX[i] - (fBarX + fBarHalfSize)) / (fBarHalfSize);

              if (bPowerStick) {
                bStick[i] = 1;
                fStickX[i] = fBallX[i] - fBarX;
              }
              else {
                fBallDirX[i] += fBarMoveX * 0.2;
              }

              var fSpeedTmp = Math.sqrt(fBallDirX[i] * fBallDirX[i] + fBallDirY[i] * fBallDirY[i]);
              fBallDirX[i] /= fSpeedTmp;
              fBallDirY[i] /= fSpeedTmp;

              fBallDirX[i] *= fSpeed;
              fBallDirY[i] *= fSpeed;
            }
          }
        }

        // Collisions with bricks
        if (fBallY[i] <= fBrickBound) {
          var lineY = Math.floor((fBallY[i] + BALL_SIZE - BRICK_MARGIN_TOP) / (BRICK_HEIGHT + BRICK_SPACE));
          var lineX = Math.floor((fBallX[i] + BALL_SIZE) / (BRICK_WIDTH + BRICK_SPACE));
          if (lineY >= 0 && lineY < LINE_COUNT && aBricks[lineY][lineX] >= 1) {
            var collision = checkCollisionRectCircle(lineX, lineY, lineX * (BRICK_WIDTH + BRICK_SPACE),
              lineY * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_MARGIN_TOP - BRICK_HALF_SPACE,
              BRICK_WIDTH + BRICK_SPACE,
              BRICK_HEIGHT + BRICK_SPACE,
              fBallX[i],
              fBallY[i],
              BALL_SIZE,
              fPrevBallX[i],
              fPrevBallY[i]);
            if (collision[0] > 0) {
              if (bSuperBall == 0) {
                switch (collision[0]) {
                  case 1:
                    //fBallX -= collision[1];
                    fBallDirX[i] *= -1;
                    break;
                  case 2:
                    //fBallX += collision[1];
                    fBallDirX[i] *= -1;
                    break;
                  case 3:
                    //fBallY -= collision[1];
                    fBallDirY[i] *= -1;
                    break;
                  case 4:
                    //fBallY += collision[1];
                    fBallDirY[i] *= -1;
                    break;
                }
              }

              if (aBricks[lineY][lineX] < 4) {
                aBricks[lineY][lineX]--;
                if (aBricks[lineY][lineX] == 0) {
                  addBonus(lineX * (BRICK_WIDTH + BRICK_SPACE) + BRICK_HALF_SPACE, lineY * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_HALF_SPACE + BRICK_MARGIN_TOP);
                  iScore += SCORE_BRICK;
                }
              }

              if (fBallSpeedMultiplicator < 2) {
                fBallSpeedMultiplicator += 0.05;
              }
            }
          }
        }

        // Set the new ball position
        fBallX[i] += fBallDirX[i] * BALL_SPEED * fBallSpeedFactor * fBallSpeedMultiplicator;
        fBallY[i] += fBallDirY[i] * BALL_SPEED * fBallSpeedFactor * fBallSpeedMultiplicator;
        fPrevBallX[i] = fBallX[i];
        fPrevBallY[i] = fBallY[i];

        // Clamp position
        if (fBallX[i] - BALL_SIZE < 0) {
          fBallX[i] = BALL_SIZE;
        }
        else if (fBallX[i] + BALL_SIZE > GAME_ZONE_WIDTH) {
          fBallX[i] = GAME_ZONE_WIDTH - BALL_SIZE;
        }
        if (fBallY[i] - BALL_SIZE < 0) {
          fBallY[i] = BALL_SIZE;
        }
      }
      else {
        if (bStick[i]) {
          if (fStickX[i] <= BAR_WIDTH * fBarSizeFactor) {
            fBallX[i] = fBarX + fStickX[i];
          }
          else {
            fBallX[i] = fBarX + BAR_WIDTH * fBarSizeFactor;
          }
        }
        else {
          fBallX[i] = fBarX + BAR_WIDTH * fBarSizeFactor * 0.5;
        }
        fBallY[i] = fBarY - BALL_SIZE;
      }

      // Display the ball
      displayBall(i);
    }
  }

  // Update and display the bonus
  updateBonus();
  displayBonus();

  // Display the score
  displayScore();

  // Display the life points
  displayLife();
}



/***************************************************************************************************************************/
/* Input Handlers													       */
/***************************************************************************************************************************/

// Keyboard event listener
function onKeyDown(event) {
  // Right arrow
  if (event.keyCode == KEY_RIGHT) {
    bKeyRightPressed = 1;
  }

  // Left arrow
  else if (event.keyCode == KEY_LEFT) {
    bKeyLeftPressed = 1;
  }

  // Up arrow to launch the ball
  else if (event.keyCode == KEY_UP) {
    bBallLaunched = 1;
    if (bPowerStick) {
      for (var i = 0; i < 3; i++) {
        bStick[i] = 0;
      }
    }
    if (bPowerShoot) {
      for (var i = 0; i < MISSILE_COUNT; i++) {
        if (bMissile1Alive[i] == 0 && bMissile2Alive[i] == 0) {
          bMissile1Alive[i] = 1;
          bMissile2Alive[i] = 1;
          fMissile1X[i] = fBarX + BAR_WIDTH * fBarSizeFactor * 0.25 - MISSILE_WIDTH * 0.5;
          fMissile2X[i] = fBarX + BAR_WIDTH * fBarSizeFactor * 0.75 - MISSILE_WIDTH * 0.5;
          fMissile1Y[i] = fBarY - MISSILE_HEIGHT;
          fMissile2Y[i] = fBarY - MISSILE_HEIGHT;
          break;
        }
      }

    }
  }
}

document.addEventListener("mousemove", oMouseMove, false);

function onMouseMove(e) {
  var relativeX = e.clientX - canvas.offsetLeft;
  if(relativeX > 0 && relativeX < canvas.width) {
      paddleX = relativeX - paddleWidth/2;
  }
}

// Keyboard event listener
function onKeyPress(event) {
  // Right arrow
  if (event.keyCode == 39) {
    bKeyRightPressed = 1;
  }

  // Left arrow
  else if (event.keyCode == 37) {
    bKeyLeftPressed = 1;
  }
}

// Keyboard event listener
function onKeyUp(event) {
  // Right arrow
  if (event.keyCode == 39) {
    bKeyRightPressed = 0;
  }

  // Left arrow
  else if (event.keyCode == 37) {
    bKeyLeftPressed = 0;
  }
}

// Mouse event listener
function onClick() {
  // Launch the ball
  bBallLaunched = 1;
  if (bPowerStick) {
    for (var i = 0; i < 3; i++) {
      bStick[i] = 0;
    }
  }
  if (bPowerShoot) {
    for (var i = 0; i < MISSILE_COUNT; i++) {
      if (bMissile1Alive[i] == 0 && bMissile2Alive[i] == 0) {
        bMissile1Alive[i] = 1;
        bMissile2Alive[i] = 1;
        fMissile1X[i] = fBarX + BAR_WIDTH * fBarSizeFactor * 0.25 - MISSILE_WIDTH * 0.5;
        fMissile2X[i] = fBarX + BAR_WIDTH * fBarSizeFactor * 0.75 - MISSILE_WIDTH * 0.5;
        fMissile1Y[i] = fBarY - MISSILE_HEIGHT;
        fMissile2Y[i] = fBarY - MISSILE_HEIGHT;
        break;
      }
    }
  }
}



function mouseMoveHandler(e) {
  var relativeX = e.clientX - canvas.offsetLeft;
  if(relativeX > 0 && relativeX < canvas.width) {
      paddleX = relativeX - paddleWidth/2;
  }
}

// Accelerometer event listener
function onDeviceMotion(event) {
  var accelerationX = event.accelerationIncludingGravity.x;
  var accelerationY = event.accelerationIncludingGravity.y;
  var accelerationZ = event.accelerationIncludingGravity.z;

  bKeyRightPressed = 0;
  bKeyLeftPressed = 0;
  if (accelerationX > 0) {
    bKeyRightPressed = 1;
  }
  else if (accelerationX < 0) {
    bKeyLeftPressed = 1;
  }
}


/***************************************************************************************************************************/
/* Display Operations												       */
/***************************************************************************************************************************/

// Display the bricks
function displayBricks() {
  bWin = 1;
  for (var i = 0; i < aBricks.length; i++) {
    var brickGradient = context.createLinearGradient(0, i * (BRICK_HEIGHT + BRICK_SPACE), 0, (i + 1) * (BRICK_HEIGHT + BRICK_SPACE));
    brickGradient.addColorStop(0, BRICK_COLORS_1[i]);
    brickGradient.addColorStop(1, BRICK_COLORS_2[i]);
    context.fillStyle = brickGradient;
    for (var j = 0; j < aBricks[i].length; j++) {
      if (aBricks[i][j] >= 1) {
        context.drawImage(brickImage[aBricks[i][j] - 1], j * (BRICK_WIDTH + BRICK_SPACE) + 1, i * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_MARGIN_TOP, BRICK_WIDTH, BRICK_HEIGHT);

        bWin = 0;
        if (aBricks[i][j] != 4) {
          bWin = 0;
        }
      }
    }
  }
}

// Display the bar
function displayBar() {


  // Display the bar
  context.drawImage(barImage, fBarX, fBarY, BAR_WIDTH * fBarSizeFactor, BAR_HEIGHT);

  if (bPowerShoot) {
    context.fillRect(fBarX + BAR_WIDTH * fBarSizeFactor * 0.25 - CANON_WIDTH * 0.5, fBarY - CANON_HEIGHT, CANON_WIDTH, CANON_HEIGHT);
    context.fillRect(fBarX + BAR_WIDTH * fBarSizeFactor * 0.75 - CANON_WIDTH * 0.5, fBarY - CANON_HEIGHT, CANON_WIDTH, CANON_HEIGHT);
  }


}

// Display the ball
function displayBall(i) {
  if (bSuperBall) {
    context.fillStyle = SUPER_BALL_COLOR;
  }
  else {
    context.fillStyle = BALL_COLOR;

  }
  
  context.beginPath();
  context.arc(fBallX[i], fBallY[i], BALL_SIZE, 0, 2 * Math.PI, true);
  context.closePath();
  context.fill();


}
// Display the bonus
function displayBonus() {
  if (bBonusAlive) {
    var bonusGradient = context.createLinearGradient(0, fBonusY, 0, fBonusY + BONUS_HEIGHT);
    bonusGradient.addColorStop(0, BONUS_COLORS_1[iBonusPower - 1]);
    bonusGradient.addColorStop(1, BONUS_COLORS_2[iBonusPower - 1]);
    context.fillStyle = bonusGradient;
    context.fillRect(fBonusX, fBonusY, BONUS_WIDTH, BONUS_HEIGHT);

    context.fillStyle = SCORE_COLOR;
    context.fillText(BONUS_TEXTS[iBonusPower - 1], fBonusX + 5, fBonusY + 12);
  }
}

// Display the missiles
function displayMissiles() {
  context.fillStyle = BALL_COLOR;
  for (var i = 0; i < MISSILE_COUNT; i++) {
    if (bMissile1Alive[i]) {
      //context.drawImage(missileImage[i], fMissile1X[i], fMissile1Y[i], MISSILE_WIDTH, MISSILE_HEIGHT);
      context.fillRect(fMissile1X[i], fMissile1Y[i], MISSILE_WIDTH, MISSILE_HEIGHT);
    }
    if (bMissile2Alive[i]) {
      //context.drawImage(missileImage[i], fMissile2X[i], fMissile2Y[i], MISSILE_WIDTH, MISSILE_HEIGHT);
      context.fillRect(fMissile2X[i], fMissile2Y[i], MISSILE_WIDTH, MISSILE_HEIGHT);
    }
  }
}

// Display the score
function displayScore() {
  context.fillStyle = SCORE_COLOR;
  context.font = "bold 15px Arial"; //"italic small-caps bold 12px arial"
  context.fillText("Soldat Tué : " + iScore, SCORE_X, SCORE_Y);

}

// Display the life points
function displayLife() {
  for (var i = 0; i < iLifeCount; i++) {
    context.drawImage(lifeImage, 850 + i * 50, 2, 45, 45);
  }
}




/***************************************************************************************************************************/
/* End of Game Operations												       */
/***************************************************************************************************************************/



// Called when the player loose a life
function reinit() {
  fBallX[0] = fBarX + BAR_WIDTH * 0.5;
  fBallY[0] = fBarY - BALL_SIZE;
  fPrevBallX[0] = fBallX[0];
  fPrevBallY[0] = fBallY[0];
  fBallDirX[0] = 1;
  fBallDirY[0] = -1;
  fBallSpeedFactor = 1;
  bBallLaunched = 0;
  bBallAlive[0] = 1;
  bBallAlive[1] = 0;
  bBallAlive[2] = 0;
  fBallSpeedMultiplicator = 1;

  fBarX = (GAME_ZONE_WIDTH * 0.5) - (BAR_WIDTH * 0.5);
  fBarY = (GAME_ZONE_HEIGHT - BAR_HEIGHT) - 6;
  fBarMoveX = 0;
  fBarSizeFactor = 1;

  bKeyRightPressed = 0;
  bKeyLeftPressed = 0;

  fBonusX = 0;
  fBonusY = 0;
  bBonusAlive = 0;
  iBonusPower = 0;

  fPowerTimer = 0;

  bSuperBall = 0;

  bPowerStick = 0;
  bStick[0] = 0;
  bStick[1] = 0;
  bStick[2] = 0;
  fStickX[0] = 0;

  bPowerShoot = 0;
  for (var i = 0; i < 3; i++) {
    fMissile1X[i] = 0;
    fMissile1Y[i] = 0;
    fMissile2X[i] = 0;
    fMissile2Y[i] = 0;
    bMissile1Alive[i] = 0;
    bMissile2Alive[i] = 0;
  }
}




/***************************************************************************************************************************/
/* Collision Operations												       */
/***************************************************************************************************************************/

// Collision Rectangle/Circle
function checkCollisionRectCircle(iLineX, iLineY, iRectX, iRectY, iRectWidth, iRectHeight, iCircleX, iCircleY, iCircleRadius, iPrevCircleX, iPrevCircleY) {
  var iDiameter = 2 * iCircleRadius;

  if ((iCircleY + iDiameter < iRectY) ||
    (iCircleY > iRectY + iRectHeight) ||
    (iCircleX + iDiameter < iRectX) ||
    (iCircleX > iRectX + iRectWidth)) {
    return 0;
  }

  // Search the nearest side
  var fDist = 1000000;
  var fDistBest = fDist;
  var iSideBest = 0;

  fDist = Math.abs(iRectX - (iCircleX + iCircleRadius));
  if (fDist < fDistBest && iLineX > 0 && aBricks[iLineY][iLineX - 1] == 0) {
    fDistBest = fDist;
    iSideBest = 1;
  }

  fDist = Math.abs(iRectX + iRectWidth - (iCircleX + iCircleRadius));
  if (fDist < fDistBest && iLineX < BRICK_BY_LINE_COUNT - 1 && aBricks[iLineY][iLineX + 1] == 0) {
    fDistBest = fDist;
    iSideBest = 2;
  }

  fDist = Math.abs(iRectY - (iCircleY + iCircleRadius));
  if (fDist < fDistBest && iLineY > 0 && aBricks[iLineY - 1][iLineX] == 0) {
    fDistBest = fDist;
    iSideBest = 3;
  }

  fDist = Math.abs(iRectY + iRectHeight - (iCircleY + iCircleRadius));
  if (fDist < fDistBest && (iLineY >= LINE_COUNT - 1 || aBricks[iLineY + 1][iLineX] == 0)) {
    fDistBest = fDist;
    iSideBest = 4;
  }

  // Compute penetration
  var fPenetration = 0;
  switch (iSideBest) {
    case 1:
      fPenetration = iCircleX + iDiameter - iRectX;
      break;
    case 2:
      fPenetration = iRectX + iRectWidth - iCircleX;
      break;
    case 3:
      fPenetration = iCircleY + iDiameter - iRectY;
      break;
    case 4:
      fPenetration = iRectY + iRectHeight - iCircleY;
      break;
  }

  return [iSideBest, fPenetration];
}

// Collision Rectangle/Circle
function checkCollisionRectRect(iRect1X, iRect1Y, iRect1Width, iRect1Height, iRect2X, iRect2Y, iRect2Width, iRect2Height) {
  return (iRect2X < iRect1X + iRect1Width) &&
    (iRect2X + iRect2Width > iRect1X) &&
    (iRect2Y < iRect1Y + iRect1Height) &&
    (iRect2Y + iRect2Height > iRect1Y);
}




/***************************************************************************************************************************/
/* Tool Operations												       	       */
/***************************************************************************************************************************/

// Random
function random(min, max) {
  return Math.floor(min + (max - min + 1) * Math.random());
}


