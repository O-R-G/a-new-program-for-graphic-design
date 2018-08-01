<?
  // get entry from query
  function getEntry($oo, $root, $query) {
    $children = $oo->children($root);
      foreach($children as $child) {
        $name =  strtolower($child["name1"]);
        if ($name == $query) {
          return $child;
        }
    }
  }

  // most recent chronological sort
  function date_sort($a, $b) {
    return strtotime($b['begin']) - strtotime($a['begin']);
  }

  $home = getEntry($oo, $root, "home");
  $homeMedia = $oo->media($home['id']);

  $entries = $oo->children(getEntry($oo, $root, "entries")['id']);
  usort($entries, "date_sort");

?>
<div class="container">
  <div class="column" id="first">
    <div>
      <div class="title">
        <?= $home['deck']; ?>
      </div>
      <div class="content">
        <?= $home['body']; ?>
      </div>
    </div>
    <div class="" id="canvas-container">

    </div>
  </div>
  <div class="column">
    <div id="arrow-container"><img id="arrow" src="/static/images/arrow-forward-6-k.svg"></div>
    <img class="static-image" src="<?= m_url($homeMedia[0]); ?>">
  </div>
  <? foreach($entries as $entry): ?>
    <div class="column">
      <div class="title">
        <?= $entry['deck']; ?>
      </div>
      <div class="content">
        <?= $entry['body']; ?>
      </div>
    </div>
  <? endforeach; ?>
</div>

<script src="static/js/screenfull.min.js"></script>
<script src="static/js/global.js"></script>
<script>
runDots(500, 500, .05);

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
