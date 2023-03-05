
@extends('dashboard.sidebar')
@section('content')

<div class="home-content">
    <div class="container">
        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Invoice
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        ID: {{ $bill['id'] }}
                    </small>
                </h1>
            </div>
            <div class="container px-0">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <hr>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr class="text-white">
                                    <th class="opacity-2">#</th>
                                    <th>Description</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td>1</td>
                                    <td>Doctor Charge</td>
                                    <td class="text-secondary-d2">$ {{ $bill['doctor_charge'] }}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Test Charge</td>
                                    <td class="text-secondary-d2">$ {{  $bill['test_charge'] }}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Medical Charge</td>
                                    <td class="text-secondary-d2">$ {{  $bill['medical_charge'] }}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Room Charge</td>
                                    <td class="text-secondary-d2">$ {{  $bill['room_charge'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-7">
                                {{  $bill['notes'] }}
                                </div>

                                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            SubTotal
                                        </div>
                                        <div class="col-5">
                                            <span class=""> $ {{ $subtotal }}</span>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            Tax (14%)
                                        </div>
                                        <div class="col-5">
                                            <span class="">$ {{ $tax }}</span>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            Total Amount
                                        </div>
                                        <div class="col-5">
                                            <span class=""> $ {{ $total}} </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                                @if (Auth::user()->type == 'employee')
                                <div class="row d-print-none">
                                    <div class="col-11">
                                            <form action="{{ route('invoices.update',[$bill['id']]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="id" value="{{ $bill['id'] }}">
                                                <input class=" col-4 btn btn-success float-end " type="submit" value="Pay Now">

                                            </form>
                                    </div>
                                </div>
                                @else
                                <div class="row d-print-none">
                                    <div class="col-11">
                                        <button class="col-4 btn btn-primary float-end " onClick="window.print()">Print Invoice</button>
                                    </div>
                                </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
