<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerchSale;

class MerchSaleController extends Controller
{
  // List all merchandise sales for the currently logged-in user
  public function index()
  {
    $sales = MerchSale::all(); 

      return response()->json($sales);
  }

  public function markAsRead(MerchSale $sale)
  {
      // Mark the donation as read (update the 'is_read' field)
      $sale->update(['is_read' => true]);

      // Optionally, you can return a response if needed
      return response()->json(['message' => 'Sale marked as read']);
  }
  // Show the form to create a new merchandise sale
  public function create()
  {
      return view('merchandise_sales.create');
  }

  // Store a new merchandise sale
  public function store(Request $request)
  {
      $request->validate([
          'item_name' => 'required|string|max:255',
          'amount' => 'required|integer|min:1',
          'price' => 'required|numeric|min:0.01',
      ]);

      $sale = new MerchandiseSale([
          'item_name' => $request->input('item_name'),
          'amount' => $request->input('amount'),
          'price' => $request->input('price'),
      ]);

      auth()->user()->merchandiseSales()->save($sale);
      auth()->user()->notify(new MerchandiseSaleCreatedNotification($sale));
      return redirect()->route('merch_sales.index')->with('success', 'Merchandise sale created successfully!');
  }
}
