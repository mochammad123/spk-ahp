<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\CriteriaComparison;
use App\Models\Pvcriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class CriteriaComparisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterias = Criteria::all();

        return view('dashboard.criteriacomparison.show', [
            "criterias" => $criterias
        ]);
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
        // dd($request);
        $input = $request->all();


        $validator = Validator::make($input, [
            'criteria_id' => 'required',
            'score' => 'required',
            'criteria2_id' => 'required',
            'chose' => 'required'
        ]);



        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            CriteriaComparison::updateOrCreate(
                ['criteria_id' => $input['criteria_id'][$key], 'criteria2_id' => $input['criteria2_id'][$key]],
                [
                    'criteria_id' => $input['criteria_id'][$key],
                    'score' => $input['score'][$key],
                    'criteria2_id' => $input['criteria2_id'][$key]
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CriteriaComparison  $criteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function show(CriteriaComparison $criteriaComparison)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CriteriaComparison  $criteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function edit(CriteriaComparison $criteriaComparison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CriteriaComparison  $criteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CriteriaComparison $criteriaComparison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CriteriaComparison  $criteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function destroy(CriteriaComparison $criteriaComparison)
    {
        //
    }

    public function process(Request $request)
    {
        // dd($request);
        $this->store($request);


        $records = CriteriaComparison::orderBy('criteria2_id')->orderBy('criteria_id')->get();
        $criterias = Criteria::pluck('criteria')->all();
        $rows = [];
        $columns = [];

        foreach ($records as $key => $record) {
            if (!isset($rows[$record->criteria_id])) {
                $rows[$record->criteria_id] = [];
            }

            if (!in_array($record->criteria2_id, $columns)) {
                $columns[] = $record->criteria2_id;
            }
            $rows[$record->criteria_id][$record->criteria2_id] = $record->score;
        }

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
                $cl = $columns;
                $sp[$key] = $row["priority"];
                $ranking[$key]["ranking"] = $row["priority"];
                $ranked = collect($ranking)->sortBy('ranking')->reverse()->toArray();
            }
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


        $amount = CriteriaComparison::select(DB::raw('sum(score) as total_sum'))->groupBy('criteria2_id')->get();


        if (request('criteria')) {
            $criteria = Criteria::firstWhere('slug', request('criteria'));
            $title = $criteria->criteria;
        }

        return view('dashboard.criteriacomparison.process', [
            "cl" => $cl,
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
            "crite" => $criterias,
            "ccomparisons" => CriteriaComparison::filter(request(['search', 'decision', 'criteria']))->paginate(20),
            "criterias" => Criteria::filter(request(['search', 'decision', 'criteria']))->paginate(20)
        ]);
    }

    public function priority(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'criteria_id' => 'required',
            'score' => 'required'
        ]);



        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            Pvcriteria::updateOrCreate(
                ['criteria_id' => $input['criteria_id'][$key]],
                [
                    'criteria_id' => $input['criteria_id'][$key],
                    'score' => $input['score'][$key],
                ]
            );
        }

        return redirect('/dashboard/criteriacomparisons')->with('success', 'Data telah diisi');
    }
}
