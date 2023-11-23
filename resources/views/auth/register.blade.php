@extends('layouts.app')

@section('content')
    <div class="form-content">
        <img src="app-icon.png" alt="">

        <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="input-form">
                <label for="nameLogin">Nombre</label>
                <input type="text" name="name" id="nameLogin">

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-form">
                <label for="emailLogin">Correo electronico</label>
                <input type="text" name="email" id="emailLogin">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-form">
                <label for="passwordLogin">Contraseña</label>
                <input type="password" name="password" id="passwordLogin">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="input-form">
                <label for="passwordLogin">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" id="passwordLogin">
            </div>

            <button type="submit">Iniciar sesion</button>
        </form>
    </div>
@endsection
