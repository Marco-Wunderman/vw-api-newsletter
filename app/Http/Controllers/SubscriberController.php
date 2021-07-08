<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|unique:subscribers|email',
            'notice_of_privacy' => 'required|integer|min:1|max:1'
        );
        $messages = array(
            'name.required' => 'Por favor ingresa un nombre',
            'email.required' => 'Por favor ingresa un correo electrónico.',
            'notice_of_privacy.required' => 'Se debe aceptar el Aviso de Privacidad.',
            'email.unique' => 'Lo sentimos este correo electrónico ya fue registrado.',
            'email.email' => 'Formato de correo electrónico incorrecto.',
            'notice_of_privacy.min' => 'Se debe aceptar el Aviso de Privacidad.',
            'notice_of_privacy.max' => 'Se debe aceptar el Aviso de Privacidad.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 400);
        } else {
            $subscriber = Subscriber::create($request->all());
            return response()->json($subscriber, 200);
        }
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
}
