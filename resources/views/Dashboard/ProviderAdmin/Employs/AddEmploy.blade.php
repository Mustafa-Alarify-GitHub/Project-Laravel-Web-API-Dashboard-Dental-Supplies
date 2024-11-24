@extends('layout/Layout')

@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add New Employ</h4>
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
        <form class="forms-sample" action="{{ route('Employ.store') }}" method="POST">
            @csrf
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputUsername2" placeholder="Username">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail2" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
            <div class="col-sm-9">
              <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
            </div>
          </div>
        
         
          <button type="submit" class="btn btn-primary mr-2">Add</button>
        </form>
      </div>
    </div>
  </div>
@endsection