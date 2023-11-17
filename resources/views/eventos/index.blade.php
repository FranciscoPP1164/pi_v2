@extends('layouts.app')
@section('scripts')
<link rel="stylesheet" href="{{asset('fullCalendar/core/main.css') }}">
<link rel="stylesheet" href="{{asset('fullCalendar/daygrid/main.css') }}">
<link rel="stylesheet" href="{{asset('fullCalendar/list/main.css') }}">
<link rel="stylesheet" href="{{asset('fullCalendar/timegrid/main.css') }}">
<link rel="stylesheet" href="style.css">

<script src="{{asset('fullCalendar/core/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/interaction/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/daygrid/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/list/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/timegrid/main.js') }}" defer></script>


<link rel="icon" href="diseño solo logo.png" >

<script>
var url_="{{url('/eventos') }}";
var url_show="{{url('/eventos/show')}}";

</script>



<script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],
                defaultView: '',

                header: {
                    left: 'prev,next today miboton',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay',

                },


                dateClick:function(info){

                    limpiarFormulario();

                    $('#txtFecha').val(info.dateStr);
                    $("#btnAgregar").prop("disabled",false);
                    $("#btnModificar").prop("disabled",true);
                    $("#btnEliminar").prop("disabled",true);

                    $('#exampleModal').modal("show");
                    $('#buttonClose').click(function(){
                    $('#exampleModal').modal("hide");   
                    });

                    $('#buttonCloseSecundary').click(function(){
                        $('#exampleModal').modal("hide");   
                    });

                },

                eventClick:function(info){


                    $("#btnAgregar").prop("disabled",true);
                    $("#btnModificar").prop("disabled",false);
                    $("#btnEliminar").prop("disabled",false);                  
                    $('#txtID').val(info.event.id);
                    $('#txtTitulo').val(info.event.title);

                    mes= (info.event.start.getMonth()+1);
                    dia= (info.event.start.getDate());
                    anio= (info.event.start.getFullYear());
                    mes=(mes<10)?"0"+mes:mes;
                    dia=(dia<10)?"0"+dia:dia;

                    hora= (info.event.start.getHours()+":"+info.event.start.getMinutes());

                    $('#txtFecha').val(anio+"-"+mes+"-"+dia);
                    $('#txtHora').val(hora);
                    $('#txtColor').val(info.event.backgroundColor);
                    $('#txtDescripcion').val(info.event.extendedProps.description);
        
                    $('#exampleModal').modal("show");
                    $('#buttonClose').click(function(){
                        $('#exampleModal').modal("hide");   
                    });
                    $('#buttonCloseSecundary').click(function(){
                        $('#exampleModal').modal("hide");   
                    });
                },

                events:url_show


            });
            calendar.setOption('locale', 'Es')

            calendar.render();

            

            $('#btnAgregar').click(function(){
                ObjEvento=recolectarDatosGUI("POST");

             EnviarInformacion('',ObjEvento);
            });

            $('#btnEliminar').click(function(){
                ObjEvento=recolectarDatosGUI("DELETE");  

             EnviarInformacion('/'+$('#txtID').val(),ObjEvento);
            });

            $('#btnModificar').click(function(){
                ObjEvento=recolectarDatosGUI("PATCH");  

             EnviarInformacion('/'+$('#txtID').val(),ObjEvento);
            });


            function recolectarDatosGUI(method){ 

                nuevoEvento={
                    id:$(txtID).val(),
                    title:$(txtTitulo).val(),
                    description:$(txtDescripcion).val(),
                    color:$(txtColor).val(),
                    textColor:'FFFFFF',
                    start:$(txtFecha).val()+" "+ $(txtHora).val(),
                    end:$(txtFecha).val()+" "+ $(txtHora).val(),
                    '_token':$("meta[name='csrf-token']").attr("content"),
                    '_method':method
                }

                return(nuevoEvento);

            }
            function EnviarInformacion(accion,ObjEvento){
                $.ajax(
                    {
                    type:"POST",
                    url:url_+accion,
                    data:ObjEvento,
                    success:function(msg){
                        $('#exampleModal').modal('toggle');
                        calendar.refetchEvents();
                        
                    
                    },
                    error:function(){alert("Verifica que todos los campos esten completos");}
                }
                );
            }
                function limpiarFormulario(){

                    $('#txtID').val("");
                    $('#txtTitulo').val("");
                    $('#txtFecha').val("");
                    $('#txtHora').val("");
                    $('#txtColor').val("");
                    $('#txtDescripcion').val("");
                }


        });

    </script>

@endsection
@section('content')
<div class="row">
        <div class="col"></div>
        <div class="col-10"> <div id="calendar"></div> </div>
        <div class="col"></div>


</div>
<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h5 class="modal-title" id="exampleModalLabel">Datos del evento</h5>
                    <button type="button" id="buttonClose" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-none">
                    
                    
                    <div class="form-group col-md-12">
                    <label>ID:</label>
                    <input type="text" class="form-control" name="txtID" id="txtID">
                    </div>

                    <div class="form-group col-md-12">
                    <label>Fecha:</label>
                    <input type="text" class="form-control" name="txtFecha" id="txtFecha">
                    </div>
                    </div>

                    <div class="form-row">
                    <div class="form-group col-md-8">
                    <label>Título:</label>
                    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo">
                    </div>

                    <div class="form-group col-md-4">
                    <label>Hora:</label>
                    <input type="time" min="00:00" max="23:59" step="600" class="form-control" name="txtHora" id="txtHora">
                    </div>
                  
                    <div class="form-group col-md-12">
                    <label>Descripción:</label>
                    <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" cols="30" rows="3"></textarea>
                    </div>

                    <div class="form-group col-md-12">
                    <label>Color</label>
                    <input type="color" class="form-control" name="txtColor" id="txtColor">
                    </div>
                    
                    
                    </div>
                <div class="modal-footer">
                    

                <button id="btnAgregar" class="btn btn-success">Agregar</button>
                <button id="btnModificar" class="btn btn-warning">Modificar</button>                  
                <button id="btnEliminar" class="btn btn-danger">Eliminar</button>
                    
                    
                    <button type="button" id="buttonCloseSecundary" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div>


@endsection