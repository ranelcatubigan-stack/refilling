<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Item;

class SalesController extends Controller
{
    // ✅ Show sales history
    public function index()
    {
        $sales = Sale::with('item')->latest()->get();
        return view('sales.index', compact('sales'));
    }

    // ✅ Show form
    public function create()
    {
        $items = Item::all();
        return view('sales.create', compact('items'));
    }

    // ✅ Store sale (stock OUT + refill)
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|in:refill,new',
            'date' => 'required|date',
        ]);

        $item = Item::find($request->item_id);

        // 🔥 If NEW → stock OUT
        if ($request->type == 'new') {

            // ❗ prevent negative stock
            if ($item->quantity < $request->quantity) {
                return back()->with('error', 'Not enough stock!');
            }

            $item->quantity -= $request->quantity;
            $item->save();
        }

        // ✅ Save sale
        Sale::create([
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'type' => $request->type,
            'total_price' => $item->price * $request->quantity,
            'date' => $request->date,
        ]);

        return redirect()->route('sales.index')
            ->with('success', 'Transaction recorded!');
    }
}