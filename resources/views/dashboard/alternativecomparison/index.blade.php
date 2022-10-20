@extends('dashboard.layouts.main')

@section('container')    

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Keputusan</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Penjelasan -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pendukung Keputusan</h6>
                </div>
                <div class="card-body">
                    @if ($subcriterias->count() == 0 )
                    <div class="table-responsive">
                        <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($criterias->count())
                                <input type="text" hidden value="{{ $no = 1 }}">
                                @foreach ($criterias as $key => $criteria)
                                <tr>
                                    <td style="width: 2%">{{ $no++ }}</td>
                                    <td style="width: 25%">{{ $criteria->criteria }}</td>
                                    <td style="width: 25%">
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <div class="d-sm-flex align-items-center justify-content-beetwen">
                                              <a href="/dashboard/showacriteria/{{ $criteria->slug }}" class="btn btn-primary btn-icon-split btn-sm mb-2 open_modal">
                                                  <span class="icon text-white-50">
                                                      <i class="bi bi-file-earmark-plus"></i>
                                                  </span>
                                                  <span class="text">Pilih Kriteria</span>
                                              </a>
                                        </li>
                                    </ul>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4">
                                        <p class="text-center fs-4">No Data Found.</p>
                                    </td>
                                </tr>                      
                            @endif
                            </tbody>
                        </table>
                        @foreach ($criterias as $item)
                        <input type="text" style="font-size: 14px" class="form-control" id="criteria_id" name="criteria_id[]" hidden required value="{{  $criteria_id = $item->id  }}">
                        @endforeach

                        @foreach ($alternativesinglecomparisons as $item)
                        <input type="text" style="font-size: 14px" class="form-control" id="criteria2_id" name="criteria2_id[]" hidden required value="{{ $criteria2_id = $item->criteria_id }}">
                        @endforeach
                        <div class="mb-3 d-flex justify-content-end">
                            <div class="col-xs-4">

                                    @if ($alternativesinglecomparisons->count() == 0)
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div style="margin-left: 10px">
                                            Silahkan mengisi data tiap kriteria
                                        </div>
                                    </div>
                                    @else
                                        @if ($criteria_id == $criteria2_id)
                                        <a href="/dashboard/resultalternative" class="btn btn-primary btn-icon-split btn-sm mb-2 open_modal">
                                            <span class="text">Hasil</span>
                                        </a>
                                        @else
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div style="margin-left: 10px">
                                                Silahkan mengisi data tiap kriteria
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kriteria</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($criterias->count())
                                <input type="text" hidden value="{{ $no = 1 }}">
                                @foreach ($criterias as $key => $criteria)
                                <tr>
                                    <td style="width: 2%">{{ $no++ }}</td>
                                    <td style="width: 25%">{{ $criteria->criteria }}</td>
                                    <td style="width: 25%">
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <div class="d-sm-flex align-items-center justify-content-beetwen">
                                              <a href="/dashboard/showasubcriteria/{{ $criteria->slug }}" class="btn btn-primary btn-icon-split btn-sm mb-2 open_modal">
                                                <span class="icon text-white-50">
                                                    <i class="bi bi-file-earmark-plus"></i>
                                                </span>
                                                <span class="text">Pilih Kriteria</span>
                                            </a>
                                        </li>
                                    </ul>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4">
                                        <p class="text-center fs-4">No Data Found.</p>
                                    </td>
                                </tr>                      
                            @endif
                            </tbody>
                        </table>
                        @foreach ($criterias as $item)
                        <input type="text" style="font-size: 14px" class="form-control" id="criteria_id" name="criteria_id[]" hidden required value="{{  $criteria_id = $item->id  }}">
                        @endforeach

                        @foreach ($alternativecomparisons as $item)
                        <input type="text" style="font-size: 14px" class="form-control" id="criteria2_id" name="criteria2_id[]" hidden required value="{{ $criteria2_id = $item->criteria_id }}">
                        @endforeach
                        <div class="mb-3 d-flex justify-content-end">
                            <div class="col-xs-4">
                                @if ($alternativecomparisons->count() == 0)
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div style="margin-left: 10px">
                                            Silahkan mengisi data tiap kriteria
                                        </div>
                                    </div>
                                    @else
                                        @if ($criteria_id == $criteria2_id)
                                        <a href="/dashboard/result" class="btn btn-primary btn-icon-split btn-sm mb-2 open_modal">
                                            <span class="text">Hasil</span>
                                        </a>
                                        @else
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                            <div style="margin-left: 10px">
                                                Silahkan mengisi data tiap kriteria
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
        </div>
    </div>
</div>
@endsection