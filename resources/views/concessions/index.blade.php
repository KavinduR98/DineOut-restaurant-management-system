@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Concessions') }}</div>

                    <div class="card-body">

                        @session('success')
                            <div class="alert alert-success">
                                {{ $value }}
                            </div>
                        @endsession

                        <a class="btn btn-success mb-3" href="/create_concession">Create Concession</a>

                        <table class="table table-striped table-bordered" id="tableConcessions">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th width="300px">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ URL::asset('assets/js/concessions/all_concession.js') }}"></script>
@endsection