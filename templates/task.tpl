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
        <label for="task">New Task</label>
        <input type="text" class="form-control" id="task" name="task" placeholder="Insert task here...">
      </div>
      <button type="submit" class="btn btn-default">Add</button>
    </form>
    {if $added }
    <div class="alert alert-success" role="alert">Yes, It worked!</div>
    {/if}
    <ul class="list-group">
      {foreach from=$tasks key=index item=task}
        <li class="list-group-item">{$task}
          <a href="index.php?action=delete_task&task={$index}">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
          </a>
        </li>
      {/foreach}
    </ul>
  </body>
</html>
