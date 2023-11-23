@extends('layouts.app')

@section('content')
<div class="form-content">
<form action="{{route('clients.update', ['client'=>$client->id])}}" method="POST" class="create-form">
  @csrf
  @method('PUT')
    <h1 class="section-title">Edita un cliente</h1>

    <div class="input-form">
      <label for="clientName">Nombre</label>
      <input type="text" id="clientName" name="name" value="{{$client->name}}">
    </div>
  
    <div class="input-form">
      <label for="clientPhone">Telefono</label>
      <input type="number" id="clientPhone" name="phone" value="{{$client->phone}}">
    </div>

    <div class="input-form">
      <label for="clientID">Documento de identidad</label>
      <input type="number" id="clientID" name="identity_document" value="{{$client->identity_document}}">
    </div>

    <button type="submit">Guardar</button>
    
  </form>
</div>
@endsection