"use strict";

var templateTareas;

$.ajax({
  url: 'js/templates/tareas.mst',
  success: function(templateReceived){
    templateTareas = templateReceived;
  }
});

function processTask(data){
      var nuevaTarea = Mustache.render(templateTareas,{paquete:data});
      //Esta el placeholder
      $("#listTasks").append(nuevaTarea);
      addDeleteEvents();
      addUpdateEvents();
}

function refreshListJSON(data){
  $("#listTasks").html('');
  processTask(data);
}

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


  $('#refresh').click(function(event){
    event.preventDefault();
    $.ajax({
      method: "GET",
      url: "api/tarea",
      success: function(data){ //data contiene JSON
        refreshListJSON(data);
      }
    })
  });


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
