<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class adminController extends Controller
{
    //<!--===============================================================================================-->
    public function inventoryPage(Request $req)
    {
        $option = $req->input('option', 'desc');
        $inventories = Inventory::orderBy('date_received', $option)->get();

        $startDate = $req->input('startDate');
        $endDate = $req->input('endDate');

        $datas = DB::table('inventory')
            ->select(
                'item',
                DB::raw("SUM(CASE WHEN date_received BETWEEN '$startDate' AND '$endDate' THEN pcs ELSE 0 END) AS 'total'")
            )
            ->whereBetween('date_received', [$startDate, $endDate])
            ->groupBy('item')
            ->get();
        Session::put('startDate', $req->input('startDate'));
        Session::put('endDate', $req->input('endDate'));
        $dataResult = $datas->sum('total');
        return view('page.inventory', ['inventories' => $inventories, 'datas' => $datas, 'dataResult' => $dataResult]);
    }

    //<!--===============================================================================================-->
    public function addInventory(Request $req)
    {
        $req->validate([
            'date' => 'required',
            'box_id' => 'required|numeric',
            'item' => 'required|string',
            'pcs' => 'required|numeric',
            'buy_price' => 'required',
        ]);

        $data['date_received'] = $req->input('date');
        $data['box_id'] = $req->input('box_id');
        $data['item'] = $req->input('item');
        $data['pcs'] = $req->input('pcs');
        $data['buy_price'] = $req->input('buy_price');
        $inventory = Inventory::create($data);
        if (!$inventory) {
            return redirect(route('inventoryPage'))->with('error', 'Unsuccessful!!!.');
        }
        return redirect(route('inventoryPage'))->with('success', 'Inventory Added Successfully!!!.');
    }
    //<!--===============================================================================================-->
    public function editInventoryRequest(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'date' => 'required',
            'box_id' => 'required|numeric',
            'item' => 'required|string',
            'pcs' => 'required|numeric',
            'buy_price' => 'required',
        ]);
        $inventory = Inventory::find($req->input('id'));
        if (!$inventory) {
            return redirect(route('inventoryPage'))->with('error', 'Unsuccessful!!!.');
        }
        $inventory->date_received = $req->input('date');
        $inventory->box_id = $req->input('box_id');
        $inventory->item = $req->input('item');
        $inventory->pcs = $req->input('pcs');
        $inventory->buy_price = $req->input('buy_price');
        $inventory->save();
        return redirect(route('inventoryPage'))->with('success', 'Inventory Edited Successfully!!!.');
    }

    //<!--===============================================================================================-->
}
