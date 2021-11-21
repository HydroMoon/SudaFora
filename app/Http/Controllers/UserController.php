<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\UserInfo;
use App\Models\Request as ModelsRequest;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        if (count(UserInfo::where('user_id', Auth::id())->get()) > 0) {
            return Inertia::render('User/Dashboard');
        } else {
            return Redirect::route('user.profile')->with('message', 'Pllease complete user info.');
        }
    }

    public function profile()
    {
        return Inertia::render('User/Profile', [
            'user_available' => count(UserInfo::where('user_id', Auth::id())->get()) > 0 ? true : false,
            'user_info' => UserInfo::where('user_id', Auth::id())->first()
        ]);
    }

    public function requestI()
    {
        if (count(UserInfo::where('user_id', Auth::id())->get()) > 0) {
            return Inertia::render('User/Request', [
                'specialities' => Speciality::all(),
            ]);
        } else {
            return Redirect::route('user.profile')->with('message', 'Pllease complete user info.');
        }  
    }

    public function storeProf(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $user_info = new UserInfo;

        $user_info->name = $validated['name'];
        $user_info->phone = $validated['phone'];
        $user_info->address = $validated['address'];

        $user_info->user()->associate(Auth::id());

        $user_info->save();

        return Redirect::route('user.profile');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $validated = $request->validate([
        //     'item_name' => 'required',
        //     'item_desc' => 'required',
        //     'quantity' => 'required|numeric',
        //     'speciality_id' => 'required|numeric'
        // ]);

        $collection = new ModelsRequest;
        $collection->collection_name = trim(Auth::user()->name . now());
        $collection->name = Auth::user()->name;
        $collection->user_id = Auth::id();
        $collection->speciality_id = $request->all()[0]['speciality_id'];
        $collection->save();
        
        foreach ($request->all() as $item) {
            $items = new Items;
            $items->item_name = $item['item_name'];
            $items->item_desc = $item['item_desc'];
            $items->quantity = $item['quantity'];
            $items->user()->associate(Auth::id());
            $items->request()->associate($collection->id);
            $items->speciality()->associate($item['speciality_id']);
            
            $items->save();
        }

        return Redirect::route('user.request');
    }
}
