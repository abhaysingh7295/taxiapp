<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Carrentcompanie;
use DB;

class CompanyResource extends Controller {

    public function __construct() {
        $this->middleware('demo', ['only' => ['store', 'update','create', 'destroy']]);
        $this->perpage = config('constants.per_page', '10');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!empty($request->page) && $request->page == 'all') {
            $company = Carrentcompanie::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $company));
        } else {
            if ($request->has('name')) {
                $company = Carrentcompanie::orderBy('created_at', 'desc')
                        ->where('name', 'like', '%' . $request->get('name') . '%')
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($company);
                return view('admin.company.index', compact('company', 'pagination'));
            } else {
                $company = Carrentcompanie::orderBy('created_at', 'desc')->paginate($this->perpage);
                //echo "<pre>"; print_r($company); die;
                $pagination = (new Helper)->formatPagination($company);
                return view('admin.company.index', compact('company', 'pagination'));
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
        return view('admin.company.create', compact('countries'));
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
            'email' => 'required|unique:providers,email|email|max:255',
            'address' => 'required|max:25',
            'country' => 'required|max:25',
            'city' => 'required|max:25',
            'phone' => 'digits_between:6,13',
        ]);

        try {

            $company = $request->all();
            $$company = Carrentcompanie::create($company);
            return back()->with('flash_success', 'Company information added Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', $e->getMessage());
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

            $company = Carrentcompanie::findOrFail($id);
            $countries = DB::table("countries")->pluck("name", "id");
            return view('admin.company.edit', compact('company', 'countries'));
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
            'address' => 'required|max:25',
            'country' => 'required|max:25',
            'city' => 'required|max:25',
            'phone' => 'digits_between:6,13',
        ]);
        try {
            $company = Carrentcompanie::findOrFail($id);
            $company->name = $request->name;
            $company->address = $request->address;
            $company->country = $request->country;
            $company->city = $request->city;
            $company->phone = $request->phone;
            $company->save();
            return back()->with('flash_success', 'Company information updated Successfully');
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

            Carrentcompanie::find($id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Erorr');
        }
    }

}
