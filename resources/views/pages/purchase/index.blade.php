@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Purchase</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">Purchase</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">LIST OF PURCHASE</h5>
                            <div class="col-lg-12 mb-4">
                                <a class="btn btn-sm btn-primary" href="{{ url('purchase/add') }}"><i class="bi bi-plus"></i> New Purchase</a>
                            </div>
                            <table class='table table-hover nowrap w-100' id="dt_purchase">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Purchase Number</th>
                                        <th scope="col">Purchase Date</th>
                                        <th scope="col">Suplier</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('pages.product._add')
@endsection

@section('js')
    <script src="{{url('/js/purchase.js')}}" type="application/javascript"></script>
@endsection
