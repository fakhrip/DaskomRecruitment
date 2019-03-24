<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Tahap;
use App\AvailableSchedule;
use App\Http\Resources\Schedule as ScheduleResource;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Schedule::where([
            ['user_id', $request->user()->id],
            ['tahap', Tahap::find(1)->tahapan],
        ])->exists()){
            return Schedule::where([
                ['user_id', $request->user()->id],
                ['tahap', Tahap::find(1)->tahapan],
            ])->first();
        }
        return '{"response": "null"}';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Schedule::where([
            ['user_id', $request->user()->id],
            ['tahap', Tahap::find(1)->tahapan],
        ])->exists()){
            $beforeSchedule = Schedule::where([
                ['user_id', $request->user()->id],
                ['tahap', Tahap::find(1)->tahapan],
            ])->first();

            if($beforeSchedule->schedule == $request->input('schedule') && 
                $beforeSchedule->ruangan == $request->input('ruangan') && 
                $beforeSchedule->shift == $request->input('available_shift')){

                return '{"response": "same request"}';
            }

            $availablebeforeSchedule = AvailableSchedule::where([
                ['tahap', Tahap::find(1)->tahapan],
                ['schedule', $beforeSchedule->schedule],
                ['ruangan', $beforeSchedule->ruangan],
                ['available_shift', $beforeSchedule->shift]
            ])->first();

            if($availablebeforeSchedule->remaining_quota > 0){

                $availablebeforeSchedule->remaining_quota += 1;
                $availablebeforeSchedule->save();
    
                $beforeSchedule->schedule = $request->input('schedule');
                $beforeSchedule->ruangan = $request->input('ruangan');
                $beforeSchedule->shift = $request->input('available_shift');
                $beforeSchedule->save();
    
                $availableSchedule = AvailableSchedule::where([
                    ['tahap', Tahap::find(1)->tahapan],
                    ['schedule', $beforeSchedule->schedule],
                    ['ruangan', $beforeSchedule->ruangan],
                    ['available_shift', $beforeSchedule->shift]
                ])->first();
    
                $availableSchedule->remaining_quota -= 1;
                $availableSchedule->save();
    
                return '{"response": "success"}';
            } else {

                return '{"response": "no more quota"}';
            }
        } else {

            $schedule = new Schedule;
            $schedule->user_id = $request->user()->id;
            $schedule->tahap = Tahap::find(1)->tahapan;
            $schedule->schedule = $request->input('schedule');
            $schedule->ruangan = $request->input('ruangan');
            $schedule->shift = $request->input('available_shift');

            $availableSchedule = AvailableSchedule::where([
                ['tahap', Tahap::find(1)->tahapan],
                ['schedule', $schedule->schedule],
                ['ruangan', $schedule->ruangan],
                ['available_shift', $schedule->shift]
            ])->first();

            if($availableSchedule->remaining_quota > 0) {

                $availableSchedule->remaining_quota -= 1;
                $availableSchedule->save();
                $schedule->save();

                return '{"response": "success"}';
            } else {
                
                return '{"response": "no more quota"}';
            }
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
