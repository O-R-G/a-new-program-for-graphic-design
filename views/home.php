<?
  // get home
  function getHome($oo, $root) {
    $children = $oo->children($root);
      foreach($children as $child) {
        $name =  strtolower($child["name1"]);
        if ($name == "home") {
          return $child;
        }
    }
  }

  $home = getHome($oo, $root);
  $homeMedia = $oo->media($home['id']);
?>
<div class="container">
  <div class="column" id="first">
    <div class="title">
      <?= $home['deck']; ?>
    </div>
    <div class="content">
      <?= $home['body']; ?>
    </div>

    <div class="" id="canvas-container">

    </div>
  </div>
  <div class="column">
    <div class="sub-content">
      <?= $home['notes']; ?>
    </div>
  </div>
  <div class="column" style="visibility: hidden;">
    <img src="<?= m_url($homeMedia[0]); ?>">
  </div>
</div>

<script>
  var width = 500;
  var height = 500;
  var r = width/3;
  var dy = r*.50807/2;
  var step = .05;

  var ts = [Math.PI, 0, -Math.PI/2];
  var xys = [[], [], []];

  var canvas = document.createElement("canvas");
  canvas.width = width;
  canvas.height = height;
  canvas.style.background = "#000";

  document.getElementById('canvas-container').appendChild(canvas);

  function updateCanvas() {
    for(var i = 0; i < ts.length; i++) {
      ts[i] += step;
    }
    update1();
    update2();
    update3();

    var ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.filter = "blur(5px)";
    ctx.globalCompositeOperation = "lighter";
    ctx.beginPath();
    ctx.fillStyle = "rgba(0,255,0,1)";
    ctx.arc(xys[0][0], xys[0][1], r/2, Math.PI*2, 0, false);
    ctx.fill()
    ctx.beginPath();
    ctx.fillStyle = "rgba(255,0,0,1)";
    ctx.arc(xys[1][0], xys[1][1], r/2, Math.PI*2, 0, false);
    ctx.fill()
    ctx.beginPath();
    ctx.fillStyle = "rgba(0,0,255,1)";
    ctx.arc(xys[2][0], xys[2][1], r/2, Math.PI*2, 0, false);
    ctx.fill();
    ctx.restore();

  function update1() {
  	var _r = r*.25;
    xys[0][0] = _r*Math.cos(ts[0])+width/2+_r;
    xys[0][1] = _r*Math.sin(ts[0])+height/2-dy;
  }

  function update2() {
  	var _r = r*.25;
    xys[1][0] = _r*Math.cos(ts[1])+width/2-_r;
    xys[1][1] = _r*Math.sin(ts[1])+height/2-dy;
  }

  function update3() {
  	var _r = r*.433015;
    xys[2][0] = _r*Math.cos(ts[2])+width/2;
    xys[2][1] = _r*Math.sin(ts[2])+height/2+_r-dy;
  }

  requestAnimationFrame(updateCanvas);
};

  // updateCanvas(canvas);
  requestAnimationFrame(updateCanvas);
</script>
