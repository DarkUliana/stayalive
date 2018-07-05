<?php

namespace App\Http\Controllers\Admin;

use App\Description;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $notifications = Notification::latest()->paginate($perPage);
        } else {
            $notifications = Notification::latest()->paginate($perPage);
        }


        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $descriptions = Description::all();

        return view('admin.notifications.create', compact('descriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Notification::create($requestData);

        return redirect('notifications')->with('flash_message', 'Notification added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);

        return view('admin.notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $descriptions = Description::all();

        return view('admin.notifications.edit', compact('notification', 'descriptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        if ($requestData['isSimple']) {

            $requestData['expirationDate'] = null;
        }

        $notification = Notification::findOrFail($id);
        $notification->update($requestData);

        return redirect('notifications')->with('flash_message', 'Notification updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Notification::destroy($id);

        return redirect('notifications')->with('flash_message', 'Notification deleted!');
    }
}
