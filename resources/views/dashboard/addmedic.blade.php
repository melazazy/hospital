@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">
        <br>
        <h2 class="text-center">Add New Medicine</h2>
        <form action="{{ route('medicine.edit',[1]) }}" method="POST">
            @csrf
            @method('POST')
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Medicine name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="email" class="form-control" name="name"  required autocomplete="name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Medicine code') }}</label>
                <div class="col-md-6">
                    <input id="code" type="text" class="form-control" name="code"  required autocomplete="code">
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Medicine price') }}</label>
                <div class="col-md-6">
                    <input id="price" type="number" class="form-control" name="price"  required autocomplete="price">
                </div>
            </div>
            <div class="row mb-3">
                <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Medicine quantity') }}</label>
                <div class="col-md-6">
                    <input id="quantity" type="number" class="form-control" name="quantity"  required autocomplete="quantity">
                </div>
            </div>
            <div class="row mb-3">
                <label for="limit" class="col-md-4 col-form-label text-md-end">{{ __('Medicine limit') }}</label>
                <div class="col-md-6">
                    <input id="limit" type="number" class="form-control" name="limit"  required autocomplete="limit">
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary col-12">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
