<?php

namespace App\Http\Controllers;

use App\Models\SubscribeTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscribeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = SubscribeTransaction::with(['user'])->orderByDesc('id')->get();
        return view('admin.transactions.index', [
            'transactions' => $transaction
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribeTransaction $subscribeTransaction)
    {
        return view('admin.transactions.show', [
            'transaction' => $subscribeTransaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribeTransaction $subscribeTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribeTransaction $subscribeTransaction)
    {
        DB::transaction(function () use ($request, $subscribeTransaction) {
            $subscribeTransaction->update([
                'is_paid' => true,
                'subscription_start_date' => Carbon::now(),
            ]);
        });

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribeTransaction $subscribeTransaction)
    {
        //
    }
}
