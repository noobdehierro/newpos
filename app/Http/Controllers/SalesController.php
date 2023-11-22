<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Exports\OrdersExport;

class SalesController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->can('brandAdmin')) {
            $users = User::all();
        } else {
            $users = User::where('brand_id', auth()->user()->brand_id)->get();
        }

        return view('adminhtml.sales.index', [
            'users' => $users
        ]);
    }

    public function show()
    {
        $orders = Order::latest()->filterOrders(request(['initDate', 'endDate', 'payment_method', 'sales_type', 'user_name']))->get();
        return view('adminhtml.sales.show', ['orders' => $orders]);
    }

    public function export()
    {
        return (new OrdersExport(
            request()->all()
        )
        )->download('Sales.xlsx');
    }
}
