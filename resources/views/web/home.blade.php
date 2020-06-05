@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">


                @foreach(auth('web')->user()->lists()->get() as $list)

                <div class="card m-md-3">
                    <div class="card-header">{{$list->name}}</div>
                    <div class="card-body">
                        <p>
                            Contiene: {{$list->activities()->count()}}
                            <br>
                            <a href="{{ route('list_index', $list->id) }}" class="btn btn-default">Edit</a>
                        </p>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
