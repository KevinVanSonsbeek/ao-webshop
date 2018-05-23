@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                    @foreach($categories as $category)
                        <li>{{ $category->name }}</li>
                            <ul>
                            @foreach($category->products as $product)
                                <li><a href="/product/{{$product->id}}">{{ $product->name }}</a></li>
                            @endforeach
                            </ul>
                    @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
