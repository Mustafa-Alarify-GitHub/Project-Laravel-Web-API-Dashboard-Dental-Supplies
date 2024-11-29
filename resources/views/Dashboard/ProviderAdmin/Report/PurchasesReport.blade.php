@extends('layout/Layout')
@section('content')
    <div class="card-body">
        <h4 class="card-title">Report Purchases </h4>
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

        <div style="width: 95%; display: flex;justify-content: space-between;align-items: center">


            <form action="{{ route('Purchases.show') }}" method="POST" class="form">
                @method('post')
                @csrf

                <div style="display: flex;gap: 10px;align-items: center;color: #000;font-weight: bold;">
                    <label for="">Start Time</label>
                    <input type="date" name="Start_time" value="{{ $Start_time }}">
                </div>

                <div style="display: flex;gap: 10px;align-items: center;color: #000;font-weight: bold;">
                    <label for="">End Time</label>
                    <input type="date" name="End_time" value="{{ $End_time }}">
                </div>

                <button type="submit" class="btn btn-info m-2" style="width: 150px;">Filter</button>

            </form>

            <form action="{{ route('Purchases.PDF') }}" method="POST">
                @csrf
                <input type="date" name="Start_time" value="{{ $Start_time }}"
                    style="display: none">
                <input type="date" name="End_time" value="{{ $End_time }}"
                    style="display: none">

                <button type="submit" class="btn btn-google btn-icon-text"> PDF <i
                        class="mdi mdi-printer btn-icon-append"></i></button>
            </form>

            
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Image </th>
                    <th> name </th>
                    <th> Counter </th>
                    <th> price Sell </th>
                    <th> price Buy </th>
                    <th> total Profit </th>
                    <th> Date </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>
                        <td class="py-1">
                            <img src="{{ asset($i->image) }}" />
                        </td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->counter }}</td>
                        <td>{{ $i->price_sales }}</td>
                        <td>{{ $i->price_buy }}</td>
                        <td>{{ $i->Balance }}</td>
                        <td>{{ $i->created_at }}</td>


                    </tr>
                @endforeach
                <tr style="background-color: rgba(128, 128, 128, 0.514)">
                    <td colspan="3">
                        <h4>Total Price</h4>
                    </td>
                    <td colspan="4">
                        <h4>{{ $total_Balance }}</h4>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <style>
        .form {
            width: 90%;
            display: flex;
            justify-content: space-around;
            flex-direction: row;
            align-items: center;
        }
    </style>
@endsection
