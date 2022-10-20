<!-- Modal Edit Decision -->
<div class="modal fade" id="editSubcriteriaModal{{ $subcriteria->slug }}" tabindex="-1" role="dialog" aria-labelledby="editSubcriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editSubcriteriaModalLabel">Ubah Data Keputusan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form method="POST" action="/dashboard/subcriterias/{{ $subcriteria->slug }}" enctype="multipart/form-data" id="edit-form">
              @method('PUT')
              @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="subcriteria" class="col-form-label">Nama Sub Kriteria :</label>
                        <input type="text" class="form-control" id="subcriteria" name="subcriteria" required autofocus value="{{ $subcriteria->subcriteria }}">
                    </div>

                    <div class="mb-3">
                      <input type="text" class="form-control" id="id" name="id" hidden required autofocus value="{{ $subcriteria->slug }}">
                  </div>

                    <div class="mb-3">
                    <label for="description" class="col-form-label">Deskripsi :</label>
                    <textarea class="form-control" id="description" name="description" required>{{$subcriteria->description }}</textarea>
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
<!-- End Modal Edit Decision -->


    <!-- Delete Modal-->
    <div class="modal fade" id="deleteSubriteriaModal{{ $subcriteria->slug }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah yakin data ini akan dihapus?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="/dashboard/subcriterias/{{ $subcriteria->slug }}" enctype="multipart/form-data" id="edit-form">
                  @method('delete')
                  @csrf
                <div class="modal-body">Pilih "Hapus" jika anda yakin akan menghapus data.</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
              </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      @if (count($errors) > 0)
          $('#editDecisionModal').modal('show');
      @endif
      </script>