<!-- Button for open modal form create data -->
<div class="modal fade" id="editOfficerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Ubah Officer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form create or add data -->
        <form action="#" method="POST">
          @csrf
          @method('PUT')
            <div class="col-md-12 col-lg-8">
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name_officer" class="form-control" placeholder="Masukkan nama..">
              </div>
            </div>
          <div class="row">
            <div class="col">
              <label for="email" class="form-label">Email</label>
              <div class="input-group mb-3">
                <span class="d-block input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                <input type="text" name="email" id="email_officer" class="form-control" placeholder="Masukkan email..">
              </div>
            </div>
            <div class="col">
              <label for="phone_number" class="form-label">Nomor Handphone</label>
              <div class="input-group mb-3">
                <span class="d-block input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input type="text" name="phone_number" id="phone_number_officer" class="form-control"
                  placeholder="Masukkan nomor handphone..">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-lg-6">
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password_officer" class="form-control"
                  placeholder="Masukkan password..">
                <small class="text-muted">Kosongkan kolom password jika tidak ingin diubah</small>
              </div>
            </div>
            <div class="col-md-12 col-lg-6">
              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="konfirmasi_password_officer" class="form-control"
                  placeholder="Masukkan password..">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
