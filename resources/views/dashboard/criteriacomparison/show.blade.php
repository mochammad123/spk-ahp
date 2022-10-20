@extends('dashboard.layouts.main')

@section('container')
    

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
</div>


<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-lg-12">

        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <form method="POST" action="/dashboard/process" enctype="multipart/form-data">
                            @csrf
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Perbandingan</th>
                                        <th>Kriteria</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $n = $criterias->count() }}">
                                    @if ($criterias->count()>1)
                                    @foreach ($criterias as $criteria)
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $pilihan[] = $criteria->criteria }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $input[] = $criteria->id }}">
                                    @endforeach
                                    <input type="text" style="font-size: 14px" class="form-control" id="urut" name="urut" hidden required autofocus value="{{ $urut = -1 }}">
                                    
                                    @for ($x = 0; $x <= $n - 1; $x++)
                                    
                                    
                                    @for ($y = 0; $y <= $n - 1; $y++)
                                    <input type="text" style="font-size: 14px" class="form-control" id="urut" name="urut" hidden required autofocus value="{{ $urut++ }}">
                                    
                                    <tr>
                                    @if ($x == $y)
                                    <td style="width: 25%" hidden>
                                                
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="">{{ $pilihan[$x] }}</label>
                                        </div>
                                        <input type="text" style="font-size: 14px" class="form-control" id="criteria_id" name="criteria_id[]" hidden required autofocus value="{{ $input[$x] }}">
                                    </td>
                                    <td style="width: 15%" hidden>
                                        <input type="text" class="form-control" id="score" name="score[]" required value="1">
                                    </td>
                                    <td style="width: 25%" hidden>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="">{{ $pilihan[$y] }}</label>
                                        </div>
                                        <input type="text" style="font-size: 14px" class="form-control" id="criteria2_id" name="criteria2_id[]" hidden required autofocus value="{{ $input[$y] }}">
                                    </td>
                                    @else
                                    <td style="width: 25%">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="">{{ $pilihan[$x] }}</label>
                                        </div>
                                        <input type="text" style="font-size: 14px" class="form-control" id="criteria_id" name="criteria_id[]" hidden required value="{{ $input[$x] }}">
                                    </td>
                                    <td style="width: 50%">
                                        <input type="text" class="form-control" id="score" name="score[]" required value="1">
                                    </td>
                                    <td style="width: 25%">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="">{{ $pilihan[$y] }}</label>
                                        </div>
                                        <input type="text" style="font-size: 14px" class="form-control" id="criteria2_id" name="criteria2_id[]" hidden required value="{{ $input[$y] }}">
                                    </td>
                                    @endif
                                    </tr>
                                    <tr>
                                        @endfor
                                        
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
                                    @if ($criterias->count()<=2)
                                    Maaf belum bisa melakukan Perbandingan
                                    @else
                                    <button type="submit" class="btn btn-primary">Perbandingan</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection