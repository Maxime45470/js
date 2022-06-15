// Create the bricks
function createBricks(iLineCount, iBrickByLine, iWidth, iHeight, iBrickSpace) {
    aBricks = new Array(iLineCount);
  
    for (var i = 0; i < iLineCount; i++) {
      aBricks[i] = new Array(iBrickByLine);
  
      for (var j = 0; j < iBrickByLine; j++) {
        // Display a brick
        context.fillRect((j * (iWidth + iBrickSpace)) + 1, (i * (iHeight + iBrickSpace)), iWidth, iHeight);
  
        // > 1 = the brick is alive
        aBricks[i][j] = LEVEL[iLevel - 1][i * iBrickByLine + j];
  
      }
  
    }
  
    return 1;
  }
  