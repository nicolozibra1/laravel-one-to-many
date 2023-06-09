@extends('layouts.admin')

@section('content')
    <h1>Type List</h1>
    <ul>
        @foreach ($types as $type )
        <li>{{$type->name}}</li>
        @endforeach
    </ul>
@endsection
