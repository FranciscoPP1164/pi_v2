@extends('layouts.app')

@section('content')
<div class="form-content create-form">
<form action="{{route('nurses.update', ['nurse'=>$nurse->id])}}" method="POST">
  @csrf
  @method('PUT')
    <h1 class="section-title">Edita un enfermero</h1>

    <div class="input-form">
      <label for="nurseName">Nombre</label>
      <input type="text" id="nurseName" name="name" value="{{$nurse->name}}">
    </div>
  
    <div class="input-form">
      <label for="nurseName">Genero</label>
      <select name="gender" id="nurseGender">
        <option value="male" @selected($nurse->gender==='male')>Masculino</option>
        <option value="female" @selected($nurse->gender==='female')>Femenino</option>
      </select>
    </div>

    <button type="submit">Guardar</button>
    
  </form>
</div>
@endsection