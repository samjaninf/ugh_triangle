<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nots = Notification::own()->orderBy('created_at', 'DESC')->paginate(20);
        return view('app.notifications.index', compact('nots'));
    }

    /**
     * Returns the number of notifications that haven't been seen
     * @return int
     */
    public function count()
    {
        return \Auth::user()->getNotificationsCount();
    }

    /*
     * Loads last 3 notifications
     * @return mixed
     */
    public function loadLast()
    {
        $nots = Notification::own()->orderBy('created_at', 'DESC')->where('is_read', 0)->limit(3)->get();
        return view('app.notifications.last', compact('nots'));
    }

    /**
     * Changes a notification status from not seen to seen
     */
    public function seen()
    {
        $id = \Request::input('id');
        $not = Notification::findOrFail($id);
        $not->is_read = 1;
        $not->save();
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->seen();
        return view('app.notifications.show', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
