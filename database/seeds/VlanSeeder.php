<?php

use App\Models\Vlan;
use Illuminate\Database\Seeder;

class VlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vlans = [
            ['number' => '1',   'name' => 'Current Network',            'color' => '#4CAF50'],
            ['number' => '10',  'name' => 'Guest LAN',                  'color' => '#F44336'],
            ['number' => '20',  'name' => 'Guest WiFi',                 'color' => '#E91E63'],
            ['number' => '30',  'name' => 'WiFi',                       'color' => '#9C27B0'],
            ['number' => '40',  'name' => 'WiFi Management',            'color' => '#673AB7'],
            ['number' => '50',  'name' => 'DMZ Zone',                   'color' => '#2196F3'],
            ['number' => '60',  'name' => 'Telenet Direct',             'color' => '#00BCD4'],
            ['number' => '70',  'name' => 'Gebouwbeeer',                'color' => '#CDDC39'],
            ['number' => '101', 'name' => 'VoIP',                       'color' => '#FFEB3B'],
            ['number' => '123', 'name' => 'Router Link',                'color' => '#FFC107'],
            ['number' => '124', 'name' => 'Core 2 Link',                'color' => '#FF9800'],
            ['number' => '150', 'name' => 'Telecom-IT MGMT switches',   'color' => '#FF5722']
        ];

        foreach($vlans as $vlan)
        {
            Vlan::create($vlan);
        }
    }
}