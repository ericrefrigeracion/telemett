<?php

namespace App\Http\Controllers\Device;

use App\Device;
use App\DeviceConfiguration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DeviceConfigurationController extends Controller
{
/**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        if ($device->users->where('id', Auth::user()->id) || Auth::user()->hasRole('super.admin'))
        {
            return view('devices.configuration', compact('device'));
        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Devices  $devices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceConfiguration $device_configuration)
    {

        if ($device_configuration->device->users->where('id', Auth::user()->id) || Auth::user()->hasRole('super.admin'))
        {
            $rules = [

                'value' => 'required|numeric|min:'. $device_configuration->topic_control_type->min .'|max:'. $device_configuration->topic_control_type->max,
            ];

            $request->validate($rules);


            if($request->has('value') && $request->value != $device_configuration->value) alertCreate($device_configuration->device, Auth::user()->name . " cambio " . $device_configuration->topic_control_type->name . " a $request->value .", now());

            $device_configuration->update($request->all());

            return redirect()->route('devices.configuration', $device_configuration->device_id)->with('success', ['Dispositivo actualizado con exito']);

        }
        else
        {
            abort(403, 'Accion no Autorizada');
        }
    }
}
