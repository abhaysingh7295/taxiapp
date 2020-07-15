<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Citie;
use DB;

class CitiesResource extends Controller {

    public function __construct() {
        $this->middleware('demo', ['only' => ['store', 'update', 'destroy']]);
        $this->perpage = config('constants.per_page', '10');
    }

    public function index(Request $request) {
        if (!empty($request->page) && $request->page == 'all') {
            $citie = Citie::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $citie));
        } else {
            if ($request->has('name')) {
                $citie = Citie::orderBy('created_at', 'desc')
                        ->where('name', 'like', '%' . $request->get('name') . '%')
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($citie);
                return view('admin.city.index', compact('citie', 'pagination'));
            } else {
                $citie = Citie::orderBy('created_at', 'desc')->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($citie);
                return view('admin.city.index', compact('citie', 'pagination'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries = DB::table("countries")->pluck("name", "id");
        return view('admin.city.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'country' => 'required|max:255',
        ]);
        try {
            $cities = $request->all();
            $cities['country_id'] = $request->country;
            Citie::create($cities);
            return back()->with('flash_success', 'City added Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Not Found');
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

            $cities = Citie::findOrFail($id);
            $countries = DB::table("countries")->pluck("name", "id");
            return view('admin.city.edit', compact('cities', 'countries'));
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
            'name' => 'required|max:255',
            'country' => 'required|max:255',
        ]);
        try {
            $cities = Citie::findOrFail($id);
            $cities->name = $request->name;
            $cities->country_id = $request->country;
            $cities->save();
            return back()->with('flash_success', 'City Updated Successfully');
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

            Citie::find($id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Erorr');
        }
    }

}
