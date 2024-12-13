@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="col-md-12">
            <div class="card text-bg-dark">
                <div class="card-header">
                    {{__('Products')}}
                </div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{route('product.create')}}">{{__('Create Product')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection