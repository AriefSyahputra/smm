<div class="modal fade" id="AddDepartementModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD NEW DEPARTEMENT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="submit_departement" id="submit_departement" autocomplete="false">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="name" class="form-label">Departement Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success" id="btn_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
