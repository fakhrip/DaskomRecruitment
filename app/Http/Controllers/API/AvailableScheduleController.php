<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AvailableSchedule;
use App\Schedule;
use App\Tahap;
use App\Http\Resources\AvailableSchedule as AvailableScheduleResource;

class AvailableScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availableSchedule = AvailableSchedule::where('tahap', Tahap::find(1)->tahapan)->get();
        return AvailableScheduleResource::collection($availableSchedule);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->user()->nim == '123132'){

            $availableSchedule = new AvailableSchedule;
            $availableSchedule->tahap = $request->input('tahap');
            $availableSchedule->remaining_quota = $request->input('quota');
            $availableSchedule->available_shift = $request->input('shift');
            $availableSchedule->ruangan = $request->input('ruangan');
            $availableSchedule->schedule = $request->input('schedule');
            $availableSchedule->save();

            return '{"response": "success"}';
        } else {
            return '{"response": "You are not admin"}';
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
