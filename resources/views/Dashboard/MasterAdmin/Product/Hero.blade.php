@extends('layout/Layout')
@section('content')
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hero Table</h4>

                <button type="button" onclick="ShowHiddenDiv()" id="btn-Add" class="btn btn-inverse-success btn-fw">Add New
                    Hero
                </button>

                <br>
                <br>
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
                    <div class="alert alert-success" id="alert">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(() => {
                            document.getElementById("alert").style.display = "none";
                        }, [2000]);
                    </script>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Image </th>
                            <th> start Time </th>
                            <th> End Time </th>
                            <th> Status </th>
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $i)
                            <tr>
                                <td class="py-1">
                                    <img src="{{ $i->image }}" alt="image" />
                                </td>
                                <th> {{ $i->end_time }} </th>
                                <th> {{ $i->created_at }} </th>
                                <th>
                                    {!! $i->Active == 0
                                        ? '<label class="badge badge-danger">Finish</label>'
                                        : '<label class="badge badge-success">Not Finish</label>' !!}
                                </th>
                                <td>
                                    <form action="{{ route('Hero.destroy', [$i->id]) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-rounded ">Delete</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="div-add-hero">
        <div id="card-add-hero">
            <div class=" ">
                <div class="card">
                    <div class="card-body">
                        <h3>Add New Declaration</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="forms-sample" method="POST" action="{{ route('Hero.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label for="exampleInputName1">End Time</label>
                                <input type="date" class="form-control" id="exampleInputName1" name="end_time"
                                    placeholder="Name">
                            </div>


                            <input type="file" style="display: none" name="image" id="image"
                                class="file-upload-default">

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
                    </div>


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a  class="btn btn-light" onclick="ShowHiddenDiv()">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        const form = document.getElementById("div-add-hero");

        function ShowHiddenDiv() {
            console.log(form.style.display == "flex");
            form.style.display = form.style.display == "flex" ? "none" : "flex";
        }
    </script>
    <style>
        #div-add-hero {
            width: 100%;
            height: 100vh;
            background-color: #00000060;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            display: none;
            justify-content: center;
            align-items: center;
        }

        #card-add-hero {
            width: 40%;
            height: 60vh;
            background-color: #fff;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 10;
            align-items: center
        }

        #card-add-hero h3 {
            color: #34af32;
            font-weight: bold;
            font-size: 22px;
        }
    </style>
@endsection
