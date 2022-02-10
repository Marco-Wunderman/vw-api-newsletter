<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
            'name' => 'required|regex:/^[\pL\pM\p{Zs}.-]+$/u',
            'email' => ['required', 'unique:subscribers', 'email:rfc,dns', function ($attributte, $value, $fail) {
                $chunkmail = explode("@", $value);
                if (strpos($chunkmail[1], "test")) {
                    $fail("Correo electrónico invalido");
                }
            }],
            'notice_of_privacy' => 'required|integer|min:1|max:1'
        );
        $messages = array(
            'name.regex' => 'El formato del nombre es incorrecto.',
            'name.required' => 'Por favor ingresa un nombre',
            'email.required' => 'Por favor ingresa un correo electrónico.',
            'notice_of_privacy.required' => 'Se debe aceptar el Aviso de Privacidad.',
            'email.unique' => 'Lo sentimos este correo electrónico ya fue registrado.',
            'email.email' => 'Formato de correo electrónico incorrecto.',
            'email.rfc' => 'Formato de correo electrónico incorrecto.',
            'notice_of_privacy.min' => 'Se debe aceptar el Aviso de Privacidad.',
            'notice_of_privacy.max' => 'Se debe aceptar el Aviso de Privacidad.',
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors(), "status" => 400], 400);
        } else {
            $email = mb_strtolower($request->email);
            $name = mb_strtolower($request->name);
            $name = ucwords($name);
            $uniqid = $this->generateIdUnique();
            $request->merge(['email' => $email]);
            $request->merge(['name' => $name]);
            $request->request->add(['uniqueid' => $uniqid]);
            $subscriber = Subscriber::create($request->all());
            $subscriber->status = 200;
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
