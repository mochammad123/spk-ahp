<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Pvsubcriteria;
use App\Models\Subcriteria;
use App\Models\SubcriteriaComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class SubcriteriaComparisonController extends Controller
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
        // dd($request);
        $input = $request->all();


        $validator = Validator::make($input, [
            'criteria_id' => 'required',
            'subcriteria_id' => 'required',
            'score' => 'required',
            'subcriteria2_id' => 'required',
            'chose' => 'required'
        ]);



        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            if ($input['chose'][$key] == 2) {
                SubcriteriaComparison::updateOrCreate(
                    ['criteria_id' => $input['criteria_id'][$key], 'subcriteria_id' => $input['subcriteria_id'][$key], 'subcriteria2_id' => $input['subcriteria2_id'][$key]],
                    [
                        'criteria_id' => $input['criteria_id'][$key],
                        'subcriteria_id' => $input['subcriteria_id'][$key],
                        'score' => 1 / $input['score'][$key],
                        'subcriteria2_id' => $input['subcriteria2_id'][$key]
                    ]
                );
            } else {
                SubcriteriaComparison::updateOrCreate(
                    ['criteria_id' => $input['criteria_id'][$key], 'subcriteria_id' => $input['subcriteria_id'][$key], 'subcriteria2_id' => $input['subcriteria2_id'][$key]],
                    [
                        'criteria_id' => $input['criteria_id'][$key],
                        'subcriteria_id' => $input['subcriteria_id'][$key],
                        'score' => $input['score'][$key],
                        'subcriteria2_id' => $input['subcriteria2_id'][$key]
                    ]
                );
            }
            Alert::toast('Data Berhasil Ditambahkan', 'success')->timerProgressBar();
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            if ($input['chose'][$key] == 2) {
                SubcriteriaComparison::updateOrCreate(
                    ['criteria_id' => $input['criteria_id'][$key], 'subcriteria_id' => $input['subcriteria2_id'][$key], 'subcriteria2_id' => $input['subcriteria_id'][$key]],
                    [
                        'criteria_id' => $input['criteria_id'][$key],
                        'subcriteria_id' => $input['subcriteria2_id'][$key],
                        'score' => $input['score'][$key],
                        'subcriteria2_id' => $input['subcriteria_id'][$key]
                    ]
                );
            } else {
                SubcriteriaComparison::updateOrCreate(
                    ['criteria_id' => $input['criteria_id'][$key], 'subcriteria_id' => $input['subcriteria2_id'][$key], 'subcriteria2_id' => $input['subcriteria_id'][$key]],
                    [
                        'criteria_id' => $input['criteria_id'][$key],
                        'subcriteria_id' => $input['subcriteria2_id'][$key],
                        'score' => 1 / $input['score'][$key],
                        'subcriteria2_id' => $input['subcriteria_id'][$key]
                    ]
                );
            }
            Alert::toast('Data Berhasil Ditambahkan', 'success')->timerProgressBar();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubcriteriaComparison  $subcriteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function show(SubcriteriaComparison $subcriteriaComparison, $subcriteriaId)
    {
        $criterias = Criteria::where('slug', '=', $subcriteriaId)->first();
        $id = $criterias->id;
        $title = $criterias->criteria;
        $subcriterias = Subcriteria::where('criteria_id', '=', $id)->get();

        return view('dashboard.subcriteriacomparison.show', [
            "criterias" => $criterias,
            "id" => $id,
            "title" => $title,
            "subcriterias" => $subcriterias
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubcriteriaComparison  $subcriteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function edit(SubcriteriaComparison $subcriteriaComparison)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubcriteriaComparison  $subcriteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubcriteriaComparison $subcriteriaComparison)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubcriteriaComparison  $subcriteriaComparison
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubcriteriaComparison $subcriteriaComparison)
    {
        //
    }

    public function process(Request $request)
    {
        // dd($request);
        $this->store($request);


        $records = SubcriteriaComparison::where('criteria_id', '=', $request->criteria_id)->orderBy('subcriteria2_id')->orderBy('subcriteria_id')->get();
        $subcriterias = Subcriteria::where('criteria_id', '=', $request->criteria_id)->get();
        $criterias = Criteria::where('id', '=', $request->criteria_id)->first();
        $title = $criterias->criteria;

        $rows = [];
        $columns = [];

        foreach ($records as $key => $record) {
            if (!isset($rows[$record->subcriteria_id])) {
                $rows[$record->subcriteria_id] = [];
            }

            if (!in_array($record->subcriteria2_id, $columns)) {
                $columns[] = $record->subcriteria2_id;
            }
            $rows[$record->subcriteria_id][$record->subcriteria2_id] = $record->score;
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


        $amount = SubcriteriaComparison::where('criteria_id', '=', $request->criteria_id)->select(DB::raw('sum(score) as total_sum'))->groupBy('subcriteria2_id')->get();


        if (request('criteria')) {
            $criteria = Criteria::firstWhere('slug', request('criteria'));
            $title = $criteria->criteria;
        }

        return view('dashboard.subcriteriacomparison.process', [
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
            "ccomparisons" => SubcriteriaComparison::filter(request(['search', 'decision', 'criteria']))->paginate(20),
            "criterias" => Criteria::filter(request(['search', 'decision', 'criteria']))->paginate(20),
            "subcriterias" => $subcriterias
        ]);
    }

    public function priority(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'criteria_id' => 'required',
            'subcriteria_id' => 'required',
            'score' => 'required'
        ]);



        if ($validator->fails()) {
            Alert::error('Gagal menambahkan data');
        }

        foreach ($input['criteria_id'] as $key => $value) {
            $validator->validate();
            Pvsubcriteria::updateOrCreate(
                ['criteria_id' => $input['criteria_id'][$key], 'subcriteria_id' => $input['subcriteria_id'][$key]],
                [
                    'criteria_id' => $input['criteria_id'][$key],
                    'subcriteria_id' => $input['subcriteria_id'][$key],
                    'score' => $input['score'][$key],
                ]
            );
        }

        return redirect('/dashboard/subcriteriacomparison')->with('success', 'Data telah diisi');
    }
}
