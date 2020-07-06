<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\AdMessage;
use App\Http\Requests\MessageAd;
use App\Repositories\ { AdRepository, MessageRepository };
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $adRepository;
    protected $messagerepository;

    public function __construct(AdRepository $adRepository, Messagerepository $messagerepository)
    {
        $this->adRepository = $adRepository;
        $this->messagerepository = $messagerepository;
    }

    public function message(MessageAd $request)
    {
        $ad = $this->adRepository->getById($request->id);

        if (auth()->check()) { // on peut envoyer la notification pour un utilisateur connecté
            $ad->notify(new AdMessage($ad, $request->message, auth()->user()->email));
            return response()->json(['info' => 'Votre message va être rapidement transmis.']);
        }

        $this->messagerepository->create([
            'texte' => $request->message,
            'email' => $request->email,
            'ad_id' => $ad->id,
        ]);

        return response()->json(['info' => 'Votre message a été mémorisé et sera transmis après modération.']);
    }

    public function index()
    {
    }

    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
    }

    public function show(User $user)
    {
        echo '<p>Name :' . $user->name . '</p>';
        echo '<p>Email :' . $user->email . '</p>';
    }

    public function edit(User $user)
    {

        return view('edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->save();
        return back();
    }

    public function destroy()
    {
        $user = User::findorfail(Auth::user()->id);
        $user->delete();
        return redirect('/login')->with('message', 'Le compte à bien été supprimé');
    }
}

