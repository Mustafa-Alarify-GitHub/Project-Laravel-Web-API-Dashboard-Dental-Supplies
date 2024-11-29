@extends('layout/Layout')
@section('content')
    <div class="col-8 grid-margin stretch-card " style="background-color: ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Product</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" action="{{ route('Product.Supplies.update', [$data->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                            id="exampleInputName1" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Mode Type</label>
                        <input type="text" name="modeType" value="{{ $data->modeType }}" class="form-control"
                            id="exampleInputEmail3" placeholder="modeType">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Price Buy</label>
                        <input type="number" name="price_buy" value="{{ $data->price_buy }}" class="form-control"
                            id="exampleInputEmail3" placeholder="Price Buy">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Price Sell</label>
                        <input type="number" name="price_sales" value="{{ $data->price_sales }}" class="form-control"
                            id="exampleInputEmail3" placeholder="Price Sell">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail3">Counter</label>
                        <input type="number" name="counter" value="{{ $data->counter }}" class="form-control"
                            id="exampleInputEmail3" placeholder="Counter">
                    </div>

                  


                    <div class="form-group">

                        <label for="exampleTextarea1">Description</label>
                        <textarea class="form-control" id="exampleTextarea1" name="description" rows="4">{{ $data->description }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>

                </form>
            </div>
        </div>
    @endsection
