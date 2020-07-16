<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Carrentreservation;
use DB;
class RreservationsResource extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request->page) && $request->page == 'all') {
            $reservation = Carrentreservation::orderBy('id', 'asc')->get();
            return response()->json(array('success' => true, 'data' => $reservation));
        } else {
            if ($request->has('name')) {
                 $reservation = Carrentreservation::orderBy('created_at', 'desc')
                        ->where('name', 'like', '%' . $request->get('name') . '%')
                        ->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($reservation);
                return view('admin.reservation.index', compact('reservation', 'pagination'));
            } else {
                $reservation = Carrentreservation::orderBy('created_at', 'desc')->paginate($this->perpage);
                $pagination = (new Helper)->formatPagination($reservation);
                return view('admin.reservation.index', compact('reservation', 'pagination'));
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
