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

                                                <a href="/dashboard/show/{{ $criteria->slug }}" class="btn btn-primary btn-icon-split btn-sm mb-2 open_modal">
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
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection