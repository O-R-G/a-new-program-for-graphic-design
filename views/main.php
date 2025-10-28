<?
  $page = $uri[1] ? $item['name1'] : '';
?>
<div id="screenfull-container"></div>
<main class="container">
  <div class="column" id="first">
    <div>
      <?= $page ? '<h2 class="page-title">' . $page . '</h2><br>' : ''; ?>
      <div class="content"><?= $item['body']; ?></div>
    </div>
    <div class="canvas-container dots-container" id="canvas-container"></div>
  </div>
</main>

<script src="/static/js/screenfull.min.js"></script>
<script type="text/javascript" src="/static/js/screenfull-extend.js"></script>	
<script src="/static/js/dots.js"></script>
<script>
  let dots_container = document.getElementsByClassName('dots-container');
  for(let i = 0; i < dots_container.length; i++) 
    runDots(dots_container[i], 500, 500, .05);
  const images = document.querySelectorAll('img:not(.prevent-windowfull):not(.prevent-screenfull)');
  new ScreenfullExtended(screenfull, document.getElementById('screenfull-container'), images);
</script>
