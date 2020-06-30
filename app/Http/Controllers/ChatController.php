<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $user = Auth::user();

        //get users except user
        $users = User::where('id', '<>', $user->id)->get();

        //redirect to chat _user_select view
        return view('chat_user_select', compact('users'));
    }

    //チャットの画面
    public function index(Request $request, $recieve)
    {
        $loginId = Auth::id();

        $param = [
            'send' => $loginId,
            'recieve' => $recieve,
        ];

        //送信・受診のmessageを取得する
        $query = Comment::where('send', $loginId)->where('recieve', $recieve);
        $query->orWhere(function ($query) use ($loginId, $recieve) {
            $query->where('send', $recieve);
            $query->where('recieve', $loginId);
        });

        $message = $query->get();

        return view('chat', compact('param', 'message'));
    }

    /**
     * Store messages
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insertParam = [
            'send' => $request->input('send'),
            'receive' => $request->input('recieve'),
            'message' => $request->input('message'),
        ];

        try{
            Comment::insert($insertParam);
        } catch (\Exception $e){
            return false;
        }

        //イベント発火
        event(new ChatMessageRecieved($request->all()));

        //メール送信
        //$mailSenfUser = User::where('id', $request->input('recieve'))->first();
        //$to = $mailSenfUser->email();
        Mail::to('milan.cho61@gmail.com')->send(new SampleNotification());

        return true;

    }
}
