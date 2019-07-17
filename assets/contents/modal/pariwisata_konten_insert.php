<div class="modal fade" id="modal_form_update" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Insert Konten Pariwisata</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="POST" id="form" class="form-horizontal was-validated">
                    <!-- <input type="hidden" value="" name="id"/>  -->
                    <div class="form-body row">

                        <div class="col-lg-12 row">
                            <h3 class="box-title m-t-5 col-lg-11">Kategori</h3>
                            <hr class="m-t-0 m-b-12  col-lg-11">

                            <div class="form-group col-lg-3">
                                <label>Kategori</label>
                                <select name="id_jenis" id="id_jenis" class="form-control form-control-line">
                                </select>
                                <a id="msg_id_jenis" style="color: red;"></a>
                            </div>

                            <div class="form-group col-lg-3">
                                <label>Sub Kategori</label>
                                <select name="id_sub" id="id_sub" class="form-control form-control-line">
                                    <!-- <option value="FSKS100001">Apotek</option> -->
                                    <!-- <option value="FSKS100002">Laboratorium</option> -->
                                </select>
                                <a id="msg_id_sub" style="color: red;"></a>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Nama Pariwisata</label>
                                <input name="ket_main" id="ket_main" class="form-control form-control-line">
                                <a id="msg_nama_faskes" style="color: red;"></a>
                            </div>

                        </div>

                        <div class="col-lg-12 row" id="form_alamat">
                            <h3 class="box-title m-t-5 col-lg-11">Alamat</h3>
                            <button type="button" onclick="add_form_alamat()" class="btn btn-info " style="">
                                <i class="ti-plus text"></i>
                            </button>
                            <hr class="m-t-0 m-b-12  col-lg-11">

                            <div class="col-lg-12 row" id="form_alamat0">
                                <div class="form-group col-lg-4">
                                    <label>(Latitude &amp; Longitude)</label>
                                    <input type="text" name="loc[]" id="loc_faskes"
                                        class="form-control form-control-line"></input>
                                    <a id="msg_loc_faskes" style="color: red;"></a>
                                </div>
                                <div class="form-group col-lg-7">
                                    <label>Alamat Lengkap</label>
                                    <input name="alamat[]" id="alamat_faskes"
                                        class="form-control form-control-line"></input>
                                    <a id="msg_alamat_faskes" style="color: red;"></a>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-12 row">
                            <h3 class="box-title m-t-5 col-lg-12">Tentang</h3>
                            <hr class="m-t-0 m-b-12  col-lg-11">
                            <div class="form-group col-lg-6">
                                <label>Deskripsi</label>
                                <textarea name="alamat_faskes" id="alamat_faskes" class="form-control form-control-line"
                                    rows="8"></textarea>
                                <a id="msg_alamat_faskes" style="color: red;"></a>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="form-group  col-lg-12">
                                    <label>Telepon</label>
                                    <input type="text" name="tlp_faskes" id="tlp_faskes"
                                        class="form-control form-control-line">
                                    <a id="msg_tlp_faskes" style="color: red;"></a>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Website</label>
                                    <input type="text" name="web_faskes" id="web_faskes"
                                        class="form-control form-control-line">
                                    <a id="msg_web_faskes" style="color: red;"></a>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Email</label>
                                    <input type="text" name="web_faskes" id="web_faskes"
                                        class="form-control form-control-line">
                                    <a id="msg_web_faskes" style="color: red;"></a>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-12 row">
                            <h3 class="box-title m-t-5 col-lg-12">Unggah Gambar</h3>
                            <hr class="m-t-0 m-b-12  col-lg-11">
                            <div class="form-group col-lg-12">
                                <div class="form-group">
                                    <div class="card-body">
                                        <h4 class="card-title">Unggah Gambar</h4>
                                        <input type="file" name="img" id="img" class="dropify" multiple required>
                                        <div id="image_preview">
                                        </div>
                                    </div>
                                    <div class="text-danger img"></div>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="save">Save</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                id="cancel">Cancel</button>
                        </div>

                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->