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
                <h6 class="m-0 font-weight-bold text-primary">Pendukung Keputusan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{ $title }}
                </div>
            </div>
    </div>

        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $n = $subcriterias->count() }}">


                                    @foreach ($subcriterias as $subcriteria)
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $pilihan[] = $subcriteria->subcriteria }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $input = $subcriteria->id }}">
                                    @endforeach
                                    <tr>
                                        <th>Sub Kriteria</th>
                                        @foreach ($subcriterias as $subcriteria)
                                            @foreach ($columns as $column)
                                                @if ($subcriteria->id == $column)
                                                <th>{{ $subcriteria->subcriteria }}</th>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody> 
                                    
                                    @foreach ($rows as $subcriteria1 => $columns)
                                    <tr>
                                        @foreach ($subcriterias as $subcriteria)
                                        @if ($subcriteria->id == $subcriteria1)
                                        <td>{{ $subcriteria->subcriteria }}</td>
                                        @endif
                                        @endforeach  
                                        @foreach ($columns as $subcriteria2 => $grade)                                        
                                        <td>{{ $grade }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Jumlah</th>
                                        @foreach ($sums as $sum)
                                        <th>{{ $sum->total_sum }}</th>
                                        @endforeach
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="mb-3 d-flex justify-content-end">
                                <div class="col-xs-4">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendukung Keputusan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    @foreach ($rows as $subcriteria1 => $columns)
                                        @foreach ($subcriterias as $subcriteria)
                                        @if ($subcriteria->id == $subcriteria1)
                                        <th>{{ $subcriteria->subcriteria }}</th>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    <th>Jumlah</th>
                                    <th>Priority Vektor</th>
                                </tr>
                            </thead>
                            <tbody> 
                                    
                                @foreach ($supportRows as $subcriteria1 => $columns)
                                <tr>
                                    @foreach ($subcriterias as $subcriteria)
                                    @if ($subcriteria->id == $subcriteria1)
                                    <td>{{ $subcriteria->subcriteria }}</td>
                                    @endif
                                    @endforeach  
                                    @foreach ($columns as $subcriteria2 => $grade)                                        
                                    <td>{{ number_format($grade, 3) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>

    <div class="col-xl-12 col-lg-12">

        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Perankingan</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Peringkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="text" hidden value="{{ $no = 1 }}">
                                    @foreach ($ranked as $item => $rank)
                                    <tr>
                                        @foreach ($subcriterias as $subcriteria)
                                        @if ($subcriteria->id == $item)
                                        <td>{{ $subcriteria->subcriteria }}</td>
                                        <td>{{ $subcriteria->description }}</td>
                                        @endif
                                        @endforeach
                                        @foreach ($rank as $subcriteria2 => $grade)                                        
                                        <td>{{ number_format($grade, 3) }}</td>
                                        @endforeach
                                        <td>{{ $no++ }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
    </div>

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendukung Keputusan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    @foreach ($rows as $subcriteria1 => $columns)
                                        @foreach ($subcriterias as $subcriteria)
                                        @if ($subcriteria->id == $subcriteria1)
                                        <th>{{ $subcriteria->subcriteria }}</th>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    <th>Jumlah</th>
                                    <th>Priority Vektor</th>
                                </tr>
                            </thead>
                            <tbody> 
                                    
                                @foreach ($normalization as $subcriteria1 => $columns)
                                <tr>
                                    @foreach ($subcriterias as $subcriteria)
                                    @if ($subcriteria->id == $subcriteria1)
                                    <td>{{ $subcriteria->subcriteria }}</td>
                                    @endif
                                    @endforeach  
                                    @foreach ($columns as $subcriteria2 => $grade)                                        
                                    <td>{{ number_format($grade, 3) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="{{ $n+2 }}"  style="text-align: center">Lamda Max</th>    
                                    <th>{{ number_format($lamdaMax, 3) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="{{ $n+2 }}"  style="text-align: center">Konsistensi Index</th>    
                                    <th>{{ number_format($consistencyIndex, 3) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="{{ $n+2 }}"  style="text-align: center">Konsistensi Ratio</th>    
                                    <th>{{ number_format($consistencyRatio, 3) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </symbol>
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                          </svg>
                        @if ($consistencyRatio <= 0.1)
                        <form method="POST" action="/dashboard/prioritysubcriteria" enctype="multipart/form-data">
                            @csrf
                        @foreach ($cl as $item)
                            <input type="text" style="font-size: 14px" class="form-control" id="criteria_id" name="criteria_id[]" hidden required value="{{ $item }}">
                        @endforeach
                        @foreach ($scl as $item)
                            <input type="text" style="font-size: 14px" class="form-control" id="subcriteria_id" name="subcriteria_id[]" hidden required value="{{ $item }}">
                        @endforeach
                        @foreach ($sp as $item)
                            <input type="text" style="font-size: 14px" class="form-control" id="score" name="score[]" hidden required value="{{ $item }}">
                        @endforeach
                        <div class="mb-3 d-flex justify-content-end">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        </form>
                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                            <div style="margin-left: 10px">
                               Perbandingan Kriteria : Konsisten!
                            </div>
                          </div>
                        @else
                        <div class="mb-3 d-flex justify-content-end">
                            <div class="col-xs-4">
                                <a href="{{ URL::previous() }}" class="btn btn-primary btn-icon-split btn-sm mb-2 open_modal">
                                    <span class="text">Kembali</span>
                                </a>
                            </div>
                        </div>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div style="margin-left: 10px">
                                Nilai Konsistensi Rasio melebihi 10% ! <br>
                                Silahkan input kembali tabel perbandingan...
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection