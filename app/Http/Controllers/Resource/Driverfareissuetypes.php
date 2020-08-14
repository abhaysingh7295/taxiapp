<?php

namespace App\Http\Controllers\Resource;

use App\Driverfareissuetype;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\DriverRequestDispute;
use App\UserRequests;
use App\Helpers\Helper;
use Carbon\Carbon;
use App\Notifications\WebPush;
use App\Http\Controllers\ProviderResources\TripController;
class Driverfareissuetypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driverfareissuetype = Driverfareissuetype::orderBy('created_at' , 'desc')->get();
        return view('admin.driverfareissues.index', compact('driverfareissuetype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.driverfareissues.create');
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
            'type' => 'required',
            'name' => 'required',           
        ]);

        try{
         
            $Driverfareissuetype = new Driverfareissuetype;
            $Driverfareissuetype->type = $request->type;
            $Driverfareissuetype->name = $request->name;
            $Driverfareissuetype->status = $request->status;                    
            $Driverfareissuetype->save();

            return back()->with('flash_success', trans('admin.driverfare_msgs.saved'));

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.driverfare_msgs.not_found'));
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
            $driverfareissuetype = Driverfareissuetype::findOrFail($id);
            return view('admin.driverfareissues.edit',compact('driverfareissuetype'));
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
            'type' => 'required',
            'name' => 'required',  
        ]);

        try {

            $Driverfareissuetype = Driverfareissuetype::findOrFail($id);

            $Driverfareissuetype->type = $request->type;
            $Driverfareissuetype->name = $request->name;                    
            $Driverfareissuetype->status = $request->status;                    
            $Driverfareissuetype->save();

            return redirect()->route('admin.driverfareissuetypes.index')->with('flash_success', trans('admin.driverfare_msgs.update'));    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.driverfare_msgs.not_found'));
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
            Driverfareissuetype::find($id)->delete();
            return back()->with('flash_success', trans('admin.driverfare_msgs.delete'));
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.driverfare_msgs.not_found'));
        }
    }
    
    public function dispute_list(Request $request)
    {
        $this->validate($request, [
            'dispute_type' => 'required'         
        ]);

        $driverfareissuetype = Driverfareissuetype::select('name')->where('type' , $request->dispute_type)->where('status' , 'active')->get();

        return $driverfareissuetype;
    }

    public function driverdisputes()
    {            
        $disputes = DriverRequestDispute::with('request')->with('user')->with('provider')->orderBy('created_at' , 'desc')->paginate($this->perpage);
        $pagination=(new Helper)->formatPagination($disputes);
       
        return view('admin.driverfaredispute.index', compact('disputes', 'pagination'));
    }

    public function driverdisputecreate()
    {
        return view('admin.driverfaredispute.create');
    }

    public function driverdisputeedit($id)
    {

        try {
            $dispute = DriverRequestDispute::with('request')->with('user')->with('provider')->findOrFail($id);
            return view('admin.driverfaredispute.edit',compact('dispute'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    public function create_dispute(Request $request)
    {

        $this->validate($request, [
            'request_id' => 'required',
            'dispute_type' => 'required', 
            'dispute_name' => 'required',        
        ]);

        try{
            $Dispute = new DriverRequestDispute();
            $Dispute->request_id = $request->request_id;
            $Dispute->dispute_type = $request->dispute_type;
            $Dispute->user_id = $request->user_id;
            $Dispute->provider_id = $request->provider_id;
            $Dispute->dispute_name = $request->dispute_name;
            if(!empty($request->dispute_other))
                $Dispute->dispute_name = $request->dispute_other;
            $Dispute->comments = $request->comments;                    
            $Dispute->save();

            UserRequests::where('id', $request->request_id)->update(['is_dispute' => 1]);

            $admin = \App\Admin::find(\Auth::user()->id);

            if($admin == null) {
                $admin = \App\Admin::whereNotNull('name')->first();
            }

            if($admin != null) {
                $admin->notify(new WebPush("Notifications", trans('admin.dispute.new_dispute'), url('/')));
            }
            
            if($request->ajax()){
                return response()->json(['message' => trans('admin.dispute_msgs.saved')]);
            }else{
                return back()->with('flash_success', trans('admin.dispute_msgs.saved'));
            }
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.dispute_msgs.not_found'));
        }
    }

    public function update_dispute(Request $request, $id)
    {

        $this->validate($request, [            
            'comments' => 'required', 
            'status' => 'required',        
        ]);

        try{

            $Dispute = DriverRequestDispute::findOrFail($id);
            $Dispute->comments = $request->comments;                    
            $Dispute->refund_amount = $request->refund_amount;

            if(!empty($request->refund_amount)){
                //create the dispute transactions
                if($Dispute->dispute_type=='user'){
                    $type=1;
                    $request_by_id=$Dispute->user_id;
                }
                else{
                    $type=0;
                    $request_by_id=$Dispute->provider_id;
                }

                (new TripController)->disputeCreditDebit($request->refund_amount,$request_by_id,$type);
            }
            
            $Dispute->status = $request->status;                    
            $Dispute->save();

            if($request->ajax()){
                return response()->json(['message' => trans('admin.dispute_msgs.saved')]);
            }else{
                return back()->with('flash_success', trans('admin.dispute_msgs.saved'));
            }
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.dispute_msgs.not_found'));
        }
    }

}
