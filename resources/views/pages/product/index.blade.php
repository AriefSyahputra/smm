@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">LIST OF PRODUCT</h5>
                            <div class="col-lg-12 mb-4">
                                <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModal"><i class="bi bi-plus"></i> New Product</a>
                            </div>
                            <table class='table table-hover nowrap w-100' id="dt_product">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">SKU</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">lokasi</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('pages.product._add')
    {{-- @include('pages.product._detail') --}}
@endsection

@section('js')
    <script src="{{url('/js/product.js')}}" type="application/javascript"></script>
@endsection
