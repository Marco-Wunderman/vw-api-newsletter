<?php

namespace App\Http\Controllers;


use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSubscriberRequest;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(StoreSubscriberRequest $request)
    {
        $email = mb_strtolower($request->email);
        $name = mb_strtolower($request->name);
        $name = ucwords($name);
        $uniqid = $this->generateIdUnique();
        $request->merge(['email' => $email]);
        $request->merge(['name' => $name]);
        $request->merge(['uniqueid' => $uniqid]);
        $subscriber = Subscriber::create($request->all());
        $subscriber->status = 200;
        return response()->json($subscriber, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }

    private function generateIdUnique()
    {
        $id = "MX-" . date('shmdy') . substr(uniqid(), 9, 12);

        if ($this->IdUniqueExists($id)) {
            return $this->generateIdUnique();
        }
        return $id;
    }

    private function IdUniqueExists($uniqueID)
    {
        return Subscriber::whereuniqueid($uniqueID)->exists();
    }
}
