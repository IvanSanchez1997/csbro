<?php

namespace App\Livewire;

use App\Models\ChatMessage;
use App\Models\User;
use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Illuminate\Http\Request;

class Chat extends Component
{
    public $users;
    public $selectedUser;
    public $newMessage;
    public $messages;
    public $loginId;
    public $game;
    public $gameId;

    public function mount($gameId)
    {
        $this->gameId = $gameId;
        $this->game = Game::findOrFail($gameId);
        $this->users = $this->game->users;
        // Anterior mount >30/09/2025
       /* $lastGame = Game::where('created_at', '>=', now()->subMonth())
                        ->latest('created_at')
                        ->first();*/

        // Si hay un game válido en las últimas 24h, sacamos sus usuarios
        //if ($lastGame) {
            //$this->users = $gameId->users; // relación muchos a muchos
        //} else {
            //$this->users = collect(); // colección vacía
           // return redirect()->back();
      //  }
      // Anterior mount >30/09/2025

        $this->selectedUser = $this->users->first();
        $this->loadMessagges();
        $this->loginId = Auth::id();

    }

    public function selectUser($id)
    {
        $this->selectedUser = User::find($id);
        $this->loadMessagges();
    }

    public function loadMessagges()
    {
        $this->messages = ChatMessage::query()
                 ->where(function ($query){
                 $query->where("sender_id", Auth::id())
                         ->where ("receiver_id", $this->selectedUser->id);
                 })
                 ->orwhere(function ($query){
                 $query->where("sender_id", $this->selectedUser->id)
                         ->where ("receiver_id", Auth::id());
                 })->get();

    }


        public function submit()
    {
        if (!$this->newMessage) return; 
        
        $message =   ChatMessage::create([
                    "sender_id" => Auth::id(),
                    "receiver_id" => $this->selectedUser->id,
                    "message" => $this->newMessage
                    ]);
        $this->messages->push($message);
        
        $this->newMessage = '';

        broadcast(new MessageSent($message));
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->loginId},MessageSent" => "newChatMessageNotification" 
        ];
    }

    public function newChatMessageNotification ($message)
    {
        if($message['sender_id'] == $this->selectedUser->id){
            $messageObj = ChatMessage::find($message['id']);
                $this->messages->push($messageObj);
        }
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
