
<?php
  session_start();
  if(!isset($_SESSION['userID'])){
    header("Location: login.html");
  }
?>
<html>
	<head>
    <!--include awesome font-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/tag.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="js/navbar.js"></script>
    <script src="js/tag.js"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <meta charset="utf-8" http-equiv="Content-Type" content="text/html">
    <script>
    //USE FOR DEBUG!
    $.ajaxSetup ({
      cache: false
    });
    //load banner
    $( document ).ready(function() {
      $("#banner").load('navbar.html');
      //listAllTag();
    });
    </script>
	</head>

	<body style="background:#009FCC">
    <div id="banner" class="navbar"></div>
		<div class="display-box meta-Highlight">
			<div class="whiteHighlight header-title">
				<h1>Meta Search result</h1>

			</div>
			<div class="text-block shadowbox wide-block" id="metaSearch">
<?php
  $query = $_GET["query"];
  $query = str_replace(" ","+",$query);
  //iconv("big5","UTF-8",$query);
  //echo($query);
  $googleSearch = "http://www.google.com/search?q=".$query;
  //echo($googleSearch);
  $contents = file_get_contents($googleSearch);
  $contents = iconv("BIG5","UTF-8", $contents);
  $contents = str_replace('<a href="/url?q=','<a href="https://www.google.com.tw/url?q=',$contents);
  //$regEx = '/<div id="search">([\s\S]*)<\/div><\/div><div/';
  $regEx = '/<li class="g"><h3 class="r">([\s\S]*)<\/div><\/li>/';
  $match_result =  preg_match_all($regEx,$contents,$match_array,PREG_SET_ORDER);
  //echo($contents);
  foreach ($match_array as $entry) {
        print("$entry[0]");
  }
?>
			</div>
		</div>
	</body>
</html>
