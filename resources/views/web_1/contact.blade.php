@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('api_contact') }}">
                            @csrf

                            <div class="form-group">
                                <label for="type">Tipo de Mensaje</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="general">Generico</option>
                                    <option value="suggestion">Mandar Sugerencia</option>
                                    <option value="feature">Solicitar Funciones</option>
                                    <option value="problem">Reportar Problema</option>
                                    <option value="message">Enviar Mensaje</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Mensaje</label>
                                <textarea class="form-control" id="message" name="message" rows="7"></textarea>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="anon" name="anon" value="1">
                                <label class="form-check-label" for="anon">Enviar mensaje anónimo</label>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
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
