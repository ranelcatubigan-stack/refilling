<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display all items
     */
    public function index()
    {
        $items = Item::with('supplier')->get();
        $suppliers = Supplier::all();

        return view('items.index', compact('items', 'suppliers'));
    }

    /**
     * Store new item
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Item::create($request->all());

        return redirect()->back()->with('success', 'Item added successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $suppliers = Supplier::all();

        return view('items.edit', compact('item', 'suppliers'));
    }

    /**
     * Update item
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Delete item
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}