@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show Role') }}</div>

                <div class="card-body">

                    <a class="btn btn-info mb-3" href="{{ route('roles.index') }}">Back</a>
                    
                    <p><strong>Name: </strong> {{ $role->name }}</p>

                    <h4>Permissions: </h4>
                    @foreach ($role->permissions as $permission)
                        <p>{{ $permission->name }}</p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
