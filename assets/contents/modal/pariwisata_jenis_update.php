<div class="modal fade" id="modal_form_update" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Sub Jenis Wisata</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form  method="POST" id="form" class="form-horizontal was-validated">
                    <!-- <input type="hidden" value="" name="id"/>  -->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Label Jenis</label>
                            <input type="text" id="ket_jenis" class="form-control" required name="ket_jenis">
                            <div class="text-danger ket_jenis" ></div>
                        </div>
                        <div class="form-group">
                           <div class="card-body">
                            <h4 class="card-title">Unggah Gambar</h4>
                            <input type="file" name="img_tmp" id="img" class="dropify" required>
                            <div>
                            <img src="" class="rounded image_view" id="avatar" alt="..." style = "width:200px;">
                            </div>
                        </div>
                        <div class="text-danger img" ></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="save">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="cancel">Cancel</button>
                </div>
            </form>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
