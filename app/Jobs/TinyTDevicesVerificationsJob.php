<?php

namespace App\Jobs;

use App\Device;
use App\MailAlert;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TinyTDevicesVerificationsJob implements ShouldQueue
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
        $devices = Device::where('admin_mon', true)->where('on_line', true)->where('protected', true)->where('type_device_id', 2)->get();
        foreach ($devices as $device)
        {
            $last_reception = $device->receptions()->latest()->first();
            $last_reception->data01 += $device->tiny_t_device->tcal;

            $this->MaxTempVerification($device, $last_reception);
            $this->MinTempVerification($device, $last_reception);
            $this->TemperatureTimeVerification($device);
            $this->SetPointChangeVerification($device, $last_reception);
            $this->SetPointTimeVerification($device);
        }

    }

    public function MaxTempVerification($device, $last_reception)
    {
            if($last_reception->data01 > $device->tiny_t_device->tmax && $device->tiny_t_device->on_temp)
            {
                $this->IsOutTemperature($device, $last_reception->created_at);
                alertCreate($device, 'La temperatura se encuentra por encima de la maxima permitida.', $last_reception->created_at);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $this->IsOnTemperature($device);
            }
    }

    public function MinTempVerification($device, $last_reception)
    {
            if($last_reception->data01 < $device->tiny_t_device->tmin && $device->tiny_t_device->on_temp)
            {
                $this->IsOutTemperature($device, $last_reception->created_at);
                alertCreate($device, 'La temperatura se encuentra por debajo de la minima permitida.', $last_reception->created_at);
            }
            if($last_reception->data01 < $device->tiny_t_device->tmax && $last_reception->data01 > $device->tiny_t_device->tmin && !$device->tiny_t_device->on_temp)
            {
                $this->IsOnTemperature($device);
            }
    }

    public function SetPointChangeVerification($device, $last_reception)
    {
            if($last_reception->data01 > $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'lower')
            {
                $device->tiny_t_device->update([
                    't_is' => 'higher',
                    't_change_at' => $last_reception->created_at
                ]);
            }
            if($last_reception->data01 < $device->tiny_t_device->t_set_point && $device->tiny_t_device->t_is === 'higher')
            {
                $device->tiny_t_device->update([
                    't_is' => 'lower',
                    't_change_at' => $last_reception->created_at
                ]);
            }
    }

    public function TemperatureTimeVerification($device)
    {
            if(!$device->tiny_t_device->on_temp)
            {
                $delay = now()->subMinutes($device->tiny_t_device->tdly);

                if ($device->tiny_t_device->t_out_at <= $delay)
                {
                    if(!MailAlert::where('device_id', $device->id)->where('type', 'temp')->where('last_created_at', $device->tiny_t_device->t_out_at)->count())
                    {
                        mailAlertCreate($device, 'temp', $device->tiny_t_device->t_out_at);
                    }
                }
            }
    }

    public function SetPointTimeVerification($device)
    {
            $delay = now()->subMinutes($device->tiny_t_device->tdly);

            if ($device->tiny_t_device->t_change_at <= $delay && $device->tiny_t_device->on_t_set_point)
            {
                $device->tiny_t_device->update(['on_t_set_point' => false]);
                alertCreate($device, 'La temperatura no alcanzo el valor deseado en el tiempo previsto.', $device->tiny_t_device->t_change_at);
                mailAlertCreate($device, 'tSetPoint', $device->tiny_t_device->t_change_at);
            }
            if ($device->tiny_t_device->t_change_at > $delay && !$device->tiny_t_device->on_t_set_point) $device->tiny_t_device->update(['on_t_set_point' => true]);
    }

    public function IsOnTemperature($device)
    {
        $device->tiny_t_device->update([
            'on_temp' => true,
            't_out_at' => null
        ]);
    }

    public function IsOutTemperature($device, $moment){
        $device->tiny_t_device->update([
            'on_temp' => false,
            't_out_at' => $moment
        ]);
    }
}
