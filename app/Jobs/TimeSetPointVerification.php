<?php

namespace App\Jobs;

use App\Alert;
use App\Device;
use App\Reception;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TimeSetPointVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 30;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $t_set_point_devices = Device::where('admin_mon', true)->where('on_line', true)->where('on_t_set_point', false)->get();
        $h_set_point_devices = Device::where('admin_mon', true)->where('on_line', true)->where('on_t_set_point', false)->get();

        foreach($t_set_point_devices as $device)
        {
            $delay = now()->subMinutes($device->delay);

            if ($device->t_change_at <= $delay)
            {
                if(!MailAlert::where('device_id', $device->id)->where('type', 'tSetPoint')->where('last_created_at', $device->t_change_at)->count())
                {
                    MailAlert::create([
                        'device_id' => $device->id,
                        'user_id' => $device->user_id,
                        'type' => 'tSetPoint',
                        'last_created_at' => $device->t_change_at,
                    ]);
                }
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La temperatura no alcanzo el valor deseado en el tiempo previsto.',
                    'alert_created_at' => $device->t_change_at,
                ]);
            }
        }
        foreach($h_set_point_devices as $device)
        {
            $delay = now()->subMinutes($device->delay);

            if ($device->h_change_at <= $delay)
            {
                if(!MailAlert::where('device_id', $device->id)->where('last_created_at', $device->h_change_at)->count())
                {
                    MailAlert::create([
                        'device_id' => $device->id,
                        'user_id' => $device->user_id,
                        'type' => 'hSetPoint',
                        'last_created_at' => $device->h_change_at,
                    ]);
                }
                Alert::create([
                    'device_id' => $device->id,
                    'log' => 'La humedad no alcanzo el valor deseado en el tiempo previsto.',
                    'alert_created_at' =>$device->t_change_at,
                ]);
            }
        }
    }
}
