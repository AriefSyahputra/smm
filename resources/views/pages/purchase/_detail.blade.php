@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/purchase') }}">Purchase</a></li>
                    <li class="breadcrumb-item">Detail</li>
                    <li class="breadcrumb-item">{{ $data->purchase_no }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">DETAIL PURCHASE</h5>
                            <form enctype="multipart/form-data" name="submit_purchase" id="submit_purchase" autocomplete="false">
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Purchase Number</label>
                                        <input type="text" class="form-control form-control-sm" name="purchase_number" id="purchase_number" value="{{ $data->purchase_no }}" disabled>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Purchase Date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="purchase_date" id="purchase_date" value="{{ $data->purchase_date }}" disabled>
                                            <span class="input-group-text" id="basic-addon3"><i class="bi bi-calendar-check"></i></span>
                                        </div>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-sm-6">
                                        <label class="col-form-label">Suplier Name</label>
                                        <input type="text" class="form-control form-control-sm" name="purchase_suplier" id="purchase_suplier" value="{{ $data->suplier }}" disabled>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-12">
                                        <table class='table table-hover nowrap w-100' id="dt_detail_purchase_product">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">SKU</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Lokasi</th>
                                                    <th scope="col">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('pages.purchase._add_product')
@endsection

@section('js')
    <script src="{{url('/js/purchase.js')}}" type="application/javascript"></script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('#purchase_date').datepicker({
                    format: 'mm-dd-yyyy',
                    language: "id",
                    orientation: "bottom right",
                    autoclose: true,
                });
            });
        });
    </script>
@endsection
