@extends('layouts.app')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Products') }}</h1>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="form-row justify-content-between">
                <div class="col-md-2">
                    <a href="{{ route('product.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> {{ __('Add Product') }}</a>

                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-response">
                <table class="table">
                    <thead>
                    <tr>
                        <th>{{ __('#') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <th>{{ __('Features') }}</th>
                        <th width="150px">{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    @if(!blank($products))
                    <tbody>
                    @php($id=1)
                     @foreach($products as $product)
                        <tr>
                        <td>{{$id++}}</td>
                        <td><figure class="avatar"><img class="image-rounded-circle" src="{{ $product->image }}" alt=""></figure></td>
                        <td>{{$product->name}}</td>
                        <td>{!!  \Illuminate\Support\Str::of(optional($product->productDetail)->description)->limit(30) !!}</td>
                        <td>{{ number_format($product->price,2) }}</td>
                        <td>{{ number_format($product->quantity,2) }}</td>
                        <td>{{ $product->myFeature }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', $product) }}" class="btn btn-success">{{ __('Edit') }}</a>

                                <form class="float-left pl-2" action="{{ route('product.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-icon btn-danger delete" data-toggle="tooltip" data-placement="top" title="Delete">{{ __('Delete') }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-md-6">
                    <p>    {!! __('Showing') !!}
                        <span>{{ $products->firstItem() }}</span>
                        {!! __('to') !!}
                        <span>{{ $products->lastItem() }}</span>
                        {!! __('of') !!}
                        <span>{{ $products->total() }}</span>
                        {!! __('results') !!}</p>
                </div>
                <div class="col-md-2">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
