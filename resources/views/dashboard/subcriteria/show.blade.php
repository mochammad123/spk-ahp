@extends('dashboard.layouts.main')

@section('container')
    

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
    @if ($subcriterias->count()>=15)
    <div class="alert alert-info" role="alert" style="width: 40%">
        Data Kriteria telah mencapai maksimum
      </div>
    @else
    <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#createSubcriteriaModal">
        <span class="icon text-white-50">
            <i class="bi bi-file-earmark-plus"></i>
        </span>
        <span class="text">Tambah Data</span>
    </button>
    @endif
</div>

@include('dashboard.subcriteria.create')

<!-- Content Row -->
<div class="row">
    <!-- Penjelasan -->
    <div class="col-xl-3 col-lg-3">
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
    </div>

    <div class="col-xl-9 col-lg-9">
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive" style="height: 350px;">
                        <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sub Kriteria</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($subcriterias->count())
                                <input type="text" hidden value="{{ $no = 1 }}">
                                @foreach ($subcriterias as $key => $subcriteria)
                                <tr>
                                    <td style="width: 2%">{{ $no++ }}</td>
                                    <td style="width: 30%">{{ $subcriteria->subcriteria }}</td>
                                    <td style="width: 30%">{{ $subcriteria->description }}</td>
                                    <td style="width: 38%">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <div class="d-sm-flex align-items-center justify-content-beetwen">
    
                                                    <button type="button" class="btn btn-warning btn-icon-split btn-sm mb-2 open_modal" data-toggle="modal" data-target="#editSubcriteriaModal{{  $subcriteria->slug }}" id="editSubcriteria{{ $subcriteria->slug }}" data-item-id="{{ $subcriteria->slug }}">
                                                        <span class="icon text-white-50">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </span>
                                                        <span class="text">Ubah</span>
                                                    </button>
                                                </div>
                                            </li>
    
                                            <li class="list-inline-item">
    
                                                <div class="d-sm-flex align-items-center justify-content-beetwen">
    
                                                    <button type="button" class="btn btn-danger btn-icon-split btn-sm mb-2 open_modal" data-toggle="modal" data-target="#deleteSubriteriaModal{{ $subcriteria->slug }}">
                                                        <span class="icon text-white-50">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </span>
                                                        <span class="text">Hapus</span>
                                                    </button>
                                                    
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @include('dashboard.subcriteria.edit')
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