<?
// path to config file
$config = $_SERVER["DOCUMENT_ROOT"];
$config = $config."/open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
// $config_dir = $root."config/";
// require_once($config_dir."url.php");
// require_once($config_dir."request.php");

$db = db_connect("guest");

$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();
// $rr = new Request();

if($uu->id) 
	$item = $oo->get($uu->id);
else if(count($uri) == 2) {
	try {
        /* 
            entries exception 
        */
		$uri_temp = $uri;
        $uri_temp[0] = 'entries';
		$temp = $oo->urls_to_ids($uri_temp);
		$id = end($temp);
		$item = $oo->get($id);
	} catch(Exception $err) {
		$item = $oo->get(0);
	}
} else {
	try {
        /* 
            /home exception 
        */
		$uri_temp = $uri;
        $uri_temp[0] = 'home';
		$temp = $oo->urls_to_ids($uri_temp);
		$id = end($temp);
		$item = $oo->get($id);
	} catch(Exception $err) {
		$item = $oo->get(0);
	}
} 
if(isset($item))
	$name = ltrim(strip_tags($item["name1"]), ".");
else 
	$name = '';

$temp = $oo->urls_to_ids(array('entries'));
$nav = $oo->nav(array(), end($temp));

$head = null; 
try {
	/* 
		does _head exist? 
	*/
	$temp = $oo->urls_to_ids(array('head'));
	$id = end($temp);
	$head_item = $oo->get($id);
} catch(Exception $err) {
	$head_item = null; 
	// $item = $oo->get(0);
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>A *New* Program for Graphic Design</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-title" content="A *New* Primer of Visual Literacy">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<link rel="apple-touch-icon" href="static/images/apple-touch-icon.png" />
		<link rel="stylesheet" href="<? echo $host; ?>static/css/fonts.css">
		<link rel="stylesheet" href="<? echo $host; ?>static/css/global.css">
	</head>
<body>
	<?
		if($head_item) {
			?><header id="main-header"><h1><?php echo $head_item['body']; ?></h1><p><?php echo $head_item['notes']; ?></p></header><?
		}
	    if(!$uu->id) {
    	    ?><nav id="menu" class="container full-vw full-vh hidden homepage"><?
	    }
	    else if($show_menu) {
    	    ?><nav id="menu" class="container full-vw full-vh visible"><?
	    }
	    else {
    	    ?><nav id="menu" class="container full-vw full-vh hidden"><?
	    }
	    ?><ul class="column">
		    <ul class="nav-level"><?
	    if(!empty($nav))
	    {
			function cmp_begin($a, $b){
				if($a['o']['begin'] == $b['o']['begin']) return 0;
				return $a['o']['begin'] > $b['o']['begin'] ? -1 : 1;
			}
	    	$prevd = $nav[0]['depth'];
			usort($nav, 'cmp_begin');
			// var_dump($nav)
		    foreach($nav as $n) {
			    $d = $n['depth'];
			    if($d > $prevd) {
	    		    ?><ul class="nav-level"><?
			    }
			    else {
				    for($i = 0; $i < $prevd - $d; $i++) { 
	                    ?></ul><? 
	                }
			    }
			    ?><li><?
				    if($n['o']['id'] != $uu->id) {
	    			    ?><a href="<? echo $host.$n['url']; ?>"><?
					    echo $n['o']['name1'];
		    		    ?></a><?
				    }
				    else {
	    			    ?><span><?= $n['o']['name1']; ?></span><?
				    }
			    ?></li><?
			    $prevd = $d;
		    }
	    }
	    ?></ul>
		<div class="canvas-container dots-container" id=""></div>
	    </ul>
		
    </nav>

