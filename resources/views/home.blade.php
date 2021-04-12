@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default" style="background-color: #ffffff">
                <div class="Panel-heading py-1 px-3"><h2>{{ __('Dashboard') }}</h2></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{-- Contenedor Tablas primarias --}}
                         @if(Auth::user()->id_rol_user == 1)
                            {{-- Menu Tablas primarias --}}
                            <div class="px-2 py-2">
                                <table class="table table-responsive mx-auto nowrap px-2 py-2">
                                    <tr>
                                        <td class="">
                                            <a href="{{ route('bancos.index') }}" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="fas fa-university"></i>  {{__('Banks')}}</a>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('documentos.index') }}" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="far fa-file-alt"></i>  {{__('Type Documents')}}</a>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('estados.index') }}" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="fas fa-info"></i>  {{__('Status')}}</a>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('paises.index') }}" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="fas fa-globe"></i>  {{__('Countries')}}</a>
                                        </td>
                                        <td class="">
                                            <a href="{{ route('titulares.index') }}" class="btn btn-primary btn-lg" width="35px" height="35px"><i class="far fa-address-card"></i>  {{__('Owners')}}</a>
                                        </td>
                                    </tr>
                                    <td></td>
                                    <tr class="">
                                        <td class="">
                                            <a href="{{ route('paises.index') }}" class="btn btn-success btn-lg" width="35px" height="35px"><i class="fas fa-university"></i>  {{__('Countries')}}</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
