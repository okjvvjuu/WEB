@extends('layouts.ui')

@section('content')
    <div class="col">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 bg-transparent">
                        <h1 class="text-center my-4 card-header bg-transparent">Configuración de mi cuenta</h1>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="surname"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Surname') }}</label>

                                    <div class="col-md-6">
                                        <input id="surname" type="text"
                                            class="form-control @error('surname') is-invalid @enderror" name="surname"
                                            value="{{ Auth::user()->surname }}" required autocomplete="surname" autofocus>

                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nick"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Nickname') }}</label>

                                    <div class="col-md-6">
                                        <input id="nick" type="text"
                                            class="form-control @error('nick') is-invalid @enderror" name="nick"
                                            value="{{ Auth::user()->nick }}" required autocomplete="nick" autofocus>

                                        @error('nick')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ Auth::user()->email }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="text-secondary">
                                <h4 class="text-center">Solo si quieres <u>cambiar de contraseña</u>, modifica los
                                    siguientes campos</h4>
                                <hr class="text-secondary">

                                <div class="row mb-3">
                                    <label for="new-password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('New password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new-password" type="password"
                                            class="form-control @error('new-password') is-invalid @enderror"
                                            name="new-password" autocomplete="new-password">

                                        @error('new-password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new-password_confirmation"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Confirm new password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new-password_confirmation" type="password" class="form-control"
                                            name="new-password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Guardar cambios
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
