<?
  $page = $uri[1] ? $item['name1'] : '';
?>
<main class="container">
  <div class="column" id="first">
    <?= $page ? '<h2 class="page-title">' . $page . '</h2><br>' : ''; ?>
    <div class="content"><?= $item['body']; ?></div>
    <div class="canvas-container dots-container" id="canvas-container"></div>
  </div>
</main>

<script src="static/js/screenfull.min.js"></script>
<script src="static/js/dots.js"></script>

<script>
  let dots_container = document.getElementsByClassName('dots-container');
  for(let i = 0; i < dots_container.length; i++) 
    runDots(dots_container[i], 500, 500, .05);

var im = document.getElementsByTagName('img');
for(var i = 0; i < im.length; i++) {
  if (im[i].id == "arrow")
    continue;

  im[i].addEventListener('click', function(event) {
    if (screenfull.enabled) {
  		screenfull.request(event.target);
    }
  });
}

</script>
