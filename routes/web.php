<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);

Route::get('/', function () { return view('welcome'); });

Route::prefix('pays')->namespace('User')->name('pays.')->group(function () {
	Route::get('success', 'PayController@success')->name('success');
	Route::get('pending', 'PayController@pending')->name('pending');
	Route::get('failure', 'PayController@failure')->name('failure');
});

Route::middleware(['verified'])->group(function () {

	Route::get('home', 'HomeController@index')->name('home');
	Route::get('info', 'HomeController@info')->name('info');
	Route::get('admins/home/all', 'HomeController@all')->name('home.all')->middleware('can:home.all');

	Route::prefix('admins')->namespace('Admin')->group(function () {

		//Webhooks
		Route::get('/webhooks', 'WebhookController@index')->name('webhooks.index')->middleware('can:webhooks.index');
		Route::get('/webhooks/{webhook}', 'WebhookController@show')->name('webhooks.show')->middleware('can:webhooks.show');

		//MailAlerts
		Route::get('/mail-alerts', 'MailAlertController@index')->name('mail-alerts.index')->middleware('can:mail-alerts.index');
		Route::get('/mail-alerts/{mail_alert}', 'MailAlertController@show')->name('mail-alerts.show')->middleware('can:mail-alerts.show');

		//Users
		Route::prefix('users')->name('users.')->group(function () {
			Route::get('/', 'UserController@index')->name('index')->middleware('can:users.index');
			Route::post('/', 'UserController@store')->name('store')->middleware('can:users.create');
			Route::get('create', 'UserController@create')->name('create')->middleware('can:users.create');
			Route::delete('{user}', 'UserController@destroy')->name('destroy')->middleware('can:users.destroy');
			Route::put('{user}', 'UserController@update')->name('update')->middleware('can:users.edit');
			Route::get('{user}', 'UserController@show')->name('show')->middleware('can:users.show');
			Route::get('{user}/edit', 'UserController@edit')->name('edit')->middleware('can:users.edit');
		});

		//Roles
		Route::prefix('roles')->name('roles.')->group(function () {
			Route::get('/', 'RoleController@index')->name('index')->middleware('can:roles.index');
			Route::post('/', 'RoleController@store')->name('store')->middleware('can:roles.create');
			Route::get('create', 'RoleController@create')->name('create')->middleware('can:roles.create');
			Route::delete('{role}', 'RoleController@destroy')->name('destroy')->middleware('can:roles.destroy');
			Route::put('{role}', 'RoleController@update')->name('update')->middleware('can:roles.edit');
			Route::get('{role}', 'RoleController@show')->name('show')->middleware('can:roles.show');
			Route::get('{role}/edit', 'RoleController@edit')->name('edit')->middleware('can:roles.edit');
		});

		//Permissions
		Route::prefix('permissions')->name('permissions.')->group(function () {
			Route::get('', 'PermissionController@index')->name('index')->middleware('can:permissions.index');
			Route::post('', 'PermissionController@store')->name('store')->middleware('can:permissions.create');
			Route::get('create', 'PermissionController@create')->name('create')->middleware('can:permissions.create');
			Route::delete('{permission}', 'PermissionController@destroy')->name('destroy')->middleware('can:permissions.destroy');
			Route::put('{permission}', 'PermissionController@update')->name('update')->middleware('can:permissions.edit');
			Route::get('{permission}', 'PermissionController@show')->name('show')->middleware('can:permissions.show');
			Route::get('{permission}/edit', 'PermissionController@edit')->name('edit')->middleware('can:permissions.edit');
		});

		//Prices
		Route::prefix('prices')->name('prices.')->group(function () {
			Route::get('/', 'PriceController@index')->name('index')->middleware('can:prices.index');
			Route::post('/', 'PriceController@store')->name('store')->middleware('can:prices.create');
			Route::get('create', 'PriceController@create')->name('create')->middleware('can:prices.create');
			Route::delete('{price}', 'PriceController@destroy')->name('destroy')->middleware('can:prices.destroy');
			Route::put('{price}', 'PriceController@update')->name('update')->middleware('can:prices.edit');
			Route::get('{price}', 'PriceController@show')->name('show')->middleware('can:prices.show');
			Route::get('{price}/edit', 'PriceController@edit')->name('edit')->middleware('can:prices.edit');
		});

		//Topics
		Route::prefix('topics')->name('topics.')->group(function () {
			Route::get('/', 'TopicController@index')->name('index')->middleware('can:topics.index');
			Route::post('/', 'TopicController@store')->name('store')->middleware('can:topics.create');
			Route::get('create', 'TopicController@create')->name('create')->middleware('can:topics.create');
			Route::delete('{topic}', 'TopicController@destroy')->name('destroy')->middleware('can:topics.destroy');
			Route::put('{topic}', 'TopicController@update')->name('update')->middleware('can:topics.edit');
			Route::get('{topic}', 'TopicController@show')->name('show')->middleware('can:topics.show');
			Route::get('{topic}/edit', 'TopicController@edit')->name('edit')->middleware('can:topics.edit');
		});

		//Topic Control
		Route::prefix('topic-control-types')->name('topic-control-types.')->group(function () {
			Route::get('/', 'TopicControlTypeController@index')->name('index')->middleware('can:topic-control-types.index');
			Route::post('/', 'TopicControlTypeController@store')->name('store')->middleware('can:topic-control-types.create');
			Route::get('create', 'TopicControlTypeController@create')->name('create')->middleware('can:topic-control-types.create');
			Route::delete('{topic_control_type}', 'TopicControlTypeController@destroy')->name('destroy')->middleware('can:topic-control-types.destroy');
			Route::put('{topic_control_type}', 'TopicControlTypeController@update')->name('update')->middleware('can:topic-control-types.edit');
			Route::get('{topic_control_type}', 'TopicControlTypeController@show')->name('show')->middleware('can:topic-control-types.show');
			Route::get('{topic_control_type}/edit', 'TopicControlTypeController@edit')->name('edit')->middleware('can:topic-control-types.edit');
		});

		//Protections
		Route::prefix('protections')->name('protections.')->group(function () {
			Route::get('/', 'ProtectionController@index')->name('index')->middleware('can:protections.index');
			Route::post('/', 'ProtectionController@store')->name('store')->middleware('can:protections.create');
			Route::get('create', 'ProtectionController@create')->name('create')->middleware('can:protections.create');
			Route::delete('{protection}', 'ProtectionController@destroy')->name('destroy')->middleware('can:protections.destroy');
			Route::put('{protection}', 'ProtectionController@update')->name('update')->middleware('can:protections.edit');
			Route::get('{protection}', 'ProtectionController@show')->name('show')->middleware('can:protections.show');
			Route::get('{protection}/edit', 'ProtectionController@edit')->name('edit')->middleware('can:protections.edit');
		});

		//Topics
		Route::prefix('topics')->name('topics.')->group(function () {
			Route::get('/', 'TopicController@index')->name('index')->middleware('can:topics.index');
			Route::post('/', 'TopicController@store')->name('store')->middleware('can:topics.create');
			Route::get('create', 'TopicController@create')->name('create')->middleware('can:topics.create');
			Route::delete('{topic}', 'TopicController@destroy')->name('destroy')->middleware('can:topics.destroy');
			Route::put('{topic}', 'TopicController@update')->name('update')->middleware('can:topics.edit');
			Route::get('{topic}', 'TopicController@show')->name('show')->middleware('can:topics.show');
			Route::get('{topic}/edit', 'TopicController@edit')->name('edit')->middleware('can:topics.edit');
		});

		//Displays
		Route::prefix('displays')->name('displays.')->group(function () {
			Route::get('/', 'DisplayController@index')->name('index')->middleware('can:displays.index');
			Route::post('/', 'DisplayController@store')->name('store')->middleware('can:displays.create');
			Route::get('create', 'DisplayController@create')->name('create')->middleware('can:displays.create');
			Route::delete('{display}', 'DisplayController@destroy')->name('destroy')->middleware('can:displays.destroy');
			Route::put('{display}', 'DisplayController@update')->name('update')->middleware('can:displays.edit');
			Route::get('{display}', 'DisplayController@show')->name('show')->middleware('can:displays.show');
			Route::get('{display}/edit', 'DisplayController@edit')->name('edit')->middleware('can:displays.edit');
		});

		//Display-Topics
		Route::prefix('display-topics')->name('display-topics.')->group(function () {
			Route::get('/', 'DisplayTopicController@index')->name('index')->middleware('can:displays.index');
			Route::post('/', 'DisplayTopicController@store')->name('store')->middleware('can:displays.create');
			Route::get('create', 'DisplayTopicController@create')->name('create')->middleware('can:displays.create');
			Route::delete('{display_topic}', 'DisplayTopicController@destroy')->name('destroy')->middleware('can:displays.destroy');
			Route::put('{display_topic}', 'DisplayTopicController@update')->name('update')->middleware('can:displays.edit');
			Route::get('{display_topic}', 'DisplayTopicController@show')->name('show')->middleware('can:displays.show');
			Route::get('{display_topic}/edit', 'DisplayTopicController@edit')->name('edit')->middleware('can:displays.edit');
		});

		//View configurations
		Route::prefix('view-configurations')->name('view-configurations.')->group(function () {
			Route::get('/', 'ViewConfigurationController@index')->name('index')->middleware('can:view-configurations.index');
			Route::post('/', 'ViewConfigurationController@store')->name('store')->middleware('can:view-configurations.create');
			Route::get('create', 'ViewConfigurationController@create')->name('create')->middleware('can:view-configurations.create');
			Route::delete('{view_configuration}', 'ViewConfigurationController@destroy')->name('destroy')->middleware('can:view-configurations.destroy');
			Route::put('{view_configuration}', 'ViewConfigurationController@update')->name('update')->middleware('can:view-configurations.edit');
			Route::get('{view_configuration}', 'ViewConfigurationController@show')->name('show')->middleware('can:view-configurations.show');
			Route::get('{view_configuration}/edit', 'ViewConfigurationController@edit')->name('edit')->middleware('can:view-configurations.edit');
		});

		//Icons
		Route::prefix('icons')->name('icons.')->group(function () {
			Route::get('/', 'IconController@index')->name('index')->middleware('can:icons.index');
			Route::post('/', 'IconController@store')->name('store')->middleware('can:icons.create');
			Route::get('create', 'IconController@create')->name('create')->middleware('can:icons.create');
			Route::delete('{icon}', 'IconController@destroy')->name('destroy')->middleware('can:icons.destroy');
			Route::put('{icon}', 'IconController@update')->name('update')->middleware('can:icons.edit');
			Route::get('{icon}', 'IconController@show')->name('show')->middleware('can:icons.show');
			Route::get('{icon}/edit', 'IconController@edit')->name('edit')->middleware('can:icons.edit');
		});

		//Statuses
		Route::prefix('statuses')->name('statuses.')->group(function () {
			Route::get('/', 'StatusController@index')->name('index')->middleware('can:statuses.index');
			Route::post('/', 'StatusController@store')->name('store')->middleware('can:statuses.create');
			Route::get('create', 'StatusController@create')->name('create')->middleware('can:statuses.create');
			Route::delete('{status}', 'StatusController@destroy')->name('destroy')->middleware('can:statuses.destroy');
			Route::put('{status}', 'StatusController@update')->name('update')->middleware('can:statuses.edit');
			Route::get('{status}', 'StatusController@show')->name('show')->middleware('can:statuses.show');
			Route::get('{status}/edit', 'StatusController@edit')->name('edit')->middleware('can:statuses.edit');
		});
	});

	Route::prefix('admins')->namespace('Device')->group(function () {

		// MQTT Logs
		Route::get('mqtt-logs', 'MqttLogController@index')->name('mqtt-logs.index')->middleware('can:mqtt-logs.index');
		Route::get('mqtt-logs/{device}', 'MqttLogController@show')->name('mqtt-logs.show')->middleware('can:mqtt-logs.show');

		//TypeDevices
		Route::prefix('type-devices')->name('type-devices.')->group(function () {
			Route::get('/', 'TypeDeviceController@index')->name('index')->middleware('can:type-devices.index');
			Route::post('/', 'TypeDeviceController@store')->name('store')->middleware('can:type-devices.create');
			Route::get('create', 'TypeDeviceController@create')->name('create')->middleware('can:type-devices.create');
			Route::delete('{type_device}', 'TypeDeviceController@destroy')->name('destroy')->middleware('can:type-devices.destroy');
			Route::put('{type_device}', 'TypeDeviceController@update')->name('update')->middleware('can:type-devices.edit');
			Route::get('{type_device}', 'TypeDeviceController@show')->name('show')->middleware('can:type-devices.show');
			Route::get('{type_device}/edit', 'TypeDeviceController@edit')->name('edit')->middleware('can:type-devices.edit');
			Route::get('{type_device}/configuration', 'TypeDeviceController@configuration')->name('configuration')->middleware('can:type-devices.configuration');
		});

		//Type Devices Configurations
		Route::post('/type-device-configurations', 'TypeDeviceConfigurationController@store')->name('type-device-configurations.store')->middleware('can:type-device-configurations.create');
		Route::delete('/type-device-configurations/{type_device_configuration}', 'TypeDeviceConfigurationController@destroy')->name('type-device-configurations.destroy')->middleware('can:type-device-configurations.destroy');

	});
	Route::prefix('admins')->group(function () {
		//All views
		Route::get('devices/all', 'Device\DeviceController@all')->name('devices.all')->middleware('can:devices.all');
		Route::get('rules/all', 'User\RuleController@all')->name('rules.all')->middleware('can:rules.all');
		Route::get('alerts/all', 'User\AlertController@all')->name('alerts.all')->middleware('can:alerts.all');
		Route::get('pays/all', 'User\PayController@all')->name('pays.all')->middleware('can:pays.all');
	});



	Route::prefix('centinela')->namespace('Device')->group(function () {

		//Devices
		Route::prefix('devices')->name('devices.')->group(function () {
			Route::get('/', 'DeviceController@index')->name('index')->middleware('can:devices.index');
			Route::post('/', 'DeviceController@store')->name('store')->middleware('can:devices.create');
			Route::get('create', 'DeviceController@create')->name('create')->middleware('can:devices.create');
			Route::delete('{device}', 'DeviceController@destroy')->name('destroy')->middleware('can:devices.destroy');
			Route::put('{device}', 'DeviceController@update')->name('update')->middleware('can:devices.edit');
			Route::get('{device}', 'DeviceController@show')->name('show')->middleware('can:devices.show');
			Route::get('{device}/edit', 'DeviceController@edit')->name('edit')->middleware('can:devices.edit');
			Route::get('{device}/configuration', 'DeviceController@configuration')->name('configuration')->middleware('can:devices.configuration');

		});

		//Device-configurations
		Route::put('/device-configurations/{device_configuration}', 'DeviceConfigurationController@update')->name('device-configurations.update')->middleware('can:devices.configuration');

		//Device-Logs
		Route::prefix('device-logs')->name('device-logs.')->group(function () {
			Route::get('/', 'DeviceLogController@index')->name('index')->middleware('can:device-logs.index');
			Route::post('/', 'DeviceLogController@store')->name('store')->middleware('can:device-logs.create');
			Route::get('{device}', 'DeviceLogController@show')->name('show')->middleware('can:device-logs.show');
			Route::delete('{device_log}', 'DeviceLogController@destroy')->name('destroy')->middleware('can:device-logs.destroy');
		});

	});

	Route::prefix('centinela')->namespace('User')->group(function () {

		//Receptions
		Route::prefix('data-receptions')->name('data-receptions.')->group(function () {
			Route::get('{device}', 'DataReceptionController@show')->name('show')->middleware('can:data-receptions.show');
		});

		//Rules
		Route::prefix('rules')->name('rules.')->group(function () {
			Route::get('/', 'RuleController@index')->name('index')->middleware('can:rules.index');
			Route::post('/', 'RuleController@store')->name('store')->middleware('can:rules.create');
			Route::get('create', 'RuleController@create')->name('create')->middleware('can:rules.create');
			Route::delete('{rule}', 'RuleController@destroy')->name('destroy')->middleware('can:rules.destroy');
			Route::put('{rule}', 'RuleController@update')->name('update')->middleware('can:rules.edit');
			Route::get('{rule}', 'RuleController@show')->name('show')->middleware('can:rules.show');
			Route::get('{rule}/edit', 'RuleController@edit')->name('edit')->middleware('can:rules.edit');

		});

		//Alerts
		Route::prefix('alerts')->name('alerts.')->group(function () {
			Route::get('/', 'AlertController@index')->name('index')->middleware('can:alerts.index');
			Route::get('{device}', 'AlertController@show')->name('show')->middleware('can:alerts.show');

		});

		//Pays
		Route::prefix('pays')->name('pays.')->group(function () {
			Route::get('create/{device}', 'PayController@create')->name('create')->middleware('can:pays.create');
			Route::get('/', 'PayController@index')->name('index')->middleware('can:pays.index');
			Route::get('/{pay}', 'PayController@show')->name('show')->middleware('can:pays.show');
			Route::post('/{device}-{price}', 'PayController@store')->name('store')->middleware('can:pays.create');

		});
	});

	Route::prefix('users')->namespace('User')->group(function () {
		//profile
		Route::prefix('profile')->name('profile.')->group(function () {
			Route::get('/', 'ProfileController@show')->name('show')->middleware('can:profile.show');
			Route::get('update', 'ProfileController@edit')->name('edit')->middleware('can:profile.edit');
			Route::put('update', 'ProfileController@update')->name('update')->middleware('can:profile.edit');
			Route::put('update', 'ProfileController@destroy')->name('destroy')->middleware('can:profile.destroy');
		});
	});
});



