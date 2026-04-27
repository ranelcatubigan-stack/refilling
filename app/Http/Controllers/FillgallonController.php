<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('item')->latest()->get();
        $items = Item::all();
        return view('stocks.index', compact('stocks', 'items'));
    }

    public function create()
    {
        $items = Item::all();
        return view('stocks.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $item = Item::findOrFail($request->item_id);

        if (strtolower($item->item_name) !== 'fillgallon') {
            return back()->with('error', 'Only FillGallon can be used for stock in!');
        }

        $empty = $item->total_gallons - $item->filled_gallons;

        if ($request->quantity > $empty) {
            return back()->with('error', 'Not enough empty gallons available!');
        }

        Stock::create([
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'date' => $request->date,
        ]);

        $item->filled_gallons += $request->quantity;

        $item->save();

        return redirect()->route('stocks.index')
            ->with('success', 'Gallons successfully filled!');
    }
}