
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
    <script src="js/tag.js"></script>
    <script src="js/navbar.js"></script>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/main.css">
    <meta charset="utf-8" http-equiv="Content-Type" content="text/html">
    <title>Leaftag</title>
    <script>
    //USE FOR DEBUG!
    $.ajaxSetup ({
      cache: false
    });

    //load banner
    $( document ).ready(function() {
      $("#banner").load('navbar.html');
      listAllTag();
    });

    </script>
  </head>
  <body>
    <div id="banner" class="navbar"></div>
    <div class="main">
      <h1 class="welcome"><?php echo($_SESSION['userID']);?> - Welcome to LeafTag</h1>
      <div class="data-block">
        <h2 class="head-info"><i class="fa fa-tags"></i>
書籤設定</h2>
        <form id="tagTable">
          <div class="form-group">
            <input class="form-control" type="text" name="tagName" placeholder="書籤名稱"></input>
          </div>
          <div class="form-group">
            <input class="form-control" type="text" name="tagAdd" placeholder="書籤連結"></input>
          </div>
          <input id="MID" readonly="true" class="form-control limited" type="text" name="tagID" placeholder="欲更動的標籤編號"></input>
          <input class="gitbuh-button" type="button" value="新增" onclick="TagOperate(3)">
          <input class="gitbuh-button" type="button" value="修改" onclick="TagOperate(4)">
          <div id="tag-status"></div>
        </form>
      </div>
      <div class="data-block">
        <h2 class="head-info"><i class="fa fa-book"></i> 書籤列表</h2>
        <input class="form-control" type="text" id="tag-filter" placeholder="書籤搜尋"></input>
        <hr>
        <div id="tag-list" class="tag-text">
          <!--template-->
          <h3>Loading...</h3>
        </div>
      </div>
    </div>
  </body>
</html>
