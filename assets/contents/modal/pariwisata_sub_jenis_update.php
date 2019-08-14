<div class="modal fade" id="modal_form_update" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Update Jenis Wisata</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal was-validated">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Sub Jenis</label>
                            <div class="col-md-9">
                                <select name="id_jenis" id="ket_jenis_select" class="form-control" required>
    <!--                                     <option value="">--Select Sub Jenis--</option>
                                        <option value="1">A</option>
                                        <option value="2">B</option> -->
                                </select>
                                <div class="text-danger id_jenis" ></div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sub Jenis</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="ket_sub_jenis" rows="3"required></textarea>
                                <span class="help-block"></span>
                            </div>
                            <div class="text-danger ket_sub_jenis" ></div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
                <button type="button"  onclick="update_save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->