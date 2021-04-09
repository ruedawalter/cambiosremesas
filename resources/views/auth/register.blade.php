@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nombres" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-4">
                                <input id="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}" required autocomplete="name" placeholder="Ingrese solo Nombres" autofocus onkeyup="mayus(this);">

                                @error('nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="apellidos" class="col-md-4 col-form-label text-md-right">{{ __('SurName') }}</label>

                            <div class="col-md-4">
                                <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}" required autocomplete="apellidos" placeholder="Ingrese solo Apellidos" autofocus onkeyup="mayus(this);">

                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_doc_user" class="col-md-4 col-form-label text-md-right">{{ __('Type document') }}</label>

                            <div class="col-md-6">
                                <select class="form-control bg-light shadow-sm col-8" name ="id_doc_user" id="id_doc_user"  class="form-control" required>
                                <option value="">--{{__('Select')}}--</option>
                                @foreach($documentos as $documento)
                                    <option value="{{$documento->id}}">{{$documento->documento}}</option>
                                @endforeach
                            </select>
                           </div>
                        </div>

                         <div class="form-group row">
                            <label for="doc_user" class="col-md-4 col-form-label text-md-right">{{ __('Document Number') }}</label>

                            <div class="col-md-4">
                                <input id="doc_user" type="text" class="form-control @error('doc_user') is-invalid @enderror" name="doc_user" value="{{ old('doc_user') }}" required autocomplete="doc_user" placeholder="Documento de Identidad N°" autofocus onkeypress='return validaNum(event)'/>

                                @error('doc_user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="tel_user" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-4">
                                <input id="tel_user" type="text" class="form-control @error('tel_user') is-invalid @enderror" name="tel_user" value="{{ old('tel_user') }}" required autocomplete="tel_user" placeholder="Incluya el cod Pais" autofocus onkeypress='return validaNum(event)'/>

                                @error('tel_user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ejemplo@ejemplo.com" onkeyup="minus(this);">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-4">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Nombre de usuario" onkeyup="minus(this);">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Min 8 Caracteres">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Min 8 Caracteres">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_pais_user" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-8">
                            <select class="form-control bg-light shadow-sm col-6" name ="id_pais_user" id="id_pais_user"  class="form-control">
                              <option value="">--{{__('Select')}}--</option>
                                @foreach($paises as $pais)
                                    <option value="{{$pais->id}}">{{$pais->nom_pais}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        @guest
                         <input id="id_rol_user" type="hidden" name="id_rol_user" value=3>
                        @endguest
                        @auth
                        @if ( Auth::user()->id_rol_user == "1")
                            <div class="form-group row">
                                <label for="id_rol_user" class="col-md-4 col-form-label text-md-right">{{ __('Type user') }}</label>

                                <div class="col-md-8">
                                    <select class="form-control bg-light shadow-sm col-6" name ="id_rol_user" id="id_rol_user"  class="form-control">
                                      <option value="">--{{__('Select')}}--</option>
                                        @foreach($items as $item)
                                            <option value="{{$item->id_rol}}">{{$item->nom_rol}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        @endauth
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
