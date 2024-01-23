<div class="fill">
  <div id="full-size-dots">
    <div class="" id="canvas-container">

    </div>
  </div>
</div>
<!-- <script src="static/js/fps.min.js"></script> -->
<script src="static/js/dots.js"></script>
<script>
var w = window.innerWidth;
var h = window.innerHeight;
if (w > h) {
  w = h;
} else {
  h = w;
}
runDots(w, h, .226/4);
</script>
