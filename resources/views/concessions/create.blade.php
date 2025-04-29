@extends('layouts.app')

<style>
.dropzone {
    width: 100%;
    max-width: 360px;
    height: 260px;
    min-height: 0 !important;
    text-align: center;
    border: 2px dashed #ccc;
    border-radius: 8px;
    background: #f8f9fa;
    /* margin: auto; */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px;
    font-size: 16px;
    cursor: pointer;
}

#dropzone_single .dz-message .dz-button {
    background: none !important;
    padding: 0;
    border: none;
    margin: 0;
    color: #6c757d; /* Optional: set text color */
    font-weight: 500;
}

.dz-image {
    max-height: 300px !important;
    max-width: 380px !important;
    height: auto !important;
    width: auto !important;
    margin: auto;
}

.dropzone.dz-started .dz-message {
    display: none;
}

.dz-preview.dz-file-preview {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Concession') }}</div>

                    <div class="card-body">
                        <form action="{{ route('concession.store') }}" method="POST">
                            @csrf

                            <div class="mt-2">
                                <label>Image:</label>
                                <div action="#" class="dropzone" id="dropzone_single" required></div>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label>Description:</label>
                                <textarea type="text" rows="5" name="description" id="description" class="form-control"></textarea>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mt-2">
                                <label>Price:</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            <div class=" mt-2">
                                <a class="btn btn-info" href="{{ route('concession.index') }}">Back</a>
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{URL::asset('assets/js/vendor/uploaders/dropzone.min.js')}}"></script>
<script src="{{ URL::asset('assets/js/concessions/concession_create.js') }}"></script>
@endsection