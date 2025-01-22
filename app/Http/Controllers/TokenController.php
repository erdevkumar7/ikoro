<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\TokenMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TokenController extends Controller
{
    
    public function support()
    {
        $tokens = Token::where('user_id', Auth::id())
               ->where('status', 0)
               ->get();

        return view('pages.support', get_defined_vars());
    }

    public function support_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'msg_text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $token = new Token();
        $token->title = $request->title;
        $token->user_id = Auth::id();
        $token->status = 0;
        $token->awaiting_reply = 1;
        $token->save();

        $token_message = new TokenMessage();
        $token_message->msg_text = $request->msg_text;
        $token_message->user_id = Auth::id();
        $token_message->token_id = $token->id;
        $token_message->save();
        return redirect()->route('ikoro.support');
    }

    public function support_show(Request $request, $id)
    {
        $token = Token::findOrFail($id);
        $messages = TokenMessage::with(['token', 'user'])

            ->where('token_id', $id) // Filter by token_id
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.support_chat', compact('messages','token'));
    }

    public function close_chat(Request $request, $id)
    {
        $token = Token::findOrFail($id);
        $token->status = 1;
        $token->save();
        return redirect()->route('ikoro.support');
    }

    public function admin_problems(Request $request)
    {

        $tokens = Token::with(['user', 'tokenmessages'])
            ->where('status', 0)
            ->get();


        return view('pages.admin_support_problems', compact('tokens'));
    }

    public function admin_support_view(Request $request, $tokenId)
    {
        $messages = TokenMessage::with(['token', 'user'])

            ->where('token_id', $tokenId) // Filter by token_id
            ->orderBy('created_at', 'asc')
            ->get();

        $token = Token::with(['user', 'tokenmessages'])->find($tokenId);

        return view('pages.admin_support_view', compact('token', 'messages'));
    }

    public function admin_support_store(Request $request, $tokenId)
    {
        $validator = Validator::make($request->all(), [
            'msg_text' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $token = Token::findOrFail($tokenId);
        $token->user_id = $token->user_id;

        $token->awaiting_reply = 2;
        $token->save();
        $token_admin_message = new TokenMessage();
        $token_admin_message->msg_text = $request->msg_text;
        $token_admin_message->user_id = Auth::id();
        $token_admin_message->token_id = $tokenId;
        $token_admin_message->save();
        return redirect()->route('admin.support.view',$tokenId);
    }

    public function user_reply(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'msg_text' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $token = Token::findOrFail($id);
        $token->user_id = $token->user_id;

        $token->awaiting_reply = 1;
        $token->save();
        $token_admin_message = new TokenMessage();
        $token_admin_message->msg_text = $request->msg_text;
        $token_admin_message->user_id = Auth::id();
        $token_admin_message->token_id = $id;
        $token_admin_message->save();
        return redirect()->route('ikoro.support.show',$id);
    }
}
