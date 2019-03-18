<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Notification as NotificationResource;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = Notification::where('recipient_id', $request->user()->id)->get();
        return NotificationResource::collection($notifications);
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

            $notification = new Notification;
            $notification->message = $request->input('message');

            try{
                $chosenuserId = User::where('nim', $request->input('nim'))->firstOrFail();
            } catch (ModelNotFoundException $e){
                return $e;
            }

            $notification->recipient_id = $chosenuserId->id;
            $notification->seen = 0;
            $notification->save();

            return redirect('caas');
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

    /**
     * Update seen all notification
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function seeAllNotification(Request $request)
    {
        $notifications = Notification::where('recipient_id', $request->user()->id)->get();
        foreach ($notifications as $notification) {
            $notification->seen = 1;
            $notification->save();
        }
        return '{"response": "success"}';
    }
}
