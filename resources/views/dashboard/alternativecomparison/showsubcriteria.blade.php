@extends('dashboard.layouts.main')

@section('container')
    

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Perbandingan Alternatif</h1>
</div>


<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-lg-12">

        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kriteria {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <form method="POST" action="/dashboard/processalternative" enctype="multipart/form-data">
                            @csrf
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Alternatif</th>
                                        <th>{{ $title }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required hidden autofocus value="{{ $n = $alternatives->count() }}">
                                    @if ($alternatives->count()>1)
                                    @foreach ($alternatives as $alternative)
                                    <input type="text" style="font-size: 14px" class="form-control" id="alternative" name="alternative" hidden required autofocus value="{{ $pilihan[] = $alternative->alternative }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="alternative" name="alternative" required autofocus value="{{ $input[] = $alternative->id }}">
                                    @endforeach
                                    <input type="text" style="font-size: 14px" class="form-control" id="urut" name="urut" hidden required autofocus value="{{ $urut = -1 }}">
                                    
                                    @for ($x = 0; $x <= ($n - 1); $x++)
                                    
                                    <tr>
                                        <input type="text" style="font-size: 14px" class="form-control" id="criteria_id[]" name="criteria_id[]" hidden required autofocus value="{{ $id }}">
                    
                                    <td style="width: 50%">
                                        <input type="text" style="font-size: 14px" class="form-control" id="alternative" name="alternative[]" readonly required value="{{ $pilihan[$x] }}">
                                        <input type="text" style="font-size: 14px" class="form-control" id="alternative_id" name="alternative_id[]" hidden required value="{{ $input[$x] }}">
                                    </td>
                                    <td style="width: 50%">
                                        <select class="form-control" style="font-size: 14px" aria-label="Default select example" name="score[]">
                                            @foreach ($pvsubcriterias as $pvsubcriteria)
                                            <option value="{{ $pvsubcriteria->score }}">{{ $pvsubcriteria->subcriteria->subcriteria }}</option>                                  
                                            @endforeach
                                        </select>
                                    </td>

                                    </tr>
                                    <tr>
                                        @endfor
                                        @else
                                        <td colspan="4">
                                            <p class="text-center fs-4">Number of Criteria not eligible</p>
                                        </td>
                                    </tr>                      
                                    @endif
                                </tbody>
                            </table>
                            <div class="mb-3 d-flex justify-content-end">
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary">Perbandingan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection