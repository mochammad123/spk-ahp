<!-- Modal Create Decision -->
<div class="modal fade" id="createCriteriaModal" tabindex="-1" role="dialog" aria-labelledby="createCriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCriteriaModalLabel">Tambah Data Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="/dashboard/criterias" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="criteria" class="col-form-label">Nama Kriteria :</label>
                        <input type="text" class="form-control @error('criteria') is-invalid @enderror" id="criteria" name="criteria" required autofocus value="{{ old('criteria') }}">
                        @error('criteria')
                            <div class="invalid-feedback" role="alert">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal Create Decision -->