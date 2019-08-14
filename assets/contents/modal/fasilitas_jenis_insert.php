<div class="modal fade" id="modal_form_update" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Insert Jenis Fasilitas</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form  method="POST" id="form" class="form-horizontal was-validated">
                    <!-- <input type="hidden" value="" name="id"/>  -->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label">Label Jenis</label>
                            <input type="text" id="ket_jenis" class="form-control" required name="ket_jenis">
                            <small class="form-control-feedback">  </small> 
                        </div>
                        <div class="form-group">
                           <div class="card-body">
                            <h4 class="card-title">Unggah Gambar</h4>
                            <div class="dropify-wrapper"><div class="dropify-message"><span class="file-icon"></span> <p>Drag and drop a file here or click</p><p class="dropify-error">Ooops, something wrong appended.</p></div><div class="dropify-loader"></div><div class="dropify-errors-container"><ul></ul></div>

                            <input type="file" name="img" id="img" class="dropify" required>

                            <button type="button" class="dropify-clear">Remove</button><div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p><p class="dropify-infos-message">Drag and drop or click to replace</p></div></div></div></div>
                        </div>
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
