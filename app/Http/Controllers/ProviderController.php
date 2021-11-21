<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\ProviderInfo;
use App\Models\Request as ModelsRequest;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProviderController extends Controller
{
    public function index()
    {
        if (count(ProviderInfo::where('user_id', Auth::id())->get()) > 0) {
            return Inertia::render('Dashboard');
        } else {
            return Redirect::route('profile')->with('message', 'Please complete user info');
        }
    }

    public function profile()
    {
        return Inertia::render('Provider/Profile', [
            'prov_available' => count(ProviderInfo::where('user_id', Auth::id())->get()) > 0 ? true : false,
            'provider_info' => ProviderInfo::where('user_id', Auth::id())->with('speciality')->first(),
            'speciality' => Speciality::all()
        ]);
    }

    public function requests()
    {
        if (count(ProviderInfo::where('user_id', Auth::id())->get()) > 0) {
            return Inertia::render('Provider/Requests', [
                'items' => Items::where([
                    ['speciality_id', ProviderInfo::where('user_id', Auth::id())->first()->speciality_id],
                    ['item_found', 0]
                ])->with('user')->get()
            ]);
        } else {
            return Redirect::route('profile')->with('message', 'Please complete user info');
        }
}

    public function archive()
    {
        return Inertia::render('Provider/Archive', [
            'items' => ModelsRequest::where('provider_id', ProviderInfo::where('user_id', Auth::id())->first()->id)->with('items')->get()
        ]);
    }

    public function showReport($id)
    {
        return Inertia::render('Provider/Report', [
            'items' => ModelsRequest::where('id', $id)->with(['items', 'user', 'provider'])->first()
        ]);
    }

    public function storeProvInfo(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required',
            'owner_name' => 'required',
            'work_email' => 'required',
            'phone1' => 'required',
            'phone2' => 'sometimes',
            'phone3' => 'sometimes',
            'address1' => 'required',
            'address2' => 'sometimes',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['speciality_id'] = Speciality::find($request->speciality_id)->id;
        ProviderInfo::create($validated);

        return Redirect::route('profile');
    }

    public function storeReq(Request $request)
    {   
        $validated = $request->validate([
            'id' => 'required',
            'quantity_found' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $item = Items::find($validated['id']);

        $item->item_found = 1;
        $item->quantity_found = $validated['quantity_found'];
        $item->price = $validated['price'];
        $item->total = $validated['price'] * $validated['quantity_found'];

        $item->save();

        $req = ModelsRequest::find($item->request_id);
        if ($req->provider_id == null) {
            $req->provider()->associate(ProviderInfo::where('user_id', Auth::id())->first()->id);
    
            $req->save();
        }

        return Redirect::route('requests')->with(
            'toast', 'Item saved successfully!'
        );
    }

    public function storeReqAlt(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'alt_name' => 'required',
            'alt_desc' => 'required',
            'quantity_found' => 'required|numeric',
            'price' => 'required|numeric'
        ]);
        
        $item = Items::find($validated['id']);

        $item->item_found = 2;
        $item->item_alt = $validated['alt_name'];
        $item->item_alt_desc = $validated['alt_desc'];
        $item->quantity_found = $validated['quantity_found'];
        $item->price = $validated['price'];
        $item->total = $validated['price'] * $validated['quantity_found'];

        $item->save();

        $req = ModelsRequest::find($item->request_id);
        if ($req->provider_id == null) {
            $req->provider()->associate(ProviderInfo::where('user_id', Auth::id())->first()->id);
    
            $req->save();
        }

        return Redirect::route('requests')->with(
            'toast', 'Item saved successfully!'
        );
    }
}
