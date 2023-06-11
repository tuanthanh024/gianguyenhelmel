<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all()->map(function ($user) {
            return [
                'ID' => $user->id,
                'Họ tên' => $user->name,
                'Email' => $user->email,
                'Số điện thoại' => $user->phone_number,
                'Ngày tạo' => $user->created_at
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Họ tên',
            'Email',
            'Số điện thoại',
            'Ngày tạo'
        ];
    }
}
