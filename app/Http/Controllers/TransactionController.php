<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\Transactions\CreateTransactionService;
use App\Services\Transactions\GetBalanceService;
use App\Services\Transactions\ListTransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private ListTransactionService $listTransactionService;
    private CreateTransactionService $createTransactionService;
    private GetBalanceService $getBalanceService;

    public function __construct(
        ListTransactionService $listTransactionService,
        CreateTransactionService $createTransactionService,
        GetBalanceService $getBalanceService
    ) {
        $this->listTransactionService = $listTransactionService;
        $this->createTransactionService = $createTransactionService;
        $this->getBalanceService = $getBalanceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = $this->listTransactionService->run();
        $balance = $this->getBalanceService->run($transactions);

        return response()->json(['transactions' => $transactions, 'balance' => $balance]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $transaction = $this->createTransactionService->run(
            $request->category,
            $request->title,
            $request->type,
            $request->value
        );

        return response()->json($transaction);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
