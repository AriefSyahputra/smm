<div class="modal fade" id="AddProductModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD PRODUCT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="submit_product" id="submit_product">
                <input type="hidden" name="product_id" id="product_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <select class="form-control form-control-sm" name="searchProduct" id="searchProduct"></select>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" class="form-control form-control-sm" name="sku" id="sku" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" id="name" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control form-control-sm" name="lokasi" id="lokasi" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control form-control-sm" name="stock" id="stock" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="text" class="form-control form-control-sm" name="quantity" id="quantity" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-success" id="btn_add">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
