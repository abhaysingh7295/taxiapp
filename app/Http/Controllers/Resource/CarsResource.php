<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Helper;
use App\Carrentcar;
use DB;
class CarsResource extends Controller
{
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
            $cars = Carrentcar::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $cars));
        } else {
            if ($request->has('name')) {
                $cars = Carrentcar::orderBy('created_at', 'desc')
                        ->where('name', 'like', '%' . $request->get('name') . '%')
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($cars);
                return view('admin.cars.index', compact('cars', 'pagination'));
            } else {
                $cars = Carrentcar::orderBy('created_at', 'desc')->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($cars);
                return view('admin.cars.index', compact('cars', 'pagination'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'VehiclesTitle' => 'required|max:255',
            'VehiclesType' => 'required',
            'company_id' => 'required',
            'PricePerDay' => 'required',
            'FuelType' => 'required',
            'ModelYear' => 'required',
            'SeatingCapacity' => 'required',
           
        ]);
        try {
            $cars = $request->all();
            Carrentcar::create($cars);
            return back()->with('flash_success', 'Car Information added Successfully');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         try {
            $cars = Carrentcar::findOrFail($id);
            //print_r($cars); die;
            return view('admin.cars.edit', compact('cars'));
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'VehiclesTitle' => 'required|max:255',
            'VehiclesType' => 'required',
            'company_id' => 'required',
            'PricePerDay' => 'required',
            'FuelType' => 'required',
            'ModelYear' => 'required|max:255',
            'SeatingCapacity' => 'required',
           
        ]);
        try {
            $cars = Carrentcar::findOrFail($id);
            $cars->VehiclesTitle = $request->VehiclesTitle;
            $cars->VehiclesType = $request->VehiclesType;
            $cars->company_id = $request->company_id;
            $cars->PricePerDay = $request->PricePerDay;
            $cars->FuelType = $request->FuelType;
            $cars->ModelYear = $request->ModelYear;
            $cars->SeatingCapacity = $request->SeatingCapacity;
            $cars->VehiclesOverview = $request->VehiclesOverview;
            $cars->AirConditioner = $request->AirConditioner;
            $cars->PowerDoorLocks = $request->PowerDoorLocks;
            $cars->AntiLockBrakingSystem = $request->AntiLockBrakingSystem;
            $cars->BrakeAssist = $request->BrakeAssist;
            $cars->PowerSteering = $request->PowerSteering;
            $cars->DriverAirbag = $request->DriverAirbag;
            $cars->PassengerAirbag = $request->PassengerAirbag;
            $cars->PowerWindows = $request->PowerWindows;
            $cars->CDPlayer = $request->CDPlayer;
            $cars->CentralLocking = $request->CentralLocking;
            $cars->CrashSensor = $request->CrashSensor;
            $cars->LeatherSeats = $request->LeatherSeats;
            $cars->save();
            return back()->with('flash_success', 'Car Information Updated Successfully');
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
    public function destroy($id)
    {
        try {

            Carrentcar::find($id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Erorr');
        }
    }
}
