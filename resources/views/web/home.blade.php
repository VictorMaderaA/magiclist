@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-5">
                <div class="card m-md-5">
                    <div class="card-header">Crate New List</div>
                    <div class="card-body">
                        <div class="app">
                            <list-create></list-create>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">

                @foreach(auth()->user()->lists()->get() as $list)

                <div class="card m-md-3">
                    <div class="card-header">{{$list->name}}</div>
                    <div class="card-body">
                        <p>
                            Contains {{$list->activities_count}} items.
                            <br>
                            Pending: {{$list->activities_pending_count}}
                            <br>
                            Completed: {{$list->activities_completed_count}}
                            <br>

                            <a href="{{ route('list_index', $list->id) }}" class="btn btn-default">
                                <button type="button" class="btn btn-info">Info</button>
                            </a>
                        </p>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
