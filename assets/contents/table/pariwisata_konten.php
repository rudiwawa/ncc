<div class="card">
    <div class="card-body">
    <button class="btn  waves-effect waves-light btn-primary add_data" style="position: fixed; bottom: 80px;   right: 20px; padding: 18.5px;
    z-index: 10;" type="button" onclick="insert_modal()"><i class="fa fa-plus"></i></button>
        <h4 class="card-title">Sub Jenis Pariwisata</h4>
        <h6 class="card-subtitle">Data table example</h6>
        <div class="table-responsive m-t-40">
            <table id="table_pariwisata_konten" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 300px;">Nama</th>
                        <th>Alamat</th>
                        <th>Official Account</th>
                        <th style="width: 300px;">Gambar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<style>

.custom-counter {
     font-size: 11pt;
  margin: 0;
  padding: 0;
  list-style-type: none;
}

.custom-counter li {
  counter-increment: step-counter;
  margin-bottom: 10px;
}

.custom-counter li::before {
  content: counter(step-counter);
  margin-right: 5px;
  font-size: 80%;
  background-color: rgb(0,200,200);
  color: white;
  font-weight: bold;
  padding: 3px 8px;
  border-radius: 3px;
}

</style>