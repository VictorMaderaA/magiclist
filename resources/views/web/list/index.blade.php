@extends('layouts.app')

@section('content')

    <div class="app">

        <list-main-card :listimport="{{$list}}"></list-main-card>

    </div>

@endsection
