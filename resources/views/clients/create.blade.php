@extends('layouts.app')

@section('content')

  <div class="form-content create-form">
    <form action="{{route('clients.store')}}" method="POST">
      @csrf
      <h1 class="section-title">Crear un cliente</h1>
      
      <div class="input-form">
        <label for="clientName">Nombre</label>
        <input type="text" id="clientName" name="name">
      </div>
    
      <div class="input-form">
        <label for="clientPhone">Telefono</label>
        <input type="number" id="clientPhone" name="phone">
      </div>

      <div class="input-form">
        <label for="clientID">Documento de identidad</label>
        <input type="number" id="clientID" name="identity_document">
      </div>
{{-- 
      <div class="input-form">
        <label for="clientName">Genero</label>
        <select name="gender" id="clientGender">
          <option value="male">Masculino</option>
          <option value="female">Femenino</option>
        </select>
      </div> --}}

      <button type="submit">Guardar</button>
    </form>
  </div>

@endsection