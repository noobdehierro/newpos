<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'id',
            'status',
            'brand_name',
            'user_name',
            'payment_method',
            'sales_type',
            'total',
            'created_at'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {

        $orden = Order::latest()
            ->Select('id', 'status', 'brand_name', 'user_name','payment_method', 'sales_type', 'total', 'created_at')
            ->filterOrders(request(['initDate', 'endDate', 'payment_method', 'sales_type']));

        return $orden;
    }
}
