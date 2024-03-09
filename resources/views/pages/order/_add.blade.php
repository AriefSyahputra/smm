@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/order') }}">Order</a></li>
                    <li class="breadcrumb-item">Add</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ADD NEW ORDER</h5>
                            <form enctype="multipart/form-data" name="submit_order" id="submit_order" autocomplete="false">
                                <input type="hidden" name="employee_id" id="employee_id">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Employee NIK</label>
                                        <select class="form-control form-control-sm" name="searchEmployee" id="searchEmployee"></select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Employee Name</label>
                                        <input type="text" class="form-control form-control-sm" name="employee_name" id="employee_name" disabled>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Departement</label>
                                        <input type="text" class="form-control form-control-sm" name="departement" id="departement" disabled>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Order Date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="order_date" id="order_date">
                                            <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar-check"></i></span>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12 mb-2">
                                        <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModal"><i class="bi bi-plus"></i> Add Product</a>
                                    </div>
                                    <div class="col-sm-12">
                                        <table class='table table-hover nowrap w-100' id="dt_order_product">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Lokasi</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-sm btn-success" id="btn_submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('pages.order._add_product')
@endsection

@section('js')
    <script src="{{url('/js/order.js')}}" type="application/javascript"></script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('#order_date').datepicker({
                    format: 'mm-dd-yyyy',
                    language: "id",
                    orientation: "bottom right",
                    autoclose: true,
                    todayHighlight: true
                });
            });
        });
    </script>
@endsection
