<!-- Modal Create Decision -->
<div class="modal fade" id="createSubcriteriaModal" tabindex="-1" role="dialog" aria-labelledby="createSubcriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createDecisionModalLabel">Tambah Data Keputusan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="/dashboard/subcriterias" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="criteria_id" name="criteria_id" hidden required autofocus value="{{ $id }}">
                    </div>

                    <div class="mb-3">
                        <label for="subcriteria" class="col-form-label">Nama Sub Kriteria :</label>
                        <input type="text" class="form-control @error('subcriteria') is-invalid @enderror" id="subcriteria" name="subcriteria" required autofocus value="{{ old('subcriteria') }}">
                        @error('subcriteria')
                            <div class="invalid-feedback" role="alert">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                    <label for="description" class="col-form-label">Deskripsi :</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
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