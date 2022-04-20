<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function revenue($month, $year)
    {
        $result = Order::whereMonth('created_at', date($month))
            ->whereYear('created_at', date($year))
            ->select(DB::raw(
                'DATE_FORMAT(created_at, "%d") as Day, 
                isCancelled, SUM(price) as Price, COUNT(*) as Total'
            ))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%d"), isCancelled'))
            ->get();

        return $result;
    }

    public function period(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "price" => ["required", "regex:/^\d+(\.\d{1,2})?$/"],
            "isCancelled" => "required"
        ]);

        $order = Order::create([
            "price" => $request->input('price'),
            "isCancelled" => $request->input('isCancelled')
        ]);

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = $this->FindOrder($id);

        if ($order == null) return response()->json(['Error' => 'Order not found'], 404);

        $order->update([
            "price" => $request->input('price'),
            "isCancelled" => $request->input('isCancelled')
        ]);
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = $this->FindOrder($id);

        if ($order == null) return response()->json(['Error' => 'Order not found'], 404);

        $order->delete();

        return response()->json(['Success' => 'Order #' . $id . ' deleted'], 200);
    }

    public function FindOrder($id)
    {
        $order = Order::find($id);
        return $order;
    }
}
