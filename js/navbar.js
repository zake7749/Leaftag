
function logout(){

  $.ajax({
      url: "action.php",
      data: "action=2",
      type:"POST",
      dataType:'text',
      success: function(response){
        //alert(response);
        if(response == "Success"){
          document.location.href="login.html";
        }
      },
      error:function(xhr, ajaxOptions, thrownError){
        alert(xhr.status);
        alert(thrownError);
      }
  });
}

function ocConsole(){
  var status = $("#searchConsole").css("opacity");
  if(status == "1"){
    $("#searchConsole").css("opacity","0");
  }else{
    $("#searchConsole").css("opacity","1");
  }
}

/*
function Search(){

  var query = $("#searchConsole").val();
  var para = "action=8&query="+query;
  alert(para);
  $.ajax({
      url: "action.php",
      data: para,
      type:"POST",
      success: function(response){
        //alert(response);
      },
      error:function(xhr, ajaxOptions, thrownError){
        alert("Ajax error status:"+xhr.status);
        alert(thrownError);
      }
  });
  //document.location.href = "metaSearch.php";
}
*/
