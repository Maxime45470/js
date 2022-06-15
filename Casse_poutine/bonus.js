   // Update the bonus
   function updateBonus() {
    if (bBonusAlive) {
      fBonusY += 1;

      if (fBonusY > GAME_ZONE_HEIGHT) {
        bBonusAlive = 0;
      }
      else if ((fBonusY + BONUS_HEIGHT > fBarY) &&
        (fBonusX > fBarX - BONUS_WIDTH) &&
        (fBonusX < fBarX + BAR_WIDTH * fBarSizeFactor)) {
        bBonusAlive = 0;
        iScore += SCORE_POWER;


        /********************************/
        /* Powers :          		*/
        /* 1 : Ball speed * 2		*/
        /* 2 : Ball speed / 2		*/
        /* 3 : 3 balls			*/
        /* 4 : Super ball		*/
        /* 5 : Bar size * 2		*/
        /* 6 : Bar size / 2		*/
        /* 7 : Stick			*/
        /* 8 : Shoot			*/
        /********************************/
        switch (iBonusPower) {
          case 1:
            if (fBallSpeedFactor < 2) fBallSpeedFactor *= 2;
            break;

          case 2:
            if (fBallSpeedFactor > 0.5) fBallSpeedFactor *= 0.5;
            break;

          case 3:
            var iBallIndex = 0;
            for (var i = 0; i < 3; i++) {
              if (bBallAlive[i] == 1) {
                iBallIndex = i;
                break;
              }
            }
            var fTmp = 1;
            for (var i = 0; i < 3; i++) {
              if (bBallAlive[i] == 0) {
                bBallAlive[i] = 1;
                fBallX[i] = fBallX[iBallIndex];
                fBallY[i] = fBallY[iBallIndex];
                fBallDirY[i] = fBallDirY[iBallIndex] - 0.2 * fTmp;
                fBallDirX[i] = fBallDirX[iBallIndex] + 0.2 * fTmp;
                fTmp *= -1;
              }
            }
            break;

          case 4:
            bSuperBall = 1;
            bPowerStick = 0;
            bPowerShoot = 0;
            fPowerTimer = SUPER_BALL_DURATION;
            break;

          case 5:
            if (fBarSizeFactor < 2) fBarSizeFactor *= 2;
            break;

          case 6:
            if (fBarSizeFactor > 0.5) fBarSizeFactor *= 0.5;
            break;

          case 7:
            bPowerStick = 1;
            bSuperBall = 0;
            bPowerShoot = 0;
            fPowerTimer = POWER_STICK_DURATION;
            break;

          case 8:
            bPowerShoot = 1;
            bPowerStick = 0;
            bSuperBall = 0;
            fPowerTimer = POWER_SHOOT_DURATION;
            break;

          default:
            break;
        }
      }
    }
  }
 
 // Update the missiles
 function updateMissiles() {
    for (var i = 0; i < MISSILE_COUNT; i++) {
      if (bMissile1Alive[i]) {
        fMissile1Y[i] -= MISSILE_SPEED;

        if (fMissile1Y[i] < -MISSILE_HEIGHT) {
          bMissile1Alive[i] = 0;
        }
        else {
          if (fMissile1Y[i] <= fBrickBound) {
            var lineX = Math.floor(fMissile1X[i] / (BRICK_WIDTH + BRICK_SPACE));
            var lineY = Math.floor((fMissile1Y[i] - BRICK_MARGIN_TOP) / (BRICK_HEIGHT + BRICK_SPACE));
            if (lineY >= 0 && lineY < LINE_COUNT && aBricks[lineY][lineX] >= 1) {
              if (checkCollisionRectRect(lineX * (BRICK_WIDTH + BRICK_SPACE) + BRICK_HALF_SPACE,
                lineY * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_HALF_SPACE + BRICK_MARGIN_TOP,
                BRICK_WIDTH,
                BRICK_HEIGHT,
                fMissile1X[i],
                fMissile1Y[i],
                MISSILE_WIDTH,
                MISSILE_HEIGHT)) {
                bMissile1Alive[i] = 0;
                if (aBricks[lineY][lineX] < 4) {
                  aBricks[lineY][lineX]--;
                  if (aBricks[lineY][lineX] == 0) {
                    addBonus(lineX * (BRICK_WIDTH + BRICK_SPACE) + BRICK_HALF_SPACE, lineY * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_HALF_SPACE + BRICK_MARGIN_TOP);
                    iScore += SCORE_BRICK;
                  }
                }
              }
            }
          }
        }
      }

      if (bMissile2Alive[i]) {
        fMissile2Y[i] -= MISSILE_SPEED;

        if (fMissile2Y[i] < -MISSILE_HEIGHT) {
          bMissile2Alive[i] = 0;
        }
        else {
          if (fMissile2Y[i] <= fBrickBound) {
            var lineX = Math.floor(fMissile2X[i] / (BRICK_WIDTH + BRICK_SPACE));
            var lineY = Math.floor((fMissile2Y[i] - BRICK_MARGIN_TOP) / (BRICK_HEIGHT + BRICK_SPACE));
            if (lineY >= 0 && lineY < LINE_COUNT && aBricks[lineY][lineX] >= 1) {
              if (checkCollisionRectRect(lineX * (BRICK_WIDTH + BRICK_SPACE) + BRICK_HALF_SPACE,
                lineY * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_HALF_SPACE + BRICK_MARGIN_TOP,
                BRICK_WIDTH,
                BRICK_HEIGHT,
                fMissile2X[i],
                fMissile2Y[i],
                MISSILE_WIDTH,
                MISSILE_HEIGHT)) {
                bMissile2Alive[i] = 0;
                if (aBricks[lineY][lineX] < 4) {
                  aBricks[lineY][lineX]--;
                  if (aBricks[lineY][lineX] == 0) {
                    addBonus(lineX * (BRICK_WIDTH + BRICK_SPACE) + BRICK_HALF_SPACE, lineY * (BRICK_HEIGHT + BRICK_SPACE) + BRICK_HALF_SPACE + BRICK_MARGIN_TOP);
                    iScore += SCORE_BRICK;
                  }
                }
              }
            }
          }
        }
      }
    }
  }

  // Add a bonus
  function addBonus(iX, iY) {
    if (bBonusAlive == 0 && Math.random() > BONUS_RANDOM) {
      bBonusAlive = 1;
      fBonusX = iX;
      fBonusY = iY;
      iBonusPower = random(1, BONUS_COUNT);
    }
  }
