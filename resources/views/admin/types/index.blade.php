@extends('layouts.admin')

@section('content')
    <h1 class="mb-3">Type List</h1>
    <div class="row">
        @foreach ($types as $type )
            <div class="col-3">
                <a href="{{ route('admin.types.show', $type->slug) }}" class="text-decoration-none fw-semibold">
                    <div class="card mb-3 py-2">
                        <div class="card-title text-center">
                            {{$type->name}}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
