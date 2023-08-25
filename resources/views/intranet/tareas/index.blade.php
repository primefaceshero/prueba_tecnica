@extends('intranet.template.base')



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel">
                {{--<div class="panel-heading">--}}
                {{--<h3 class="panel-title"></h3>--}}
                {{--</div>--}}
                <div class="panel-body">
                    @include('intranet.template.components._alerts')

                    <div id="toolbar">
                       
                        {{--<button id="delete-row" class="btn btn-danger" disabled><i class="demo-pli-cross"></i> Delete</button>--}}
                    </div>

                    <table id="table-bs"
                           data-toggle="table"
                           data-toolbar="#toolbar"
                           data-cookie="true"
                           data-search="true"
                           data-show-refresh="true"
                           data-show-export="false"
                           data-show-toggle="true"
                           data-show-columns="true"
                           data-sort-name="id"
                           data-page-list="[5, 50, 100]"
                           data-page-size="50"
                           data-pagination="true"
                           data-show-pagination-switch="true">
                        <thead>
                        <tr>
                            <th data-sortable="true" data-valign="middle">Título</th>
                            <th data-sortable="true" data-valign="middle">Descripción</th>
                            <th data-sortable="true" data-valign="middle">Fecha de vencimiento</th>
                            <th data-cell-style="cellStyle" data-valign="middle">Acciones</th>
        
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tareas as $object)
                            <tr>
                                
                                <td>{{ $object->titulo}}</td>
                                <td>{{ $object->descripcion }}</td>
                                <td>{{ $object->fechaVencimiento }}</td>
                                <td>
                                    <div>
                                    <div class="btn-group" style="width: max-content;">
    
                                    <a href="{{ url("/tareas/edit/".$object->id)}}"
                                    class="btn btn-sm btn-default btn-hover-warning add-tooltip"
                                    title="Editar">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="confirmDelete('{{$object->id}}')"
                                        class="btn btn-sm btn-default btn-hover-danger add-tooltip"
                                        title="Eliminar"
                                        style="float: left;">
                                    <i class="fa fa-remove"></i>
                                </button>
                                    
                                </div>
                                
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

@endsection


