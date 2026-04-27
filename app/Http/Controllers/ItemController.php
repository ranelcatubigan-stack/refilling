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
            'description' => 'nullable|string',
        ]);

        // 🔥 OPTIONAL SAFETY: prevent duplicate FillGallon
        if (strtolower($request->item_name) === 'fillgallon') {
            if (Item::where('item_name', 'FillGallon')->exists()) {
                return back()->with('error', 'FillGallon already exists!');
            }
        }

        Item::create([
            'item_name' => $request->item_name,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'description' => $request->description,
]);

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
            'description' => 'nullable|string',
        ]);

        $item = Item::findOrFail($id);

        // 🔥 PROTECT FillGallon (important for stock system)
        if ($item->item_name === 'FillGallon' && $request->item_name !== 'FillGallon') {
            return back()->with('error', 'FillGallon name cannot be changed!');
        }

        $item->update($request->all());

        return redirect()->route('items.index')
            ->with('success', 'Item updated successfully!');
    }

    /**
     * Delete item
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // 🔥 PROTECT FillGallon from deletion
        if ($item->item_name === 'FillGallon') {
            return back()->with('error', 'FillGallon cannot be deleted because it is used in Stock system!');
        }

        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}