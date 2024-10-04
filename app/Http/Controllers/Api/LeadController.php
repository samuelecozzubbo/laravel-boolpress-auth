<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;


class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $success = true;
        //VALIDAZIONE
        $validator = Validator::make(
            $data,
            [
                'name' => 'required|string|max:100',
                'email' => 'required|email',
                'message' => 'required|string|min:10',
            ],
            [
                'name.required' => 'Il campo nome è obbligatorio.',
                'name.string' => 'Il nome deve essere una stringa.',
                'name.max' => 'Il nome non può superare i :max caratteri.',
                'email.required' => 'Il campo email è obbligatorio.',
                'email.email' => 'Inserisci un indirizzo email valido.',
                'message.required' => 'Il campo messaggio è obbligatorio.',
                'message.string' => 'Il messaggio deve essere una stringa.',
                'message.min' => 'Il messaggio deve contenere almeno 10 caratteri.',
            ]
        );

        if ($validator->fails()) {
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }
        //salviamo il messaggio nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();
        //inviamo la mail
        Mail::to($new_lead->email)->send(new NewContact($new_lead));
        return response()->json(compact('success'));
    }
}
