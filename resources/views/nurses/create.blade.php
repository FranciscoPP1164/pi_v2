@extends('layouts.app')

@section('content')

  <div class="form-content create-form">
    <form action="{{route('nurses.store')}}" method="POST">
      @csrf
      <h1 class="section-title">Crear un enfermero</h1>
      
      <div class="input-form">
        <label for="nurseName">Nombre</label>
        <input type="text" id="nurseName" name="name">
      </div>
    
      <div class="input-form">
        <label for="nurseName">Genero</label>
        <select name="gender" id="nurseGender">
          <option value="male">Masculino</option>
          <option value="female">Femenino</option>
        </select>
      </div>

      <button type="submit">Guardar</button>
    </form>
  </div>

@endsection