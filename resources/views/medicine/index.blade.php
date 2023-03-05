@extends('dashboard.sidebar')

@section('content')

<div class="home-content">
    <div class="container">
        <br>
        <h1 class="text-center"> <span class="text-primary">Add</span>/<span class="text-info">Update</span>/<span class="text-danger">Delete</span> Medicine</h1>
        <br>
        <form action="{{ route('managemedic') }}" method="POST">
            @csrf
            @method('POST')
            <div class="row mb-1">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Medicine name') }}</label>
                <div class="col-md-6">
                    <input id="medicine_name" type="text" class="form-control" name="name"  required autocomplete="medicine_name">
                </div>
            </div>
            <input id="medicine_id" type="hidden" class="form-control" name="id">
            <div class="row mb-1">
                <span class="col-md-4 col-form-label text-md-end"></span>
                <div class="col-md-6" id="searchResult">
                </div>
            </div>
            <div class="row mb-3">
                <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Medicine code') }}</label>
                <div class="col-md-6">
                    <input id="medicine_code" type="text" class="form-control" name="code"   autocomplete="code">
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Medicine price') }}</label>
                <div class="col-md-6">
                    <input id="medicine_price" type="number" class="form-control" name="price"   autocomplete="price">
                </div>
            </div>
            <div class="row mb-3">
                <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Medicine quantity') }}</label>
                <div class="col-md-6">
                    <input id="medicine_quantity" type="number" class="form-control" name="quantity"   autocomplete="quantity">
                </div>
            </div>
            <div class="row mb-3">
                <label for="limit" class="col-md-4 col-form-label text-md-end">{{ __('Medicine limit') }}</label>
                <div class="col-md-6">
                    <input id="medicine_limit" type="number" class="form-control" name="limit"   autocomplete="limit">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-4 ">
                {{-- <div class="col-md-6 offset-md-4 justify-content-evenly"> --}}
                    <button type="submit" class="btn btn-primary col-3" name="action" value="add">
                        {{ __('Add') }}
                    </button>
                    <button type="submit" class="btn btn-info col-3" name="action" value="update">
                        {{ __('Update') }}
                    </button>
                    <button type="submit" class="btn btn-danger col-3" name="action" value="delete">
                        {{ __('Delete') }}
                    </button>
                    <button type="reset" class="btn btn-dark col-2">
                        {{ __('Clear') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
