@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>{{$product->name}}</h1></div>

                    <div class="card-body">
                        <p>{{$product->description}}</p>
                        <p>&euro;{{$product->price}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
