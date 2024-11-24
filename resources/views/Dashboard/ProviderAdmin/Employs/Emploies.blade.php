@extends('layout/Layout')

@section('content')
    <div class="card-body">
        <h4 class="card-title">All Clinics Table</h4>
        <a href="{{ route('Employ.create') }}" onclick="ShowHiddenDiv()" id="btn-Add" class="btn btn-inverse-success btn-fw">
            Add New Employ
        </a>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> name </th>
                    <th> Email </th>
                    <th> phone Number </th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>

                        <td>{{ $i->name }}</td>
                        <td>{{ $i->email }}</td>
                        <td>{{ $i->phone }}</td>
                        <td>
                            <form action="{{ route('Employ.destroy', [$i->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-rounded btn-fw">Delete</button>

                            </form>
                        </td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>


@endsection
