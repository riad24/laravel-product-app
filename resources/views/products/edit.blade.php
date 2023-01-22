
@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Product') }}</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="card shadow mb-5" action="{{ route('product.update',$product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="">{{ __('Name') }} <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ old('name',$product->name) }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Price') }} <span class="text-danger">*</span></label>
                        <input type="text" name="price" value="{{ old('price',$product->price) }}" class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Quantity') }} <span class="text-danger">*</span></label>
                        <input type="text" name="quantity" value="{{ old('quantity',$product->quantity) }}" class="form-control @error('quantity') is-invalid @enderror">
                        @error('quantity')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Features') }} <span class="text-danger">*</span></label>
                        <select id="features" name="features" class="form-control @error('features') is-invalid @enderror">
                            @foreach(trans('feature') as $key => $feature)
                                <option value="{{ $key }}" {{ (old('features',$product->productDetail->features) == $key) ? 'selected' : '' }}>{{ $feature }}</option>
                            @endforeach
                        </select>
                        @error('features')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('Description') }}</label>
                        <textarea name="description" id="" cols="30" rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description',optional($product->productDetail)->description) }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="customFile" >{{ __('Image') }}</label>
                        <input type="file" name="image" class="form-control" id="customFile" />
                        @error('image')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection
