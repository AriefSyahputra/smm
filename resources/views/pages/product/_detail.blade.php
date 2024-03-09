{{-- <div class="modal fade" id="EditProductModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="update_product" id="update_product" autocomplete="false">
                <input type="hidden" class="sku" name="sku">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_sku" class="form-label">SKU</label>
                            <input type="text" class="form-control" name="detail_sku" id="detail_sku" autocomplete="off" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="detail_name" id="detail_name" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" name="detail_lokasi" id="detail_lokasi" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_satuan" class="form-label">Satuan</label>
                            <select class="form-select" name="detail_satuan" id="detail_satuan">
                                <option value="" disabled selected>-- Select --</option>
                                <option value="lusin">Lusin</option>
                                <option value="pak">Pak</option>
                                <option value="box">Box</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" name="detail_stock" id="detail_stock" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="status_product" class="form-label">Status Departement</label>
                            <select class="form-select" name="detail_status" id="detail_status">
                                <option value="" disabled selected>-- SELECT --</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success" id="btn_update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/product') }}">Product</a></li>
                    <li class="breadcrumb-item">{{ $data->name }}</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail - {{ $data->name }}</h5>
                            <form enctype="multipart/form-data" name="update_product" id="update_product" autocomplete="false">
                                <input type="hidden" class="sku" name="sku" id="sku" value="{{ $data->sku }}">
                                <div class="row mb-3">
                                    <div class="col-sm-5">
                                        <label class="col-form-label">SKU</label>
                                        <input type="text" class="form-control form-control-sm" value="{{ $data->sku }}" disabled>
                                    </div>
                                    <div class="col-sm-5">
                                        <label class="col-form-label">Stock</label>
                                        <input type="text" class="form-control form-control-sm" value="{{ $data->stock }}" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-5">
                                        <label class="col-form-label">Name</label>
                                        <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ $data->name }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-5">
                                        <label class="col-form-label">Lokasi</label>
                                        <input type="text" class="form-control form-control-sm" name="lokasi" id="lokasi" value="{{ $data->lokasi }}">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-5">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <select class="form-select form-select-sm" name="satuan" id="satuan">
                                            <option value="lusin" {{ $data->satuan == 'lusin' ? 'selected' : '' }}>Lusin</option>
                                            <option value="pak" {{ $data->satuan == 'pak' ? 'selected' : '' }}>Pak</option>
                                            <option value="box" {{ $data->satuan == 'box' ? 'selected' : '' }}>Box</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select form-select-sm" name="status" id="status">
                                            <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-sm btn-success" id="btn_update">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- History Stock --}}
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">History Stock</h5>
                            <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100 active" id="purchase-tab" data-bs-toggle="tab" data-bs-target="#purchase" type="button" role="tab" aria-controls="purchase" aria-selected="true">Purchase</button>
                                </li>
                                <li class="nav-item flex-fill" role="presentation">
                                    <button class="nav-link w-100" id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">Order</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="purchase" role="tabpanel" aria-labelledby="purchase-tab">
                                    <table class='table table-hover nowrap w-100 mt-5' id="dt_history_purchase">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Purchase Number</th>
                                                <th scope="col">Purchase Date</th>
                                                <th scope="col">Suplier</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                                    <table class='table table-hover nowrap w-100 mt-5' id="dt_history_order">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Order Number</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Employe</th>
                                                <th scope="col">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script src="{{url('/js/product.js')}}" type="application/javascript"></script>
@endsection
