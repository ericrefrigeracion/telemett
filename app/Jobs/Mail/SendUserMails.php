<?php

namespace App\Jobs\Mail;

use App\User;
use App\Device;
use App\MailAlert;
use App\Mail\ConnectMail;
use App\Mail\DisconnectMail;
use App\Mail\HumidityMail;
use App\Mail\TemperatureMail;
use App\Mail\HumSetPointMail;
use App\Mail\TempSetPointMail;
use App\Mail\PayAccreditedMail;
use App\Mail\MonitorOnMail;
use App\Mail\MonitorOffMail;
use App\Mail\MonitorOffNextDayMail;
use App\Mail\MonitorOffNextWeekMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendUserMails implements ShouldQueue
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
        if($mails_information = MailAlert::where('send_to_user_at', null)->get())
        {
            foreach ($mails_information as $mail_information)
            {
                $user = User::find($mail_information->user_id);
                $device = Device::find($mail_information->device_id);

                if ($device->notification_email != 'No quiero recibir notificaciones')
                {
                    if ($mail_information->type == 'onLine') Mail::to($device->notification_email)->queue(new ConnectMail($mail_information, $device, $user));
                    if ($mail_information->type == 'offLine') Mail::to($device->notification_email)->queue(new DisconnectMail($mail_information, $device, $user));
                    if ($mail_information->type == 'temp') Mail::to($device->notification_email)->queue(new TemperatureMail($mail_information, $device, $user));
                    if ($mail_information->type == 'tSetPoint') Mail::to($device->notification_email)->queue(new TempSetPointMail($mail_information, $device, $user));
                }
                if($mail_information->type == 'PayAccredited') Mail::to($device->notification_email)->queue(new PayAccreditedMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOn') Mail::to($device->notification_email)->queue(new MonitorOnMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOff') Mail::to($device->notification_email)->queue(new MonitorOffMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOffNextDay') Mail::to($device->notification_email)->queue(new MonitorOffNextDayMail($mail_information, $device, $user));
                if($mail_information->type == 'MonitorOffNextWeek') Mail::to($device->notification_email)->queue(new MonitorOffNextWeekMail($mail_information, $device, $user));
                $mail_information->update(['send_to_user_at' => now()]);
            }
        }
    }
}
