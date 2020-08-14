<?php

namespace App\Http\Controllers\Resource;
use App\Bookingissuestype;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class Bookingissuestypes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingissuestype = Bookingissuestype::orderBy('created_at' , 'desc')->get();
        return view('admin.bookingissuestype.index', compact('bookingissuestype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.bookingissuestype.create');
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
         
            $Bookingissuestype = new Bookingissuestype;
            $Bookingissuestype->type = $request->type;
            $Bookingissuestype->name = $request->name;
            $Bookingissuestype->status = $request->status;                    
            $Bookingissuestype->save();

            return back()->with('flash_success', trans('admin.Bookingissuestype_msgs.saved'));

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.Bookingissuestype_msgs.not_found'));
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
            $bookingissuestype = Bookingissuestype::findOrFail($id);
            return view('admin.bookingissuestype.edit',compact('bookingissuestype'));
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

            $Bookingissuestype = Bookingissuestype::findOrFail($id);
            $Bookingissuestype->type = $request->type;
            $Bookingissuestype->name = $request->name;                    
            $Bookingissuestype->status = $request->status;                    
            $Bookingissuestype->save();

            return redirect()->route('admin.bookingissuetypes.index')->with('flash_success', trans('admin.Bookingissuestype_msgs.update'));    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.Bookingissuestype_msgs.not_found'));
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
            Bookingissuestype::find($id)->delete();
            return back()->with('flash_success', trans('admin.Bookingissuestype_msgs.delete'));
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', trans('admin.Bookingissuestype_msgs.not_found'));
        }
    }
}
