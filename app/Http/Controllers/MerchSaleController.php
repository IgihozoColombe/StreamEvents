<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follower;

class MerchSaleController extends Controller
{
  // List all merchandise sales for the currently logged-in user
  public function index()
  {
    $sales = Merch_sale::all(); 

      return response()->json($sales);
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
