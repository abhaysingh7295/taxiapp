<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Carrentcartype;
use DB;

class CartypeResource extends Controller {

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
            $cartype = Carrentcartype::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $cartype));
        } else {
            if ($request->has('name')) {
                $cartype = Carrentcartype::orderBy('created_at', 'desc')
                        ->where('name', 'like', '%' . $request->get('name') . '%')
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($cartype);
                return view('admin.cartype.index', compact('cartype', 'pagination'));
            } else {
                $cartype = Carrentcartype::orderBy('created_at', 'desc')->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($cartype);
                return view('admin.cartype.index', compact('cartype', 'pagination'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.cartype.create');
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
            'description' => 'required|max:255',
        ]);
        try {
            $carType = $request->all();
            Carrentcartype::create($carType);
            return back()->with('flash_success', 'Car Type added Successfully');
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

            $cartype = Carrentcartype::findOrFail($id);
            return view('admin.cartype.edit', compact('cartype'));
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
            'description' => 'required|max:255',
        ]);
        try {
            $cartype = Carrentcartype::findOrFail($id);
            $cartype->name = $request->name;
            $cartype->description = $request->description;
            $cartype->save();
            return back()->with('flash_success', 'Car Type Updated Successfully');
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

            Carrentcartype::find($id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Erorr');
        }
    }

}
