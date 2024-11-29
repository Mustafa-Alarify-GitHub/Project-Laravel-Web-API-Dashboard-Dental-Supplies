@extends('layout/Layout')
@section('search')
    {{-- <form class="d-flex align-items-center h-100" action="{{ route('Search') }}" method="post">

        @csrf
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control bg-transparent border-0" name="txt" placeholder="Search Users">
        </div>
    </form> --}}
@endsection
@section('content')
    <div class="card-body">
        <h4 class="card-title">All Products Table</h4>
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
        <div class="alert alert-danger" id="alert">
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
                    <th> name </th>
                    <th> type </th>
                    <th> price Sell </th>
                    <th> price Buy </th>
                    <th colspan="2"> Event </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>
                        <td class="py-1">
                            <img src="{{ $i->image }}" />
                        </td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->modeType }}</td>
                        <td>{{ $i->price_buy }}</td>
                        <td>{{ $i->price_sales }}</td>
                        <td>
                            <form action="{{ route('update.Product', [$i->id]) }}" method="post">
                                @method('put')
                                @csrf
                                <button type="submit" class="btn btn-info btn-rounded ">Acceptable</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('delete.Product', [$i->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-rounded ">UnAcceptable</button>
                            </form>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
