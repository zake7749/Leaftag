
var listAllTag=function(){
  $.ajax({
      url: "action.php",
      data: "action=7",
      type:"POST",
      dataType:'text',
      success: function(response){
        $('#tag-list').html(response);
        $('#tag-list').fadeIn("slow");
      },

      error:function(xhr, ajaxOptions, thrownError){
        alert(xhr.status);
        alert(thrownError);
      }
  });
}

var TagOperate=function(actionCode,thisID){

  var para = $('#tagTable').serialize() + "&action=" + actionCode;
  $.ajax({
      url: "action.php",
      data: para,
      type:"POST",
      dataType:'text',

      success: function(response){
        $('#tag-list').html(response);
        $('#tag-list').fadeIn("slow");
      },

      error:function(xhr, ajaxOptions, thrownError){
        alert("ERROR");
        alert(xhr.status);
        alert(thrownError);
      }
  });
}

var Delete=function(thisID){
  var para = "tagID=" + thisID + "&action=5";
  $.ajax({
      url: "action.php",
      data: para,
      type:"POST",
      dataType:'text',

      success: function(response){
        $('#tag-list').html(response);
        $('#tag-list').fadeIn("slow");
      },

      error:function(xhr, ajaxOptions, thrownError){
        alert(xhr.status);
        alert(thrownError);
      }
  });
}

var UpdateModifyNumber=function(mid){
  $("#MID").attr("value",mid);
}

$(document).ready(function(){
  $("#tag-filter").keyup(tagSearch);
})

function stringMatching(matcher,matchee){
  var patternLength = matchee.length - matcher.length + 1;
  var i = 0 , j = 0;
  for(i = 0 ; i < patternLength ; i++)
    for(j = 0 ; i+j < matchee.length && matchee[i+j] == matcher[j] ; j++)
      if(j+1 == matcher.length)
        return true;
  return false;
}

var tagSearch=function(){

  var itag = $("#tag-filter").val();
  var list = $(".tag-detail");

  if(itag != ""){
    var i=0;
    for(i=0;i<list.length;i++){
      if(!stringMatching(itag,list[i].innerHTML)){
        $("#"+i).addClass("hideThis");
      }else{
        $("#"+i).removeClass("hideThis");
      }
    }
  }else{
    listAllTag();
  }
}
