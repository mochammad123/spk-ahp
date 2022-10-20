<!-- Modal Create Decision -->
<div class="modal fade" id="editCriteriaModal{{ $criteria->slug }}" tabindex="-1" role="dialog" aria-labelledby="editCriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCriteriaModalLabel">Tambah Data Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="/dashboard/criterias/{{ $criteria->slug }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="criteria" class="col-form-label">Nama Kriteria :</label>
                        <input type="text" class="form-control @error('criteria') is-invalid @enderror" id="criteria" name="criteria" required autofocus value="{{ $criteria->criteria }}">
                        @error('criteria')
                            <div class="invalid-feedback" role="alert">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="id" name="id" hidden required autofocus value="{{ $criteria->slug }}">
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

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteCriteriaModal{{ $criteria->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah yakin data ini akan dihapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="/dashboard/criterias/{{ $criteria->slug }}" enctype="multipart/form-data" id="edit-form">
                  @method('delete')
                  @csrf
                <div class="modal-body">Pilih "Hapus" jika anda yakin akan menghapus data {{ $criteria->criteria }}.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
              </form>
            </div>
        </div>
    </div>