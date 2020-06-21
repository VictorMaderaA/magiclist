@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('api_contact') }}">
                            @csrf

                            <div class="form-text text-center">
                                <p>
                                    Puedes enviarnos un mensaje reportando problemas, mejoras o sugerencias para que sea mas
                                    facil de utilizar la plataforma.
                                </p>
                            </div>


                            <div class="form-group">
                                <label for="type">Tipo de Mensaje</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="general">Generico</option>
                                    <option value="suggestion">Enviar Sugerencia</option>
                                    <option value="feature">Solicitar Funciones</option>
                                    <option value="problem">Reportar Problema</option>
                                    <option value="message">Enviar Mensaje</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="7" required></textarea>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="anon" name="anon" value="1">
                                <label class="form-check-label" for="anon">Enviar mensaje anónimo</label>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-auto">
                                    <a href="{{route('home')}}" class="btn btn-secondary">
                                        Regresar
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        Enviar
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
