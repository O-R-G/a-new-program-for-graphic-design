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
  <div class="column">
    <div class="title">
      <?= $home['deck']; ?>
    </div>
    <div class="content">
      <?= $home['body']; ?>
    </div>
  </div>
  <div class="column">
    <div class="sub-content">
      <?= $home['notes']; ?>
    </div>
  </div>
  <div class="column">
    <img src="<?= m_url($homeMedia[0]) ?>">
  </div>
</div>
