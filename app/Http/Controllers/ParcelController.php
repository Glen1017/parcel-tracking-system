<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\DeliveryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (in_array(auth()->user()->role, ['admin', 'courier'])) {
            $parcels = Parcel::latest()->get();
        } else {
            $parcels = Parcel::where('user_id', auth()->id())->latest()->get();
        }

        return view('parcels.index', compact('parcels'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'customer'])) {
            abort(403);
        }
        return view('parcels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Only customers and admins can create parcels
        if (!in_array(auth()->user()->role, ['admin', 'customer'])) {
            abort(403);
        }
        //Validate input
        $request->validate([
            'sender_name' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'address' => 'required|string',
            'return_address' => 'nullable|string',
        ]);
        //Create parcel with unique tracking number
        $parcel = Parcel::create([
            'tracking_number' => 'TRK-' . strtoupper(Str::random(10)),
            'sender_name' => $request->sender_name,
            'recipient_name' => $request->recipient_name,
            'address' => $request->address,
            'return_address' => $request->return_address,
            'status' => 'Registered',
            'user_id' => auth()->id(),
        ]);
        //Log initial delivery event
        DeliveryEvent::create([
            'parcel_id' => $parcel->id,
            'status' => 'Registered',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('parcels.index')->with('success', 'Parcel registered successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Parcel $parcel)
    {
        //Customers can only view their own parcels, while admins and couriers can view all
        $user = auth()->user();
        if ($user->role === 'customer' && $parcel->user_id !== $user->id) {
            abort(403);
    }
    //Load delivery events with user info
    $parcel->load('deliveryEvents.user');

        return view('parcels.show', compact('parcel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parcel $parcel)
    {
        if (!in_array(auth()->user()->role, ['admin', 'courier'])) {
            abort(403);
        }
        return view('parcels.edit', compact('parcel'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcel $parcel)
    {
        //Only couriers and admins can update parcel status
        if (!in_array(auth()->user()->role, ['admin', 'courier'])) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Registered,In Transit,Out for Delivery,Delivered',
        ]);

        $parcel->update([
            'status' => $request->status,
        ]);

        DeliveryEvent::create([
            'parcel_id' => $parcel->id,
            'status' => $request->status,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('parcels.index')->with('success', 'Parcel status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcel $parcel)
    {
        //
    }
}
