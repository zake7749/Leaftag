
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
      listAllTag();
    });
    </script>
    <script>
			var Submit=function(){
				$.ajax({
						url: "action.php",
						data: $('#user-information').serialize(),
						type:"POST",
						dataType:'text',

						success: function(response){
							$('#response-text').html(response);
							$('#response-text').fadeIn("slow");
						},

						error:function(xhr, ajaxOptions, thrownError){
							alert(xhr.status);
							alert(thrownError);
						}
				});
			}
		</script>
	</head>

	<body>
    <div id="banner" class="navbar"></div>
		<div class="display-box">
			<span class="whiteHighlight glyphicon glyphicon-grain" style="font-size:50px" aria-hidden="true"></span>
			<div class="whiteHighlight header-title ">
				Update your personal information
			</div>
			<div class="text-block shadowbox">
			<form id="user-information" method="post">
				<input type="hidden" name="action" value="6">
				<div class="form-group">
					 <label for="password">Password</label>
					 <input type="password" class="form-control" name="password">
				</div>
        <div class="form-group">
           <label for="address">E-mail address</label>
           <input type="text" class="form-control" name="address">
        </div>
        <div class="form-group">
           <label for="username">Birth-date</label>
           <input type="text" class="form-control" name="date">
        </div>
				<input class="gitbuh-submit-button" type="button" value="Submit" onclick="Submit()">
				<div id="response-text" class="feedback"></div>
			</form>
			</div>
		</div>
	</body>
</html>
