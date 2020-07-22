<?php

namespace App\Http\Controllers\resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Helper;
use App\Vehicle;
use App\Document;
use DB;
use App\VehicleDocument;
use App\Provider;
use Illuminate\Support\Facades\Log;
use Setting;
use Illuminate\Support\Facades\Storage;

class VehicleReource extends Controller {

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
            $vehicle = Vehicle::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $vehicle));
        } else {
            if ($request->has('name')) {
                $vehicle = Vehicle::orderBy('created_at', 'desc')
                        ->where('make', 'like', '%' . $request->get('name') . '%')
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($vehicle);
                return view('admin.vehicle.index', compact('vehicle', 'pagination'));
            } else {
                $vehicle = Vehicle::orderBy('created_at', 'desc')->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($vehicle);
                return view('admin.vehicle.index', compact('vehicle', 'pagination'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.vehicle.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'make' => 'required|max:255',
            'model' => 'required|max:255',
            'color' => 'required|max:255',
            'registrationNumber' => 'required',
            'registration_expire' => 'required',
            'PHCLicenceNumber' => 'required',
            'seatType' => 'required',
        ]);
        try {
            $vehicles = $request->all();
            Vehicle::create($vehicles);
            return back()->with('flash_success', 'Information added Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
            $vehicle = Vehicle::findOrFail($id);
            //print_r($cars); die;
            return view('admin.vehicle.edit', compact('vehicle'));
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
            'make' => 'required|max:255',
            'model' => 'required',
            'color' => 'required',
            'registrationNumber' => 'required',
            'registration_expire' => 'required',
            'PHCLicenceNumber' => 'required',
            'seatType' => 'required|max:255'
        ]);
        try {
            ;

            $vehicle = Vehicle::findOrFail($id);
            $vehicle->make = $request->make;
            $vehicle->model = $request->model;
            $vehicle->color = $request->color;
            $vehicle->registrationNumber = $request->registrationNumber;
            $vehicle->registration_expire = $request->registration_expire;
            $vehicle->PHCLicenceNumber = $request->PHCLicenceNumber;
            $vehicle->seatType = $request->seatType;
            $vehicle->save();
            return back()->with('flash_success', 'Information Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Not Found');
        }
    }

    public function destroy($id) {
        try {

            Vehicle::find($id)->delete();
            return back()->with('message', 'Deleted Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'Erorr');
        }
    }

    public function vehiclechecklist($id) {

        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicle.vehicle_checklist', compact('vehicle'));
    }

    public function updatevehiclechecklist(Request $request, $id) {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update(['is_logo' => $request['is_logo'], 'is_ft' => $request['is_ft'], 'is_pt' => $request['is_pt'], 'is_schedule' => $request['is_schedule'], 'is_notes' => $request['is_notes'], 'is_induction' => $request['is_induction'], 'is_companyscar' => $request['is_companyscar']]);
        return redirect()->route('admin.vehicles.index')->with('flash_success', 'Checklist updated successfully');
    }

    public function vehicledocuments($id) {
        $vehicle = Vehicle::findOrFail($id);
        $VehicleDocuments = Document::vehicle()->get();
        return view('admin.vehicle.document.index', compact('vehicle', 'VehicleDocuments'));
    }

    public function updatevehicledocuments(Request $request, $id, $vehicleid) {
        $vehicle = Vehicle::findOrFail($vehicleid);
        $this->validate($request, [
            'document' => 'mimes:jpg,jpeg,png',
        ]);
        try {
            $Document = VehicleDocument::where('vehicle_id', $vehicle->id)
                    ->where('document_id', $id)->with('vehicle')->with
                            ('document')
                    ->firstOrFail();
            Storage::delete($Document->url);

            $filename = str_replace(" ", "", $Document->document->name);

            $ext = $request->file('document')->guessExtension();

            $path = $request->file('document')->storeAs(
                    "vehicle/documents/" . $Document->vehicle_id, $filename . '.' . $ext
            );

            $Document->update([
                'url' => $path,
                'status' => 'ASSESSING',
            ]);
        } catch (ModelNotFoundException $e) {
            $document = Document::find($id);

            $filename = str_replace(" ", "", $document->name);
            $ext = $request->file('document')->guessExtension();
            $path = $request->file('document')->storeAs(
                    "vehicle/documents/" . $vehicle->id, $filename . '.' . $ext
            );
            VehicleDocument::create([
                'url' => $path,
                'vehicle_id' => $vehicle->id,
                'document_id' => $id,
                'status' => 'ASSESSING',
            ]);
        }
        return redirect()->route('admin.vehicles.vehicledocuments', $vehicle->id)->with('flash_success', 'Document updated successfully');
    }

    public function viewvehicledocument($vehicleid, $id) {
        try {
            $Document = VehicleDocument::where('vehicle_id', $vehicleid)
                    ->findOrFail($id);
            return view('admin.vehicle.viewvehicledocument', compact('Document'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('admin.vehicles.vehicledocuments', $id);
        }
    }

    public function approvevehicledocument(Request $request,$vehicleid, $id) {
        try {
            $Document = VehicleDocument::where('vehicle_id', $vehicleid)
                    ->findOrFail($id);
            $Document->update(['status' => 'ACTIVE']);

            return redirect()
                            ->route('admin.vehicles.vehicledocuments',$vehicleid)
                            ->with('flash_success', 'Document has been approved');
        } catch (ModelNotFoundException $e) {
            return redirect()
                            ->route('admin.vehicles.vehicledocuments',$vehicleid)
                            ->with('flash_error', trans('admin.provider_msgs.document_not_found'));
        }
    }
    
    public function destroyvehicledocument($vehicle, $id)
    { 
        try {
            $Document = VehicleDocument::findOrFail($id);
            $Document->delete();
            //Vehicle::where('id', $vehicle)->update(['status' => 'document']);
            return redirect()
                            ->route('admin.vehicles.vehicledocuments',$vehicle)
                            ->with('flash_success', 'Document has been deleted');
        } catch (ModelNotFoundException $e) {
            return redirect()
                 ->route('admin.vehicles.vehicledocuments',$vehicle)
                ->with('flash_error', trans('admin.provider_msgs.document_not_found'));
        }
    }

}
