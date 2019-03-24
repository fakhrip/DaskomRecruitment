<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Status;
use App\Tahap;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $tahap = Tahap::find(1)->tahapan;
        $user = Status::where('user_id', $request->user()->id)->first(); 
        switch($tahap){
            case 1: 
                $number = $user->tahap_berkas;
                break;
            case 2:
                $number = $user->tahap_tes;
                break;
            case 3:
                $number = $user->tahap_wawancara;
                break;
            case 4:
                $number = $user->tahap_tucil;
                break;
            case 5:
                $number = $user->tahap_teaching;
                break;
            case 6:
                $number = $user->tahap_upgrading;
                break;
        }

        //check for fail stage
        if($user->tahap_berkas == 3 ||
            $user->tahap_tes == 3 ||
            $user->tahap_wawancara == 3 ||
            $user->tahap_tucil == 3 ||
            $user->tahap_teaching == 3 ||
            $user->tahap_upgrading == 3){

            return '{"response": "3"}';
        }
        return '{"response": "'. $number .'"}';
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

            $users = User::all();
            foreach ($users as $user) {

                if($request->input('nim') == 'all'){
                    if($request->input('tahapan') == '1' && $request->input('status') == '0'){
                        //ASSUMMED AS NEWLY CREATED
                        $status = new Status;
                        $status->user_id = $user->id;
                    } else {
                        $status = Status::where('user_id', $user->id)->first();
                    }
                } else {
                    $nims   = preg_split('/\s+/', $request->input('nim'));
                    if(in_array($user->nim, $nims)){
                        $status = Status::where('user_id', $user->id)->first();
                    } else {
                        $status = "nope";
                    }
                }

                if($status != "nope"){

                    switch($request->input('tahapan')){
                        case 1: 
                            $status->tahap_berkas = $request->input('status');
                            break;
                        case 2:
                            $status->tahap_tes = $request->input('status');
                            break;
                        case 3:
                            $status->tahap_wawancara = $request->input('status');
                            break;
                        case 4:
                            $status->tahap_tucil = $request->input('status');
                            break;
                        case 5:
                            $status->tahap_teaching = $request->input('status');
                            break;
                        case 6:
                            $status->tahap_upgrading = $request->input('status');
                            break;
                    }
                    $status->save();
                }
            }

            return redirect('/caas');
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
