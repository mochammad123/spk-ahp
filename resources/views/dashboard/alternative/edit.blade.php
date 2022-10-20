<!-- Modal Create Decision -->
<div class="modal fade" id="editAlternativeModal{{ $alternative->slug }}" tabindex="-1" role="dialog" aria-labelledby="editAlternativeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAlternativeModalLabel">Tambah Data Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="/dashboard/alternatives/{{ $alternative->slug }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="alternative" class="col-form-label">Nama Alternatif :</label>
                        <input type="text" class="form-control @error('alternative') is-invalid @enderror" id="alternative" name="alternative" required autofocus value="{{ $alternative->slug }}">
                        @error('alternative')
                            <div class="invalid-feedback" role="alert">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="id" name="id" hidden required autofocus value="{{ $alternative->slug }}">
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
    <div class="modal fade" id="deleteAlternativeModal{{ $alternative->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah yakin data ini akan dihapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="/dashboard/alternatives/{{ $alternative->slug }}" enctype="multipart/form-data" id="edit-form">
                  @method('delete')
                  @csrf
                <div class="modal-body">Pilih "Hapus" jika anda yakin akan menghapus data {{ $alternative->alternative }}.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
              </form>
            </div>
        </div>
    </div>