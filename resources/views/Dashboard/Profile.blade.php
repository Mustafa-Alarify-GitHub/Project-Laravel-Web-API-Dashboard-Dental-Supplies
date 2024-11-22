@extends('layout/Layout')

@section('content')
    <div class="col-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h4 class="card-title">ُEdite Profile</h4>
                @if (session()->has('error'))
                    <div class="alert alert-danger" id="alert">
                        {{ session('error') }}
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById("alert").style.display = "none";
                        }, [2000]);
                    </script>
                @endif
                @if (session()->has('success'))
                    <div class="alert alert-primary`" id="alert">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById("alert").style.display = "none";
                        }, [2000]);
                    </script>
                @endif
                <form class="forms-sample" method="POST" action="{{ route('Profile.update', [$data->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" value="{{ $data->name }}" name="name" class="form-control"
                            id="exampleInputName1" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1">phone</label>
                        <input type="text" value="{{ $data->phone }}" name="phone" class="form-control"
                            id="exampleInputName1" placeholder="Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName1">Location</label>
                        <input type="text" value="{{ $data->Location }}" name="location" class="form-control"
                            id="exampleInputName1" placeholder="Name">
                    </div>


                    <input type="file"  style="display: none" name="image" id="image" class="file-upload-default">

                    <label for="image">
                        <div class="form-group">
                            <h5>Image upload</h5>
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <div class="file-upload-browse btn btn-primary"type="button">Upload</div>
                                </span>
                            </div>
                    </label>


                    <br>
                    <br>

                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                    <a href="{{ route('Profile.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
