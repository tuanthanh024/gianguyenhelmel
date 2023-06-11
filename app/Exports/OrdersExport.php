<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use \Maatwebsite\Excel\Writer;
use \Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;

Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
});

Writer::macro('setCreator', function (Writer $writer, string $creator) {
    $writer->getDelegate()->getProperties()->setCreator($creator);
});
Sheet::macro('setOrientation', function (Sheet $sheet, $orientation) {
    $sheet->getDelegate()->getPageSetup()->setOrientation($orientation);
});
class OrdersExport implements FromCollection, ShouldAutoSize, WithHeadings, WithEvents
{

    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function collection()
    {
        $id = 0;
        if ($this->status == 0) {
            $order = Order::all();
        } else {
            $order = Order::where('order_status_id', $this->status)->get();
        }
        return $order->map(function ($order) use (&$id) {
            $id++;
            return [
                $id,
                $order->order_code,
                $order->fullname,
                $order->email,
                $order->phone,
                implode(', ', [$order->address, $order->shipping_ward, $order->shipping_district, $order->shipping_province]),
                number_format($order->total_price) . ' đ',
                $order->orderStatus->name,
                Carbon::parse($order->created_at)->format('d-m-Y H:i:s')
            ];
        });
    }

    public function headings(): array
    {
        return [
            'STT',
            'Mã đơn hàng',
            'Họ tên',
            'Email',
            'Số điện thoại',
            'Địa chỉ',
            'Tổng tiền',
            'Trạng thái',
            'Ngày đặt'
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function (BeforeExport $event) {
                $event->writer->setCreator('Patrick');
            },
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->styleCells(
                    'A1:I1',
                    [
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFC000'
                            ]
                        ]
                    ]
                );

                $event->sheet->getStyle('A1:I1')->getFont()->setColor(new Color('FF0000'));
                $event->sheet->getStyle('A1:I1')->getFont()->setBold(true);
            },
        ];
    }
}
