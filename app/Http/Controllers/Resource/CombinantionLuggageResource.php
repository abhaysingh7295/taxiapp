<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Vehicleluggage;
use App\Vehicle_seattype;
use Validator;
use DB;

class CombinantionLuggageResource extends Controller {

    public function __construct() {
        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
        $this->perpage = config('constants.per_page', '10');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!empty($request->page) && $request->page == 'all') {
            $vehicleluggage = Vehicleluggage::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $vehicleluggage));
        } else {
            if ($request->has('name')) {
                $search = $request->get('name');
                $vehicleluggage = Vehicleluggage::orderBy('created_at', 'desc')
                        ->where('NumberPassengers', 'like', '%' . $request->get('name') . '%')
                        ->orwhere('LargeLuggages', 'like', '%' . $request->get('name') . '%')
                        ->orwhere('SmallLuggages', 'like', '%' . $request->get('name') . '%')
                        ->orWhereHas('Vehicle_seattype', function($q) use($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        })
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($vehicleluggage);
                return view('admin.luggage.index', compact('vehicleluggage', 'pagination'));
            } else {
                $vehicleluggage = Vehicleluggage::orderBy('created_at', 'desc')->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($vehicleluggage);
                return view('admin.luggage.index', compact('vehicleluggage', 'pagination'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.luggage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->ajax()) {
            $rules = array(
                'NumberPassengers.*' => 'required',
                'LargeLuggages.*' => 'required',
                'SmallLuggages.*' => 'required',
                'seattype' => 'required',
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                            'error' => $error->errors()->all()
                ]);
            }

            $NumberPassengers = $request->NumberPassengers;
            $LargeLuggages = $request->LargeLuggages;
            $SmallLuggages = $request->SmallLuggages;
            $seattype = $request->seattype;
            for ($count = 0; $count < count($NumberPassengers); $count++) {
                $data = array(
                    'NumberPassengers' => $NumberPassengers[$count],
                    'LargeLuggages' => $LargeLuggages[$count],
                    'SmallLuggages' => $SmallLuggages[$count],
                    'seattype' => $seattype,
                );
                $insert_data[] = $data;
            }

            Vehicleluggage::insert($insert_data);
            return response()->json([
                        'success' => 'Data Added successfully.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $seater = Vehicleluggage::findOrFail($id);
            return view('admin.luggage.edit', compact('seater'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'NumberPassengers' => 'required',
            'LargeLuggages' => 'required',
            'SmallLuggages' => 'required',
            'seattype' => 'required',
        ]);
        try {
            $seater = Vehicleluggage::findOrFail($id);
            $seater->NumberPassengers = $request->NumberPassengers;
            $seater->LargeLuggages = $request->LargeLuggages;
            $seater->SmallLuggages = $request->SmallLuggages;
            $seater->seattype = $request->seattype;
            $seater->save();
            return back()->with('flash_success', 'Information Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {

            Vehicleluggage::find($id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Erorr');
        }
    }

}
