<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeComparison;
use App\Models\Criteria;
use App\Models\Pvcriteria;
use App\Models\Pvsubcriteria;
use App\Models\Subcriteria;
use App\Models\SubcriteriaComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class AlternativeComparisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'criteria_id' => 'required',
            'alternative_id' => 'required',
            'score' => 'required'
        ]);



        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            AlternativeComparison::updateOrCreate(
                ['criteria_id' => $input['criteria_id'][$key], 'alternative_id' => $input['alternative_id'][$key]],
                [
                    'criteria_id' => $input['criteria_id'][$key],
                    'alternative_id' => $input['alternative_id'][$key],
                    'score' => $input['score'][$key]
                ]
            );

            Alert::toast('Data Berhasil Ditambahkan', 'success')->timerProgressBar();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlternativeComparison  $alternativeComparison
     * @return \Illuminate\Http\Response
     */
    public function show(AlternativeComparison $alternativeComparison, $criteriaId)
    {
        $criterias = Criteria::where('slug', '=', $criteriaId)->first();
        $id = $criterias->id;
        $title = $criterias->criteria;
        $alternatives = Alternative::all();
        $subcriterias = Subcriteria::where('criteria_id', '=', $id)->get();
        $pvsubcriterias = Pvsubcriteria::where('criteria_id', '=', $id)->get();

        return view('dashboard.alternativecomparison.showsubcriteria', [
            "criterias" => $criterias,
            "id" => $id,
            "title" => $title,
            "alternatives" => $alternatives,
            "subcriterias" => $subcriterias,
            "pvsubcriterias" => $pvsubcriterias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlternativeComparison  $alternativeComparison
     * @return \Illuminate\Http\Response
     */
    public function edit(AlternativeComparison $alternativeComparison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlternativeComparison  $alternativeComparison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlternativeComparison $alternativeComparison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlternativeComparison  $alternativeComparison
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlternativeComparison $alternativeComparison)
    {
        //
    }

    public function process(Request $request)
    {
        $this->store($request);

        return view('dashboard.alternativecomparison.index', [
            "criterias" => Criteria::all(),
            "subcriterias" => Subcriteria::all(),
            "alternativecomparisons" => AlternativeComparison::all()
        ]);
    }

    public function result()
    {
        $criterias = Criteria::all();
        $subcriterias = Subcriteria::all();
        $alternatives = Alternative::all();
        $pvcriterias = Pvcriteria::all();
        $alternativecomparisons = AlternativeComparison::orderBy('criteria_id', 'asc')->get();

        $rows = [];
        $columns = [];
        foreach ($pvcriterias as $key => $pvcriteria) {
            if (!isset($rows[$pvcriteria->criteria_id])) {
                $rows[$pvcriteria->criteria_id] = [];
            }

            if (!in_array($pvcriteria->criteria_id, $columns)) {
                $columns[] = $pvcriteria->criteria_id;
            }
            $rw[$pvcriteria->criteria_id] = $pvcriteria->score;
            $rows[$pvcriteria->criteria_id][$pvcriteria->criteria_id] = $pvcriteria->score;
        }

        $rowAlternatives = [];
        $columnAlternatives = [];
        foreach ($alternativecomparisons as $key => $alternativecomparison) {
            if (!isset($rowAlternatives[$alternativecomparison->alternative_id])) {
                $rowAlternatives[$alternativecomparison->alternative_id] = [];
            }

            if (!in_array($alternativecomparison->criteria_id, $columnAlternatives)) {
                $columnAlternatives[] = $alternativecomparison->criteria_id;
            }
            $rowAlternatives[$alternativecomparison->alternative_id][$alternativecomparison->criteria_id] = $alternativecomparison->score;
        }

        $normalization = array();
        $sumPriority = array();

        foreach ($rowAlternatives as $j => $rowi) {
            $priority = array();
            foreach ($columns as $rowColumn) {
                $priority[$rowColumn] = $rw[$rowColumn];
                $normalization[$j][$rowColumn] = $rowi[$rowColumn] * $priority[$rowColumn];
            }
            $normalization[$j]["total"] =  array_sum($normalization[$j]);
            $sumPriority[$j] =  $normalization[$j]["total"];
            $ranking[$j]["ranking"] = $sumPriority[$j];
            $a = collect($ranking)->sortBy('ranking')->reverse()->toArray();
        }


        return view('dashboard.alternativecomparison.result', [
            "columns" => $columns,
            "rows" => $rows,
            "rowAlternatives" => $rowAlternatives,
            "columnAlternatives" => $columnAlternatives,
            "normalization" => $normalization,
            "sumpriority" => $sumPriority,
            "a" => $a,
            "criterias" => $criterias,
            "subcriterias" => $subcriterias,
            "alternatives" => $alternatives,
            "pvcriterias" => $pvcriterias,
            "alternativecomparisons" => $alternativecomparisons
        ]);
    }
}
