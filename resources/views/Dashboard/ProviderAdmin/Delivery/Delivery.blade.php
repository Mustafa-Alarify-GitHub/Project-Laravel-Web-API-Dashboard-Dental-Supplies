@extends('layout/Layout')
@section('search')

@endsection
@section('content')
    <div class="card-body">
        <h4 class="card-title">All Delivery Table</h4>
      
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> name </th>
                    <th> email </th>
                    <th> Events </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr>
                      
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->email }}</td>
                        <td>{{ $i->status }}</td>
        

                        <td>
                            <form action="{{ route('Delivery.destroy', [$i->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>

                        </td>
                        <td> <a href="{{ route('Delivery.edit', [$i->id]) }}" class="btn btn-warning">update</a></td>

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection
