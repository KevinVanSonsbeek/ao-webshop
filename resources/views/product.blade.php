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
                        {{ Form::open(array('url' => "/cart/add")) }}
                            <input type="hidden" name="item_id" value="{{$product->id}}">
                            <input type="submit" value="Add to cart">
                        {{ Form::close() }}
                    </div>
                    <div class="card-footer">
                        <ul>
                        @foreach($product->categories as $category)
                                <li><a href="/category/{{$category->name}}">{{ $category->name }}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
