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
      $.get("index.php?action=delete_task",
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
      $.get("index.php?action=toggle_status_task",
        { task: id_tarea },
        function(data){
          refreshList(data)
        });
  });
}

$( document ).ready(function() {
  $('#addBtn').click(function(){
    event.preventDefault();
    $.post("index.php?action=add_task",
      $("#addForm").serialize(),
      function(data){
        refreshList(data)
        $('#addForm').trigger("reset");
      });
  });
  addDeleteEvents();
  addUpdateEvents();
});
