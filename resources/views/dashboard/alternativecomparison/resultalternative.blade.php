@extends('dashboard.layouts.main')

@section('container')


<!-- Content Row -->
<div class="row">
    <div class="col-xl-12 col-lg-12">

        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Priority Vector Criteria</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $n = $criterias->count() }}">

                                    @foreach ($criterias as $criteria)
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $kriteria = $criteria->criteria }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $input = $criteria->id }}">
                                    @endforeach
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Priority Vektor (Kriteria)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $alternative1 => $columns)
                                    <tr>
                                        @foreach ($criterias as $criteria)
                                        @if ($criteria->id == $alternative1)
                                        <td>{{ $criteria->criteria }}</td>
                                        @endif
                                        @endforeach
                                        @foreach ($columns as $alternative2 => $grade)                                        
                                        <td>{{ $grade }}</td>
                                        @endforeach 
                                    </tr>
                                    @endforeach
                                </tbody>
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
                    <h6 class="m-0 font-weight-bold text-primary">Priority Vector Alternative</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $n = $criterias->count() }}">

                                    @foreach ($criterias as $criteria)
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $kriteria = $criteria->criteria }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $input = $criteria->id }}">
                                    @endforeach
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($criterias as $criteria)
                                            @foreach ($columns as $column)
                                                <th>{{ $criteria->criteria }}</th>
                                            @endforeach
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($rowAlternatives as $alternative1 => $columnAlternatives)
                                        @foreach ($alternatives as $alternative)
                                        @if ($alternative->id == $alternative1)
                                        <td>{{ $alternative->alternative }}</td>
                                        @endif
                                        @endforeach
                                        @foreach ($columnAlternatives as $alternative2 => $grade)                                        
                                        <td>{{ number_format($grade, 2) }}</td>
                                        @endforeach 
                                    </tr>
                                    @endforeach
                                </tbody>
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
                    <h6 class="m-0 font-weight-bold text-primary">Normalisasi</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $n = $criterias->count() }}">

                                    @foreach ($criterias as $criteria)
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $kriteria = $criteria->criteria }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $input = $criteria->id }}">
                                    @endforeach
                                    <tr>
                                        <th>Alternatif</th>
                                        @foreach ($criterias as $criteria)
                                            @foreach ($columns as $column)
                                                <th>{{ $criteria->criteria }}</th>
                                            @endforeach
                                        @endforeach
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($normalization as $alternative1 => $columns)
                                    <tr>
                                        @foreach ($alternatives as $alternative)
                                        @if ($alternative->id == $alternative1)
                                        <td>{{ $alternative->alternative }}</td>
                                        @endif
                                        @endforeach  
                                        @foreach ($columns as $alternative2 => $grade)                                        
                                        <td>{{ number_format($grade, 2) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
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
                    <h6 class="m-0 font-weight-bold text-primary">Perankingan</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered datatab" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $n = $criterias->count() }}">

                                    @foreach ($criterias as $criteria)
                                    <input type="text" style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" hidden required autofocus value="{{ $kriteria = $criteria->criteria }}">
                                    <input type="text" hidden style="font-size: 14px" class="form-control" id="criteria1" name="criteria1" required autofocus value="{{ $input = $criteria->id }}">
                                    @endforeach
                                    <tr>
                                        <th>Alternative</th>
                                        <th>Jumlah</th>
                                        <th>Peringkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="text" hidden value="{{ $no = 1 }}">
                                    @foreach ($a as $item => $aa)
                                    <tr>
                                        @foreach ($alternatives as $alternative)
                                        @if ($alternative->id == $item)
                                        <td>{{ $alternative->alternative }}</td>
                                        @endif
                                        @endforeach
                                        @foreach ($aa as $alternative2 => $grade)                                        
                                        <td>{{ number_format($grade, 2) }}</td>
                                        @endforeach
                                        <td>{{ $no++ }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
    </div>
</div>
@endsection