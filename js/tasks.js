"use strict";
$( document ).ready(function() {

$('#addBtn').click(function(){
  event.preventDefault();
  $.post("index.php?action=add_task",
    $("#addForm").serialize(),
    function(data){
      $("#listTasks").html(data);
      $('#addForm').trigger("reset");
    });
});
});
