@extends('layout/Layout')

@section('search')
    <form class="d-flex align-items-center h-100" action="{{ route('Search') }}" method="post">

        @csrf
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
                <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control bg-transparent border-0" name="txt" placeholder="Search Users">
        </div>
    </form>
@endsection
@section('content')
    <div class="card-body">
        <h4 class="card-title">All Supplier Table</h4>
        @if (session()->has('error'))
        <div class="alert alert-success" id="alert">
            {{ session('error') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById("alert").style.display = "none";
            }, [2000]);
        </script>
    @endif
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th> User </th>
                    <th> name </th>
                    <th> Name Company </th>
                    <th> Email </th>
                    <th> phone Number </th>
                    <th> Delete </th>
                    <th> Show </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>
                        <td class="py-1">
                            <img src="{{ $i->image }}" />
                        </td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->name_company }}</td>
                        <td>{{ $i->email }}</td>
                        <td>{{ $i->phone }}</td>
                        <td>
                            <form action="{{ route('deleteUser', [$i->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-rounded ">Delete</button>

                            </form>
                        </td>
                        <td>
                            <a href={{ route('product.show', [$i->id]) }} class="btn btn-primary btn-rounded ">Products
                                </a>

                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
