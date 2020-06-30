@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        </div>
    </div>

    {{-- チャットルーム  --}}
    <div id="room">
        @foreach($message as $key => $message)
        {{-- 送信したメッセージ  --}}
        @if($message->send == \Illuminate\Support\Facades\Auth::id())
        <div class="send" style="text-align: right">
            <p>{{$message->message}}</p>
        </div>

        @endif

        {{-- 受信したメッセージ  --}}
        @if($message->recieve == \Illuminate\Support\Facades\Auth::id())
        <div class="recieve" style="text-align: left">
            <p>{{$message->message}}</p>
        </div>
        @endif
        @endforeach
    </div>

    <input type="text" id="text">
    <input type="submit" value="送信" id="btn_send">

</div>

@endsection