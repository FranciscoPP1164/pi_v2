@extends('layouts.app')

@section('content')
<div class="form-content patient-form">
<form action="{{route('patients.update', ['patient'=>$patient->id])}}" method="POST">
  @csrf
  @method('PUT')
    <h1 class="section-title">Edita un paciente</h1>

    <div class="input-form">
      <label for="patientName">Nombre</label>
      <input type="text" id="patientName" name="name" value="{{$patient->name}}">
    </div>
  
    <div class="input-form">
      <label for="patientAge">Edad</label>
      <input type="number" id="patientPhone" name="age" value="{{$patient->age}}">
    </div>

    <div class="input-form">
      <label for="patientID">Documento de identidad</label>
      <input type="number" id="patientID" name="identity_document" value="{{$patient->identity_document}}">
    </div>

    <div class="input-form">
      <label for="patientID">Direccion</label>
      <input id="patientID" name="direction" value="{{$patient->direction}}">
    </div>

    <button type="submit">Guardar</button>
    
  </form>
</div>
@endsection