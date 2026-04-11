
<?php

use Illuminate\Support\Facades\DB;
use NguyenHuy\Delhivery\Delhivery;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('delhivery-waybills:generate', function () {
    $response =  Delhivery::waybill()->bulk([
        'count' => 100
    ]);

    $waybills = filled($response->first()) ? explode(',', $response->first()) : [];
    if(!empty($waybills)) {
        foreach($waybills as $waybill) {
            DB::table('delhivery_waybills')->insert([
                'waybill_number' => $waybill,
            ]);    
        }
        $this->info('Waybills generated successfully');
    } else {
        $this->info('No waybills found');
    }
})->purpose('Sync Delhivery waybills');
