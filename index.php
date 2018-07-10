<?
$uri = explode('/', $_SERVER['REQUEST_URI']);
$view = "views/";

// show the things
require_once("views/head.php");
if ($uri[1] == "dots") {
  require_once("views/dots.php");  
} else {
  require_once("views/home.php");
}
require_once("views/foot.php");
?>
