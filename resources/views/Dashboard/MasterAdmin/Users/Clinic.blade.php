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
        <h4 class="card-title">All Clinics Table</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> User </th>
                    <th> name </th>
                    <th> Name Company </th>
                    <th> Email </th>
                    <th> phone Number </th>
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
                        {{-- <td>
                             <form action="{{ route('deleteUser', [$i->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-rounded btn-fw">Delete</button>

                            </form>
                        </td> --}}

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
