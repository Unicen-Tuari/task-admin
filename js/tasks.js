"use strict";

function refreshList(data){
  $("#listTasks").html(data);
  addDeleteEvents();
  addUpdateEvents();
}

function addDeleteEvents(){
  $('.deleteAction').click(function(){
      event.preventDefault();
      var id_tarea = $(this).attr("id-tarea");
      $.get("delete_task",
        { task: id_tarea },
        function(data){
          refreshList(data)
        });
  });
}

function addUpdateEvents(){
  $('.updateAction').click(function(){
      event.preventDefault();
      var id_tarea = $(this).attr("id-tarea");
      $.get("toggle_status_task",
        { task: id_tarea },
        function(data){
          refreshList(data)
        });
  });
}

$( document ).ready(function() {
  $('#addForm').submit(function(){
    event.preventDefault();
    var formData = new FormData(this);
    $.ajax({
     method: "POST",
     url: "index.php?action=add_task",
     data: formData,
     contentType: false,
     cache: false,
     processData:false,
     success: function(data){
       refreshList(data);
       $('#addForm').trigger("reset");
     }
   });

 });

  addDeleteEvents();
  addUpdateEvents();
});
