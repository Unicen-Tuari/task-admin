"use strict";

function addDeleteEvents(){
  $('.deleteAction').click(function(){
      event.preventDefault();
      var id_tarea = $(this).attr("id-tarea");
      $.get("index.php?action=delete_task",
        { task: id_tarea },
        function(data){
          $("#listTasks").html(data);
          addDeleteEvents();
        });
  });
}

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

  addDeleteEvents();

});
