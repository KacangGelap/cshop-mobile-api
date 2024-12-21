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
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-dark">
                            <thead class="text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Products</th>
                                    <th>Stock</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($product as $p)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$p->product}}</td>
                                    <td>{{$p->stock}}</td>
                                    <td>{{$p->category->category}}</td>
                                    <td>
                                        <div class="justify-content-around">
                                            <a class="btn btn-secondary" href=""><i class="bi-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            {{-- ngitung jumlah total permohonan  --}}
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection