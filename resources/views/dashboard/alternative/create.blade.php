<!-- Modal Create Decision -->
<div class="modal fade" id="createAlternativeModal" tabindex="-1" role="dialog" aria-labelledby="createAlternativeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCriteriaModalLabel">Tambah Data Alternatif</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="/dashboard/alternatives" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alternative" class="col-form-label">Nama Alternatif :</label>
                        <input type="text" class="form-control @error('alternative') is-invalid @enderror" id="alternative" name="alternative" required autofocus value="{{ old('alternative') }}">
                        @error('alternative')
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