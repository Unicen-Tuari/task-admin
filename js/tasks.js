"use strict";

function processImages(nuevaTarea,images){
  $.ajax({
    url: 'js/templates/imagen.mst',
    success: function(template){
      var htmlImagenes = '';
      for (var i = 0; i < images.length; i++) {
        htmlImagenes += Mustache.render(template,images[i]);
      }
      nuevaTarea = nuevaTarea.replace("**img-placeholder**",htmlImagenes);
      $("#listTasks").append(nuevaTarea);
    }
  });
}

function processTask(data){

    $.ajax({
      url: 'js/templates/tareas.mst',
      success: function(template) {
        for (var i = 0; i < data.length; i++) {
         var nuevaTarea = Mustache.render(template,data[i]);
         //Esta el placeholder
         processImages(nuevaTarea,data[i].imagenes);
        }
        addDeleteEvents();
        addUpdateEvents();
      }
    });

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
