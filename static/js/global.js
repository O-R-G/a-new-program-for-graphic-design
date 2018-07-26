function runDots(w, h, s) {
  var width = w;
  var height = h;
  var r = width/3;
  // var dy = r*.50807/2;
  var dy = r*.15;
  var step = s;
  var pause = false;

  document.onkeydown = function(e) {
    // console.log(e.which);
    switch(e.which) {
        case 189: // minus
        step -= .05;
        break;

        case 187: // plus
        step += .05;
        break;

        case 32: // space
        pause = !pause;
        break;

        // case 40: // down
        // break;

        default: return; // exit this handler for other keys
    }
    // e.preventDefault(); // prevent the default action (scroll / move caret)
  }

  var ts = [Math.PI, 0, -Math.PI/2];
  var xys = [[], [], []];

  var canvas = document.createElement("canvas");
  canvas.width = width;
  canvas.height = height;
  canvas.style.background = "#000";

  document.getElementById('canvas-container').appendChild(canvas);
  // canvas.onmouseover = function() { step = .01; };
  // canvas.onmouseout = function() { step = .05; };

  var time = Date.now();
  function updateCanvas() {
    if (!pause) {
      for(var i = 0; i < ts.length; i++) {
        ts[i] += step;
      }
    }
    update1();
    update2();
    update3();

      var ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.save();
      ctx.globalCompositeOperation = "lighter";
      ctx.beginPath();

    var greenGradient = ctx.createRadialGradient(xys[0][0],xys[0][1], r*.05, xys[0][0], xys[0][1], r*.7);
    greenGradient.addColorStop(0, "rgba(0,255,0,1)");
    greenGradient.addColorStop(1, "rgba(0,255,0,0)");
      ctx.fillStyle = greenGradient;
      ctx.arc(xys[0][0], xys[0][1], r/2, Math.PI*2, 0, false);
      ctx.fill()
      ctx.beginPath();
    var redGradient = ctx.createRadialGradient(xys[1][0],xys[1][1], r*.05, xys[1][0], xys[1][1], r*.7);
    redGradient.addColorStop(0, "rgba(255,0,0,1)");
    redGradient.addColorStop(1, "rgba(255,0,0,0)");
      ctx.fillStyle = redGradient;
      ctx.arc(xys[1][0], xys[1][1], r/2, Math.PI*2, 0, false);
      ctx.fill()
      ctx.beginPath();
    var blueGradient = ctx.createRadialGradient(xys[2][0],xys[2][1], r*.05, xys[2][0], xys[2][1], r*.7);
    blueGradient.addColorStop(0, "rgba(0,0,255,1)");
    blueGradient.addColorStop(1, "rgba(0,0,255,0)");
      ctx.fillStyle = blueGradient;
      ctx.arc(xys[2][0], xys[2][1], r/2, Math.PI*2, 0, false);
      ctx.fill();
      ctx.restore();

  function update1() {
    // var _r = r*.25;
    var _r = r*.15;
    xys[0][0] = _r*Math.cos(ts[0])+width/2+_r;
    xys[0][1] = _r*Math.sin(ts[0])+height/2-dy;
  }

  function update2() {
    // var _r = r*.25;
    var _r = r*.15;
    xys[1][0] = _r*Math.cos(ts[1])+width/2-_r;
    xys[1][1] = _r*Math.sin(ts[1])+height/2-dy;
  }

  function update3() {
    // var _r = r*.433015;
    var _r = r*.259809;
    xys[2][0] = _r*Math.cos(ts[2])+width/2;
    xys[2][1] = _r*Math.sin(ts[2])+height/2+_r-dy;
  }

  if (Math.abs(ts[0]%(2*Math.PI) - Math.PI) < s/2) {
    var t = Date.now();
    var diff = (t-time)/1000;
    var bpm = 60/diff;
    // console.log(bpm);
    time = t;
  }
  requestAnimationFrame(updateCanvas);
  };

  // updateCanvas(canvas);
  requestAnimationFrame(updateCanvas);
}
