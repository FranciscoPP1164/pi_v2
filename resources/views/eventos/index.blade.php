@extends('layouts.app')
@section('scripts')
<link rel="stylesheet" href="{{asset('fullCalendar/core/main.css') }}">
<link rel="stylesheet" href="{{asset('fullCalendar/daygrid/main.css') }}">
<link rel="stylesheet" href="{{asset('fullCalendar/list/main.css') }}">
<link rel="stylesheet" href="{{asset('fullCalendar/timegrid/main.css') }}">

<script src="{{asset('fullCalendar/core/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/interaction/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/daygrid/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/list/main.js') }}" defer></script>
<script src="{{asset('fullCalendar/timegrid/main.js') }}" defer></script>

<script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                // defaultDate: new Date(2019, 8, 1),
                plugins: ['dayGrid', 'interaction', 'timeGrid', 'list'],
                defaultView: '',

                header: {
                    left: 'prev,next today miboton',
                    center: 'title',
                    right: 'dayGridMonth, timeGridWeek, timeGridDay',

                },
                // customButtons: {

                //     miboton: {
                //         text: "Botón",
                //         click: function () {
                //             alert("callate");
                //             $('#exampleModal').modal('toggle');
                //         }
                //     }
                // },

                dateClick:function(info){

                    $('#txtFecha').val(info.dateStr)

                    $('#exampleModal').modal("show");
                    $('#buttonClose').click(function(){
                        $('#exampleModal').modal("hide");   
                    });

                    $('#buttonCloseSecundary').click(function(){
                        $('#exampleModal').modal("hide");   
                    });

                    // console.log(info);
                    // calendar.addEvent({ title:"Evento x", date:info.dateStr});
                },

                eventClick:function(info){

                    console.log(info);
                    console.log(info.event.title);
                    console.log(info.event.start);

                    console.log(info.event.end);
                    console.log(info.event.textColor);
                    console.log(info.event.backgroundColor);

                    console.log(info.event.extendedProps.descripcion);
                    
                    $('#txtID').val(info.event.id);
                    $('#txtTitulo').val(info.event.title);

                    mes= (info.event.start.getMonth()+1);
                    dia= (info.event.start.getDate());
                    anio= (info.event.start.getFullYear());

                    hora= (info.event.start.getHours()+":"+info.event.start.getMinutes());


                    $('#txtDescripcion').val(info.event.extendedProps.description);
                    $('#txtColor').val(info.event.backgroundColor);
                    $('#txtFecha').val(anio+"-"+mes+"-"+dia);
                    $('#txtHora').val(hora);
                    
                    $('#exampleModal').modal("show");
                    $('#buttonClose').click(function(){
                        $('#exampleModal').modal("hide");   
                    });

                    $('#buttonCloseSecundary').click(function(){
                        $('#exampleModal').modal("hide");   
                    });
                },

                events:"{{url('/eventos/show')}}"


            });
            calendar.setOption('locale', 'Es')

            calendar.render();

            $('#btnAgregar').click(function(){
                ObjEvento=recolectarDatosGUI("POST");

               
             EnviarInformacion('',ObjEvento);
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
                $.ajax({
                    type:"POST",
                    url:"{{url('/eventos') }}"+accion,
                    data:ObjEvento,
                    success:function(msg){console.log(msg);
                       
                        
                    
                    },
                    error:function(){alert("Hay un error");}
                });
            }

        });

    </script>

@endsection
@section('content')
<div class="row">
        <div class="col"></div>
        <div class="col-7"> <div id="calendar"></div> </div>
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
                    ID:
                    <input type="text" name="txtID" id="txtID">
                    <br/>
                    Fecha:
                    <input type="text" name="txtFecha" id="txtFecha">
                    <br/>
                    Título:
                    <input type="text" name="txtTitulo" id="txtTitulo">
                    <br/>
                    Hora:
                    <input type="text" name="txtHora" id="txtHora">
                    <br/>
                    Descripción:
                    <textarea name="txtDescripcion" id="txtDescripcion" cols="30" rows="10"></textarea>
                    <br/>
                    Color
                    <input type="color" name="txtColor" id="txtColor">
                    <br/>
                
                </div>
                <div class="modal-footer">

                    <button id="btnAgregar" class="btn btn-success">Agregar</button>
                    <button id="btnModificar " class="btn btn-warning">Modificar</button>
                    

                    <button type="button" id="buttonCloseSecundary" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                   
                </div>
            </div>
        </div>
    </div>


@endsection