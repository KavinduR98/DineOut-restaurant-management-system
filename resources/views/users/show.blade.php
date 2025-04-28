@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Show User') }}</div>

                <div class="card-body">

                    <a class="btn btn-info mb-3" href="{{ route('users.index') }}">Back</a>
                    
                    <p><strong>Name: </strong> {{ $user->name }}</p>
                    <p><strong>Email: </strong> {{ $user->email }}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
