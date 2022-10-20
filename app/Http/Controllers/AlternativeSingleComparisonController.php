<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\AlternativeSingleComparison;
use App\Models\Criteria;
use App\Models\Pvalternative;
use App\Models\Pvcriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class AlternativeSingleComparisonController extends Controller
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
            'score' => 'required',
            'alternative2_id' => 'required',
            'chose' => 'required'
        ]);



        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            AlternativeSingleComparison::updateOrCreate(
                ['criteria_id' => $input['criteria_id'][$key], 'alternative_id' => $input['alternative_id'][$key], 'alternative2_id' => $input['alternative2_id'][$key]],
                [
                    'criteria_id' => $input['criteria_id'][$key],
                    'alternative_id' => $input['alternative_id'][$key],
                    'score' => $input['score'][$key],
                    'alternative2_id' => $input['alternative2_id'][$key]
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlternativeSingleComparison  $alternativeSingleComparison
     * @return \Illuminate\Http\Response
     */
    public function show(AlternativeSingleComparison $alternativeSingleComparison, $criteriaId)
    {
        $criterias = Criteria::where('slug', '=', $criteriaId)->first();
        $id = $criterias->id;
        $title = $criterias->criteria;
        $alternatives = Alternative::all();

        return view('dashboard.alternativecomparison.showcriteria', [
            "criterias" => $criterias,
            "id" => $id,
            "title" => $title,
            "alternatives" => $alternatives,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlternativeSingleComparison  $alternativeSingleComparison
     * @return \Illuminate\Http\Response
     */
    public function edit(AlternativeSingleComparison $alternativeSingleComparison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlternativeSingleComparison  $alternativeSingleComparison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlternativeSingleComparison $alternativeSingleComparison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlternativeSingleComparison  $alternativeSingleComparison
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlternativeSingleComparison $alternativeSingleComparison)
    {
        //
    }

    public function process(Request $request)
    {
        // dd($request);
        $this->store($request);


        $records = AlternativeSingleComparison::where('criteria_id', '=', $request->criteria_id)->orderBy('alternative2_id')->orderBy('alternative_id')->get();
        $criterias = Criteria::where('id', '=', $request->criteria_id)->first();
        $alternatives = Alternative::all();
        $title = $criterias->criteria;

        $rows = [];
        $columns = [];

        foreach ($records as $key => $record) {
            if (!isset($rows[$record->alternative_id])) {
                $rows[$record->alternative_id] = [];
            }

            if (!in_array($record->alternative2_id, $columns)) {
                $columns[] = $record->alternative2_id;
            }
            $rows[$record->alternative_id][$record->alternative2_id] = $record->score;
            $criteria_id = $record->criteria_id;
        }

        // dd($criteria_id);
        /**
         * ========= Start line =========
         * Disini sal untuk ngisi data di tabel pendukung
         * @param $supportRows
         *
         * by Amin
         */

        $supportRows = array();
        $supportColumns = array([]);
        $sumOfEachRow[] = array();
        $sumOfEachColumn[] = array();
        foreach ($columns as $column) {
            $sumOfRow = 0;
            foreach ($columns as $rowColumn) {
                $sumOfRow += $rows[$rowColumn][$column];
            }
            $sumOfEachRow[$column] = $sumOfRow;
        }



        $rowis = array();
        $sp = array();
        $di = array();
        $cl = array();
        foreach ($columns as $column) {
            foreach ($rows as $key => $row) {
                foreach ($columns as $rowColumn) {
                    $rowis[$key][$rowColumn] = $row[$rowColumn];
                    $row[$rowColumn] /=  $sumOfEachRow[$rowColumn];
                }
                $sd[$key] = $row;
                $row["total"] = array_sum($row);
                $row["priority"] = $row["total"] / count($columns);
                $supportRows[$key] = $row;
                $cl[$key] = $criteria_id;
                $scl = $columns;
                $sp[$key] = $row["priority"];
                $ranking[$key]["ranking"] = $row["priority"];
                $ranked = collect($ranking)->sortBy('ranking')->reverse()->toArray();
            }
            // dd($sp);
        }


        /**
         *  Tabel normalisasi
         * @param $normalisasi
         * @param $lamdaMax
         * @param $ci
         * @param $cr
         *
         */

        $normalization = array();
        $sumPriority = array();
        foreach ($rowis as $j => $rowi) {
            $priority = array();
            foreach ($columns as $rowColumn) {
                $priority[$rowColumn] = $supportRows[$rowColumn]["priority"];
                $normalization[$j][$rowColumn] = $rowi[$rowColumn] * $priority[$rowColumn];
            }
            $normalization[$j]["total"] =  array_sum($normalization[$j]);
            // $normalization[$j]["oldPri"] = $priority[$j];
            $normalization[$j]["prority"] =  $normalization[$j]["total"] / $priority[$j];
            $sumPriority[] =  $normalization[$j]["prority"];
        }


        // dd($normalization);


        $lamdaMax = array_sum($sumPriority) / count($sumPriority);
        $consistencyIndex = ($lamdaMax - count($sumPriority)) / (count($sumPriority) - 1);


        $indexRandomValue = [
            1    =>    0.00,
            2    =>    0.00,
            3    =>    0.58,
            4    =>    0.90,
            5    =>    1.12,
            6    =>    1.24,
            7    =>    1.32,
            8    =>    1.41,
            9    =>    1.45,
            10    =>    1.49,
            11    =>    1.51,
            12    =>    1.48,
            13    =>    1.56,
            14    =>    1.57,
            15    =>    1.59
        ];
        $consistencyRatio = $consistencyIndex / $indexRandomValue[count($sumPriority)];

        /**
         * =========== Endline ===========
         *
         * by Amin
         */


        $amount = AlternativeSingleComparison::where('criteria_id', '=', $request->criteria_id)->select(DB::raw('sum(score) as total_sum'))->groupBy('alternative2_id')->get();


        if (request('criteria')) {
            $criteria = Criteria::firstWhere('slug', request('criteria'));
            $title = $criteria->criteria;
        }

        return view('dashboard.alternativecomparison.process', [
            "cl" => $cl,
            "scl" => $scl,
            "sp" => $sp,
            "ranked" => $ranked,
            "columns" => $columns,
            "rows" => $rows,
            "supportRows" => $supportRows,
            "supportColumns" => $supportColumns,
            "normalization" => $normalization,
            "lamdaMax" => $lamdaMax,
            "consistencyIndex" => $consistencyIndex,
            "consistencyRatio" => $consistencyRatio,
            "sums" => $amount,
            "title" => $title,
            "criterias" => Criteria::filter(request(['search', 'decision', 'criteria']))->paginate(20),
            "alternatives" => $alternatives
        ]);
    }

    public function priority(Request $request)
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
            Pvalternative::updateOrCreate(
                ['criteria_id' => $input['criteria_id'][$key], 'alternative_id' => $input['alternative_id'][$key]],
                [
                    'criteria_id' => $input['criteria_id'][$key],
                    'alternative_id' => $input['alternative_id'][$key],
                    'score' => $input['score'][$key],
                ]
            );
        }

        return redirect('/dashboard/alternativecomparison')->with('success', 'Data telah diisi');
    }

    public function result()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $pvcriterias = Pvcriteria::all();
        $pvalternatives = Pvalternative::all();
        $alternativecomparisons = AlternativeSingleComparison::orderBy('criteria_id', 'asc')->get();

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
        // dd($rw);

        $rowAlternatives = [];
        $columnAlternatives = [];
        foreach ($pvalternatives as $key => $pvalternative) {
            if (!isset($rowAlternatives[$pvalternative->alternative_id])) {
                $rowAlternatives[$pvalternative->alternative_id] = [];
            }

            if (!in_array($pvalternative->criteria_id, $columnAlternatives)) {
                $columnAlternatives[] = $pvalternative->criteria_id;
            }
            $rowAlternatives[$pvalternative->alternative_id][$pvalternative->criteria_id] = $pvalternative->score;
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
            $sorted = collect($ranking)->sortBy('ranking')->reverse()->toArray();
        }


        return view('dashboard.alternativecomparison.resultalternative', [
            "columns" => $columns,
            "rows" => $rows,
            "rowAlternatives" => $rowAlternatives,
            "columnAlternatives" => $columnAlternatives,
            "normalization" => $normalization,
            "sumpriority" => $sumPriority,
            "a" => $sorted,
            "criterias" => $criterias,
            "alternatives" => $alternatives,
            "pvcriterias" => $pvcriterias,
            "pvalternatives" => $pvalternatives,
            "alternativecomparisons" => $alternativecomparisons
        ]);
    }
}
