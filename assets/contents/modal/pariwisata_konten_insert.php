<div class="modal fade" id="modal_form_update" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Insert Konten Pariwisata</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form method="POST" id="form" class="form-horizontal was-validated"  enctype="multipart/form-data">
                    <!-- <input type="hidden" value="" name="id"/>  -->
                    <div class="form-body row">

                        <div class="col-lg-12 row">
                            <h3 class="box-title m-t-5 col-lg-11">Kategori</h3>
                            <hr class="m-t-0 m-b-12  col-lg-11">

                            <div class="form-group col-lg-6">
                                <label>Kategori</label>
                                <select name="id_jenis" id="id_jenis" class="form-control form-control-line" required>
                                </select>
                                <div class="text-danger id_jenis"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Sub Kategori</label>
                                <select name="id_sub" id="id_sub" class="form-control form-control-line" required>
                                    <!-- <option value="FSKS100001">Apotek</option> -->
                                    <!-- <option value="FSKS100002">Laboratorium</option> -->
                                </select>
                                <div class="text-danger id_sub"></div>
                            </div>

                            <div class="form-group col-lg-12    ">
                                <label>Nama Pariwisata</label>
                                <input name="ket_main" id="ket_main" class="form-control form-control-line" required>
                                <div class="text-danger ket_main"></div>
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
                                        class="form-control form-control-line" required></input>
                                        <div class="text-danger loc"></div>
                                </div>
                                <div class="form-group col-lg-7">
                                    <label>Alamat Lengkap</label>
                                    <input name="alamat[]" id="alamat_faskes"
                                        class="form-control form-control-line" required></input>
                                        <div class="text-danger alamat"></div>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-12 row">
                            <h3 class="box-title m-t-5 col-lg-12">Tentang</h3>
                            <hr class="m-t-0 m-b-12  col-lg-11">
                            <div class="form-group col-lg-6">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control form-control-line"
                                    rows="8"required></textarea>
                                    <div class="text-danger deskripsi"></div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="form-group  col-lg-12">
                                    <label>Telepon</label>
                                    <input type="text" name="tlp" id="tlp"
                                        class="form-control form-control-line"required>
                                        <div class="text-danger tlp"></div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Website</label>
                                    <input type="text" name="website" id="website"
                                        class="form-control form-control-line"required>
                                        <div class="text-danger website"></div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email"
                                        class="form-control form-control-line"required>
                                        <div class="text-danger email"></div>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-12 row">
                            <h3 class="box-title m-t-5 col-lg-12">Unggah Gambar</h3>
                            <hr class="m-t-0 m-b-12  col-lg-11">
                            <div class="form-group col-lg-12">
                                <div class="form-group">
                                    <div class="card-body">
                                        <!-- <h4 class="card-title">Unggah Gambar</h4> -->
                                        <input type="file" name="img[]" id="img" class="dropify" multiple="multiple" required>
                                        <div id="image_preview">
                                        </div>
                                    </div>
                                    <div class="text-danger img"></div>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer col-lg-12">
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