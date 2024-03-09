<div class="modal fade" id="AddEmployeeModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD NEW EMPLOYEE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="submit_employee" id="submit_employee" autocomplete="false">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="status_product" class="form-label">Departement</label>
                            <select class="form-select" name="departement" id="departement"></select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" id="nik" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="gender">
                                <option value="" disabled selected>-- Select --</option>
                                <option value="Laki-laki">Laki - laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="name" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" autocomplete="off" required autofocus>
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
