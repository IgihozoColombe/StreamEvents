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
      // Validate the incoming request data
      $validatedData = $request->validate([
          'amount' => 'required|numeric',
          'item_name' => 'required|string|max:255',
          'price' => 'required|numeric|min:0.01',
          'user_id' => 'required|exists:users,id', // Make sure user_id exists in the users table
      ]);

      // Create a new donation record
      $sale = MerchSale::create($validatedData);

      return response()->json(['message' => 'sale created successfully', 'sale' => $sale], 201);
  }
}
