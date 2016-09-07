<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Task Admin Pro V0.0001</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>Tasks List:</h1>
    <form action="" method="POST" enctype="multipart/form-data" id="addForm">
      <div class="form-group">
        <label for="task">New Task</label>
        <input type="text" class="form-control" id="task" name="task" placeholder="Insert task name here...">
        <label for="description">Task Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Insert task description here...">
        <label for="image">Image</label>
        <input type="file" name="image[]" id="image" multiple>
      </div>
      <button type="submit" id="addBtn" class="btn btn-default">Add</button>
    </form>
    {if $added }
    <div class="alert alert-success" role="alert">Yes, It worked!</div>
    {/if}
    <div id="listTasks">
      {include file='taskList.tpl'}
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/tasks.js"></script>
  </body>
</html>
