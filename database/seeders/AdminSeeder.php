<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $organizations = [
            'APSS', 'AVED', 'BACOMMUNITY', 'BPED MOVERS', 'COFED', 'DIGITS',
            'English Circle', 'EA', 'HRC', 'JSWAP', 'KMF', 'LNU MSS', 'INTERSOC',
            'TC', 'TLEG TLE', 'SQU', 'ECEO', 'FCO', 'SCO', 'JCO', 'SENCO'
        ];

        $names = [
            'John Denver Candasua', 'Jane Doe', 'Michael Smith', 'Emily Johnson',
            'Chris Evans', 'Sarah Connor', 'David Brown', 'Sophia Martinez',
            'James Wilson', 'Olivia Garcia', 'Daniel Lee', 'Emma Davis',
            'Liam Harris', 'Mia Clark', 'Noah Lewis', 'Isabella Walker',
            'Lucas Hall', 'Ava Allen', 'Ethan Young', 'Charlotte King', 'Mason Wright'
        ];

        foreach ($organizations as $index => $org) {
            $password = strtolower($org) . '2025'; // example: digits2025
            Admin::firstOrCreate(
                ['username' => $org],
                [
                    'password' => Hash::make($password),
                    'plain_password' => $password,
                    'role' => 'admin',
                    'name' => $names[$index % count($names)], // Assign names in a loop
                ]
            );
        }

        Admin::firstOrCreate(
            ['username' => 'superadmin'],
            [
                'password' => Hash::make('superadmin123'),
                'role' => 'super_admin',
                'name' => 'Kent Jake Gwapo',
            ]
        );
    }
}
