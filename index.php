<?
$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);
// $view = "views/";

// show the things
require_once("views/head.php");
if ($uri[1] == "dots") {
  require_once("views/dots.php");  
}
else if($uri[1] == 'updateRecords') {
  require_once("views/updateRecords.php");  
}
else {
  require_once("views/main.php");
}
require_once("views/arrow.php");
require_once("views/foot.php");
?>
