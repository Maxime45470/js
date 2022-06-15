// Update the bar
function updateBar() {
    fBarMoveX = 0;


    if (bKeyRightPressed) {
      if ((fBarX + BAR_SPEED + BAR_WIDTH * fBarSizeFactor) <= GAME_ZONE_WIDTH) {
        fBarMoveX = BAR_SPEED;
        fBarX += BAR_SPEED;

      }
    }
    else if (bKeyLeftPressed) {
      if ((fBarX - BAR_SPEED) >= 0) {
        fBarMoveX = -BAR_SPEED;
        fBarX -= BAR_SPEED;
      }
    }
  }




