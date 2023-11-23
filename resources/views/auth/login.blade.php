@extends('layouts.app')

@section('content')
    <div class="form-content">
        <img src="app-icon.png" alt="">

        <form action="{{route('login')}}" method="POST">
            @csrf
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

            <div class="input-form-check-box">
                <label for="rememberPasswordLogin">Recordar contraseña</label>
                <input type="checkbox" name="remember" id="rememberPasswordLogin" {{ old('remember') ? 'checked' : '' }}>
            </div>

            <button type="submit">Iniciar sesion</button>

            <a href="{{route('password.request')}}">Olvidaste la contraseña</a>
        </form>
    </div>
@endsection
