<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with(['user', 'item'])->latest()->get();
        $items = Item::all();
        $users = User::all();

        return view('maintenances.index', compact('maintenances', 'users', 'items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id'               => 'required|exists:items,id',
            'maintenance_quantity'  => 'required|integer|min:1',
            'start_date'            => 'required|date',
            'end_date'              => 'nullable|date|after_or_equal:start_date',
            'cost'                  => 'required|numeric|min:0',
        ]);

        $item = Item::findOrFail($request->item_id);

        if ($item->quantity < $request->maintenance_quantity) {
            return back()->withInput()->with('error', 'Insufficient stock. Available: ' . $item->quantity);
        }

        $item->decrement('quantity', $request->maintenance_quantity);


        Maintenance::create([
            'user_id'         => Auth::id(),
            'item_id'               => $request->item_id,
            'maintenance_quantity'  => $request->maintenance_quantity,
            'start_date'            => $request->start_date,
            'end_date'              => $request->end_date,
            'cost'                  => $request->cost,
        ]);

        return back()->with('success', 'Maintenance recorded successfully!');
    }

    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $items = Item::all();

        return view('maintenances.edit', compact('maintenance', 'items'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'end_date' => 'nullable|date',
        ]);

        $maintenance = Maintenance::findOrFail($id);

        $maintenance->update([
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('maintenances.index')
            ->with('success', 'Maintenance updated successfully!');
    }
}