@extends('layouts.app')

@section('content')

  <div class="form-content create-form patient-form">
    <form action="{{route('patients.store')}}" method="POST">
      @csrf
      <h1 class="section-title">Crear un paciente</h1>
      
      <div class="input-form">
        <label for="patientName">Nombre</label>
        <input type="text" id="patientName" name="name">
      </div>
    
      <div class="input-form">
        <label for="patientAge">Edad</label>
        <input type="number" id="patientPhone" name="age">
      </div>

      <div class="input-form">
        <label for="patientID">Documento de identidad</label>
        <input type="number" id="patientID" name="identity_document">
      </div>

      <div class="input-form">
        <label for="patientID">Direccion</label>
        <input id="patientID" name="direction">
      </div>
{{-- 
      <div class="input-form">
        <label for="patientName">Genero</label>
        <select name="gender" id="patientGender">
          <option value="male">Masculino</option>
          <option value="female">Femenino</option>
        </select>
      </div> --}}

      <button type="submit">Guardar</button>
    </form>
  </div>

@endsection