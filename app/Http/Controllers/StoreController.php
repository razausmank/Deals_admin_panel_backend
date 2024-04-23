<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();

        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        $cities = City::all();
        return view('stores.create', compact('cities'));
    }

    public function store( Request $request )
    {
        $validated_fields = $request->validate([
            'name' => 'required',
            'image' => 'nullable',
            'address' => 'nullable',
            'timing' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'city_id' => 'required',
        ]);

        if ($request->file('image')) {
            $image_address = $request->file('image')->store('public/stores');
            $validated_fields['image'] = $image_address;
        }

        $store = Store::create($validated_fields);

        return redirect(route('store.index'))->with('success', 'Store successfuly created');
    }


    public function edit(Store $store)
    {
        $cities = City::all();

        return view('stores.edit', compact('store', 'cities'));
    }

    public function update( Request $request, Store $store )
    {
        $validated_fields = $request->validate([
            'name' => 'required',
            'image' => 'nullable',
            'address' => 'nullable',
            'timing' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'city_id' => 'required',
        ]);

        if ($request->file('image')) {
            $image_address = $request->file('image')->store('public/stores');
            $validated_fields['image'] = $image_address;
        }

        $store->update($validated_fields);

        return redirect(route('store.index'))->with('success', 'Store successfuly updated');
    }

    public function destroy( Store $store )
    {
        // Store can only be deleted if there is no deals associated with it
        try {
            if ( $store->deals()->count())
            {
                return redirect(route('store.index'))->with('failure', "Store has deals and hence cannot be deleted");
            }

            $store->delete();

        } catch (Exception $e) {
            return [ "Something went wrong" , $e->getMessage()];
        }

        return redirect(route('store.index'))->with('success', 'Store successfuly deleted');
    }
}
