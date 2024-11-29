@extends('layout/Layout')
@section('content')
    <div class="col-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Balance Foe Clinic</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                <form class="forms-sample" action="{{ route('Balance.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="exampleSelectGender">Clinic</label>
                        <select class="form-control" id="exampleSelectGender" style="display: none">
                            @foreach ($data as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                            @endforeach
                        </select>

                        <input type="hidden" id="inputValue" name="clinic_id" value="{{ old('clinic_id') }}">

                        <input type="text" autocomplete="off" class="InputSearch" name="clinic" value="{{ old('clinic') }}"
                            onkeyup ="OnChangeInput(event.target.value)" id="inputSearch" onfocus="OpendivData(true)"
                            onblur="OpendivData(false)">


                        <div class="div-data" id="div-data">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputCity1">Balance</label>
                        <input type="number" name="balance" class="form-control" value="{{ old('balance') }}"
                            id="exampleInputCity1" placeholder="Balance">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Send</button>
                </form>
            </div>
        </div>

    </div>
    <script src="assets/js/FliterClinic.js"></script>
@endsection
<style>
    .content-data {
        padding: 10px 5px;
        color: #000;
        cursor: pointer;
        background-color: transparent;
        transition: .3s;
    }

    .content-data:hover {
        background-color: #9999998e;
    }

    .InputSearch {
        width: 100%;

        background-color: #9999992f;
        border: none;
        font-size: 22px;
        padding: 5px;
    }

    .div-data {
        max-height: 0;
        width: 100v%;
        /* transition: .5s; */
        background-color: #9999992f;
        border: none;
        font-size: 22px;
        padding: 5px;
        overflow-y: scroll;
    }

    .div-data::-webkit-scrollbar {
        width: 5px;
    }

    .div-data::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .div-data::-webkit-scrollbar-thumb {
        background: #00000044;
        border-radius: 10px;
    }

    .div-data::-webkit-scrollbar-thumb:hover {
        transition: .2s;
        background: #00000084;
    }
</style>
