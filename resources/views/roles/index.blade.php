@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Roles') }}</div>

                    <div class="card-body">

                        @session('success')
                            <div class="alert alert-success">
                                {{ $value }}
                            </div>
                        @endsession

                        @can('role-create')
                            <a class="btn btn-success mb-3" href="{{ route('roles.create') }}">Create Role</a>
                        @endcan

                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="60px">ID</th>
                                    <th>Name</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                @can('role-list')
                                                    <a href="{{ route('roles.show', $role->id) }}"
                                                        class="btn btn-info btn-sm">Show</a>
                                                @endcan
                                                @can('role-edit')
                                                    <a href="{{ route('roles.edit', $role->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endcan
                                                @can('role-delete')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
