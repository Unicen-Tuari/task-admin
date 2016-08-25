<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Task Admin Pro V0.0001</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <h1>Tasks List:</h1>
    <form action="index.php?action=add_task" method="POST">
      <div class="form-group">
        <label for="user">User</label>
        <input type="text" class="form-control" id="user" name="user" placeholder="Insert user name here...">
        <label for="task">New Task</label>
        <input type="text" class="form-control" id="task" name="task" placeholder="Insert task name here...">
        <label for="description">Task Description</label>
        <input type="text" class="form-control" id="description" name="description" placeholder="Insert task description here...">
      </div>
      <button type="submit" class="btn btn-default">Add</button>
    </form>
    {if $added }
    <div class="alert alert-success" role="alert">Yes, It worked!</div>
    {/if}
    <ul class="list-group">
      {foreach from=$tasks item=task}
        <li class="list-group-item">
          {if $task['finalizada'] }
          <s><strong>{$task['titulo']}&nbsp;</strong>{$task['descripcion']}</s>
          {else}
            <strong>{$task['titulo']}&nbsp;</strong>{$task['descripcion']}
          {/if}
          <a href="index.php?action=delete_task&task={$task['id_tarea']}">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </a>
          <a href="index.php?action=toggle_status_task&task={$task['id_tarea']}">
          {if $task['finalizada'] }
            <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>
          {else}
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          {/if}
          </a>
        </li>
      {/foreach}
    </ul>
  </body>
</html>
