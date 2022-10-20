@extends('dashboard.layouts.main')

@section('container')
    

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $criterias->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Sub Kriteria</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $subcriterias->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alternatif
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $alternatives->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Content Row -->

<div class="row">

    <!-- Penjelasan -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Analytical Hierarchy Process</h6>
            </div>
            <div class="card-body">
                <p style="text-align: justify">Model AHP pendekatannya hampir identik dengan model perilaku politis, yaitu merupakan model keputusan (individual) dengan menggunakan pendekatan kolektif dari proses pengambilan keputusan. AHP yang dikembangkan oleh Thomas L. Saaty, dapat memecahkan masalah yang kompleks dimana aspek atau kriteria yang diambil cukup banyak. Juga kompleksitas ini disebabkan oleh struktur masalah yang belum jelas, ketidakpastian persepsi pengambilan keputusan serta ketidakpastian tersedianya data statistik yang akurat atau bahkan tidak ada sama sekali.</p>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-6 col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Nilai Preferensi</h6>
            </div>
            <div class="card-body">
                <p class="mb-0">1. Kedua elemen sama penting</p>
                <p class="mb-0">3. Elemen yang satu sedikit lebih penting daripada elemen yang lain</p>
                <p class="mb-0">5. Elemen yang satu lebih penting daripada elemen lainnya</p>
                <p class="mb-0">7. Satu elemen jelas lebih mutlak penting daripada elemen lainnya</p>
                <p class="mb-0">9. Satu elemen mutlak penting daripada elemen lainnya</p>
                <p>2, 4, 6, 8. Nilai-nilai antara dua nilai pertimbangan yang berdekatan</p>
            </div>
        </div>
    </div>
</div>
@endsection