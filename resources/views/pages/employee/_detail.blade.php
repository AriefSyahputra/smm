<div class="modal fade" id="DetailEmployeeModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETAIL EMPLOYEE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" name="update_employee" id="update_employee" autocomplete="false">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_departement" class="form-label">Departement</label>
                            <select class="form-select" name="detail_departement" id="detail_departement"></select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" name="detail_nik" id="detail_nik" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="detail_name" id="detail_name" autocomplete="off" required autofocus>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_gender" class="form-label">Gender</label>
                            <select class="form-select" name="detail_gender" id="detail_gender">
                                <option value="" disabled selected>-- Select --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label for="detail_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="detail_phone" id="detail_phone" autocomplete="off" required autofocus>
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
</div>
