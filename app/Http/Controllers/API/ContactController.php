<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Base\BaseController;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends BaseController
{

    public function sendMessage(Request $request) {
        //Validamos
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'message' => 'required|string',
            'anon' => 'boolean'
        ]);
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $feedback = new Feedback();
        $feedback->type = $request->input('type');
        $feedback->message = $request->input('message');
        $feedback->user_id = $request->input('anon')? null : auth()->user()->id;
        $feedback->saveOrFail();
        return redirect(route('home'));
    }

}
