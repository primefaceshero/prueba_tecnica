<div class="btn-group" style="width: max-content;">
    @stack('prepend_actions_buttons' .  $object->id)
    @if($config['action']['edit'])
        <a href="{{ route($config['route'] . 'edit',[session('shop')->slug, $object->id] ) }}"
           class="btn btn-sm btn-default btn-hover-warning add-tooltip"
           title="Editar">
            <i class="fa fa-edit"></i>
        </a>
    @endif
    @if($config['action']['destroy'])
        <button type="button" onclick="confirmDelete('{{$object->id}}')"
                class="btn btn-sm btn-default btn-hover-danger add-tooltip"
                title="Eliminar"
                style="float: left;">
            <i class="fa fa-remove"></i>
        </button>
    @endif
    @stack('append_actions_buttons' .  $object->id)
</div>
<div>
    @if($config['action']['destroy'])
        <form id="form_delete_{{$object->id}}"
              class="delete-form"
              action="{{ route($config['route'] . 'destroy',[session('shop')->slug, $object->id] ) }}"
              method="post">
            <input type="hidden" name="_method" value="delete"/>
            {!! csrf_field() !!}
        </form>
    @endif
</div>
