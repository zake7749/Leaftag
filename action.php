<?php
  $TagsNumber = 0;
  require("config/config.php");
  session_start();
  /**********************************************
      Get the action command from html

      Usage
        switch(_POST["action"])

      Value
        - 0 : login
        - 1 : Register
        - 2 : Logout
        - 3 : Add a tag
        - 4 : Modify a tag
        - 5 : Delete a tag
        - 6 : Update personal data.
        - 7 : List all the tags
        - 8 : Meta search
  **********************************************/
  switch ($_POST["action"]) {
    case '0':
        login($link);
      break;
    case '1':
        register($link);
      break;
    case '2':
        logout();
      break;
    case '3':
        addTag($link);
      break;
    case '4':
        modifyTag($link);
      break;
    case '5':
        deleteTag($link);
      break;
    case '6':
        updateData($link);
      break;
    case '7':
        listAllTags($link);
      break;
    case '8':
      //  metaSearch();
    default:
      break;
  }

/*****************************************************

                Operation for the user

*****************************************************/

function login($db){

  $escapeUN = mysql_real_escape_string($_POST["username"]);
  //echo("USERNAME".$escapeUN."<br/>");
  $query= "SELECT * FROM `user_table` WHERE username = '".$escapeUN."'";
  $result= mysql_query($query,$db) or die ("Error in query: $query.". mysql_error());
  $rows=mysql_fetch_array($result);
  $password = $rows[1];
  if(md5($_POST["password"]) == $password){
    echo("Success");
    $_SESSION["userID"] = $_POST["username"];
  }
  else{
    echo("Wrong username or password.<br/>");
  }
}

function logout(){
  unset($_SESSION["userID"]);
  echo("Success");
}

function register($db){
  $passMd5 = md5($_POST["password"]);
  $query= "INSERT INTO `user_table` (`username`,`password`,`address`) VALUES ('".$_POST["username"]."','".$passMd5."','".$_POST["address"]."')";
  $result= mysql_query($query,$db) or die ("該帳號已被使用，請更換帳號名稱");
  echo "註冊成功，前往<a href='login.html'>登入頁面</a>";
}

function updateData($db){
  //update depend on which input is not empty.
  //there are 3 argument would pass:
  //$_POST["password"] / $_POST["address"] / $_POST["date"]
  //user id : $_SESSION["userID"]
  //UPDATE SQL : UPDATE "tableName" SET "field" = [newValue] WHERE "Condition";

  $query = "";
  if(!empty($_POST["password"])){
    $passMd5 = md5($_POST["password"]);
    $query = sprintf("UPDATE `user_table` SET `password` = '%s' WHERE `username` = '%s'",$passMd5,$_SESSION["userID"]);
    $result= mysql_query($query,$db) or die ("密碼更新失敗");
  }

  if(!empty($_POST["address"])){
    $query = sprintf("UPDATE `user_table` SET `address` = '%s' WHERE `username` = '%s'",$_POST["address"],$_SESSION["userID"]);
    $result= mysql_query($query,$db) or die ("郵件地址更新失敗");
  }

  if(!empty($_POST["date"])){
    $query = sprintf("UPDATE `user_table` SET `date` = '%s' WHERE `username` = '%s'",$_POST["date"],$_SESSION["userID"]);
    $result= mysql_query($query,$db) or die ("生日更新失敗");
  }
  echo("更新成功");
}

/*****************************************************

              Operation for the tag

*****************************************************/


function addTag($db){

  $query = "INSERT INTO `tag_table` (`tagName`,`tagAdd`,`tagHolder`) VALUES ('".$_POST["tagName"]."','".$_POST["tagAdd"]."','".$_SESSION["userID"]."')";
  //echo($query);
  $result= mysql_query($query,$db) or die ("標籤追加失敗，請檢查連線是否穩定");
  listAllTags($db);
}

function modifyTag($db){
  $query = "UPDATE `tag_table` SET `tagName`= '".$_POST["tagName"]."' , `tagAdd` = '".$_POST["tagAdd"]."' WHERE `tagHolder`='".$_SESSION["userID"]."' AND `tagID`='".$_POST["tagID"]."'";
  //echo $query;
  $result= mysql_query($query,$db) or die ("標籤修改失敗，請檢查標籤是否存在");
  listAllTags($db);
}

function deleteTag($db){
  $query = sprintf("DELETE FROM `tag_table` WHERE `tagID` = '%s' AND `tagHolder` = '%s'",$_POST["tagID"],$_SESSION["userID"]);
  //echo $query;
  $result= mysql_query($query,$db) or die ("標籤刪除失敗，請嘗試刷新頁面");
  listAllTags($db);
}


function listAllTags($db){
  $deleteSign = '<span class="glyphicon glyphicon-remove" aria-hidden="true">';
  $modifySign = '<span class="glyphicon glyphicon-pencil" aria-hidden="true">';
  $query = "SELECT * FROM `tag_table` WHERE tagHolder = '".$_SESSION["userID"]."'";
  $result= mysql_query($query,$db) or die ("標籤顯示失敗，請檢查連線是否穩定");
  $this_time_id = 0;
  while($rows=mysql_fetch_array($result)){
      //Output format
      //<li><a href="#" id="#" onclick="Delete()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></a></li>

      //check if absoulte link.
      if($rows[2][0]!="h"&&$rows[2][1]!="t"&&$rows[2][2]!="t"&&$rows[2][3]!="p")
        $rows[2] = "http://".$rows[2];

      echo('<li id="'.$this_time_id.'"><a onclick="Delete('.$rows[0].')" class="clickable-item">');
        echo($deleteSign);
        echo('</a>');
        echo('<a onclick="UpdateModifyNumber('.$rows[0].')" class="clickable-item pencil">');
        echo($modifySign);
        echo('</a>');
      echo('<a href="'.$rows[2].'">');
        echo('<span class="tag-detail" id="Htag">');
          echo($rows[1]);
        echo('</span');
      echo('</a>');
      echo('</li>');
      $this_time_id += 1;
  }
}

function getResultNum($db){
  $deleteSign = '<span class="glyphicon glyphicon-remove" aria-hidden="true">';
  $query = "SELECT * FROM `tag_table` WHERE tagHolder = '".$_SESSION["userID"]."'";
  $result= mysql_query($query,$db) or die ("FATAL ERROR: Please connect admin.");
  $total = 1;
  while($rows=mysql_fetch_array($result)){
      $total += 1;
  }
  return $total;
}

//function metaSearch(){
//  $_SESSION["user_query"] = $_POST["query"];
//}
?>
