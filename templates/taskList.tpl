<ul class="list-group">
  {foreach from=$tasks item=task}
    <li class="list-group-item">
      {if $task['finalizada'] }
      <s><strong>{$task['titulo']}&nbsp;</strong>{$task['descripcion']}</s>
      {else}
        <strong>{$task['titulo']}&nbsp;</strong>{$task['descripcion']}
        {if $task['imagenes'] }
          {foreach from=$task['imagenes'] key=index item=imagen}
            <img src="{$imagen['path']}" alt="{$task['titulo']}_image_{$index}" class="img-thumbnail" />
          {/foreach}
        {/if}
      {/if}
      <a class="deleteAction" id-tarea="{$task['id_tarea']}" href="#">
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
