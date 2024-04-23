<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index()
    {
        $deals = Deal::all();

        return view('deals.index', compact('deals'));
    }

    public function create()
    {
        $stores = Store::all();
        return view('deals.create', compact('stores'));
    }

    public function store( Request $request )
    {
        $validated_fields = $request->validate([
            'title' => 'required',
            'description' => 'string',
            'image' => 'nullable',
            'pdf' => 'nullable',
            'resource_link' => 'nullable',
            'promotion_start_date' => ['nullable', 'date'],
            'promotion_end_date' =>  ['nullable', 'date'],
            'store_id' => 'required',
        ]);

        if ($request->file('image')) {
            $image_address = $request->file('image')->store('public/deals/images');
            $validated_fields['image'] = $image_address;
        }

        if ($request->file('pdf')) {
            $image_address = $request->file('pdf')->store('public/deals/pdf');
            $validated_fields['pdf'] = $image_address;
        }

        $deal = Deal::create($validated_fields);

        return redirect(route('deal.index'))->with('success', 'Deal successfuly created');
    }


    public function edit(Deal $deal)
    {
        $stores = Store::all();

        return view('deals.edit', compact('deal', 'stores'));
    }

    public function update( Request $request, Deal $deal )
    {
        $validated_fields = $request->validate([
            'title' => 'required',
            'description' => 'string',
            'image' => 'nullable',
            'pdf' => 'nullable',
            'resource_link' => 'nullable',
            'promotion_start_date' => ['nullable', 'date'],
            'promotion_end_date' =>  ['nullable', 'date'],
            'store_id' => 'required',
        ]);

        if ($request->file('image')) {
            $image_address = $request->file('image')->store('public/deals/images');
            $validated_fields['image'] = $image_address;
        }

        if ($request->file('pdf')) {
            $image_address = $request->file('pdf')->store('public/deals/pdf');
            $validated_fields['pdf'] = $image_address;
        }

        $deal->update($validated_fields);

        return redirect(route('deal.index'))->with('success', 'Deal successfuly updated');
    }

    public function destroy( Deal $deal )
    {
        try {
            $deal->delete();
        } catch (Exception $e) {
            return [ "Something went wrong" , $e->getMessage()];
        }

        return redirect(route('deal.index'))->with('success', 'Deal successfuly deleted');
    }


    public function publish( Request $request , Deal $deal)
    {
        if ( $deal->is_published )
        {
            return redirect(route('deal.index'))->with('failure', 'The Deal is already published');
        }

        $deal->update([
            'is_published' => true
        ]);

        return redirect(route('deal.index'))->with('success', 'Deal successfuly published');
    }

    public function unpublish( Request $request , Deal $deal)
    {
        if ( !$deal->is_published )
        {
            return redirect(route('deal.index'))->with('failure', 'The Deal is already Unpublished');
        }

        $deal->update([
            'is_published' => false
        ]);

        return redirect(route('deal.index'))->with('success', 'Deal successfuly unpublished');

    }
}
