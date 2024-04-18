<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

use Response;
use App\Models\Chat;
use App\Models\ChatConfig;
use App\Models\ChatHistory;
use App\Models\Agency;
use App\Models\Client;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->json()->all();

        $chat = Chat::where('uid', $data['uid'])->first();
        $agency = Agency::where('uid', $data['agency_uid'])->first();
        $client = Client::where('uid', $data['client_uid'])->first();

        $prompt = [
            'role' => 'user',
            'content' => $data['content'],
        ];

        //no chat history
        if(!$chat){
            $chat = new Chat();
            $chat->agency_id = $agency->id;
            $chat->client_id = $client->id;
            
            if($chat->save()) {

                $chatHistory = new ChatHistory();
                $chatHistory->chat_id = $chat->id;
                $chatHistory->role = "user";
                $chatHistory->content = $data['content'];
                $chatHistory->save();

                return $this->getResponseAi($chat->id, $prompt, $data);

            }
        }

        $chatHistory = new ChatHistory();
        $chatHistory->chat_id = $chat->id;
        $chatHistory->role = "user";
        $chatHistory->content = $data['content'];
        $chatHistory->save();

        return $this->getResponseAi($chat->id, $prompt, $data);

    }

    public function getResponseAi($chatId, $prompt, $data){

        $agency = Agency::where('uid', $data['agency_uid'])->first();
        $client = Client::where('uid', $data['client_uid'])->first();

        $chatConfig = ChatConfig::select('role','content')
        ->where('agency_id',  $agency->id)
        ->where('client_id', $client->id)
        ->get()
        ->toArray();
     
        array_push($chatConfig, $prompt);

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $chatConfig,
        ]);

        if($result){
            $chatHistory = new ChatHistory();
            $chatHistory->chat_id = $chatId;
            $chatHistory->role = "assistant";
            $chatHistory->content = $result->choices[0]->message->content;
            $chatHistory->save();
        }

        $chatHistory = ChatHistory::where('chat_id', $chatId)
            ->get();

        return Response::json(['status'=> true, 
            'uid'=> Chat::find($chatId)->uid,
            'chat_history'=> $chatHistory,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat = Chat::where('uid', $id)->first();

        if($chat){
            $chatHistory = ChatHistory::where('chat_id', $chat->id)
            ->get();
            
            return Response::json(['status'=> true, 
                'uid'=> $id,
                'chat_history'=> $chatHistory,
            ]);
        }

        return Response::json(['status'=> false, 
            'uid'=> $id,
            'chat_history'=> [],
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
