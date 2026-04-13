<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role === 'admin') {
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
        return view('parcels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sender_name' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'address' => 'required|string',
            'return_address' => 'nullable|string',
        ]);

        Parcel::create([
            'tracking_number' => 'TRK-' . strtoupper(Str::random(10)),
            'sender_name' => $request->sender_name,
            'recipient_name' => $request->recipient_name,
            'address' => $request->address,
            'return_address' => $request->return_address,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parcel $parcel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parcel $parcel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parcel $parcel)
    {
        //
    }
}
