<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Roles
        Permission::create([
        	'name' => 'Listar roles',
        	'slug' => 'roles.index',
        	'description' => 'Listar y navegar todos los roles',
        ]);
        Permission::create([
        	'name' => 'Ver rol',
        	'slug' => 'roles.show',
        	'description' => 'Ver informacion de un rol especifico',
        ]);
        Permission::create([
        	'name' => 'Crear rol',
        	'slug' => 'roles.create',
        	'description' => 'Crear un nuevo rol',
        ]);
        Permission::create([
        	'name' => 'Eliminar rol',
        	'slug' => 'roles.destroy',
        	'description' => 'Elimina un rol y toda su informacion',
        ]);
        Permission::create([
        	'name' => 'Editar rol',
        	'slug' => 'roles.edit',
        	'description' => 'Editar la informacion de un rol',
        ]);

        //Users
        Permission::create([
        	'name' => 'Listar usuarios',
        	'slug' => 'users.index',
        	'description' => 'Listar y navegar todos los usuarios',
        ]);
        Permission::create([
        	'name' => 'Ver usuario',
        	'slug' => 'users.show',
        	'description' => 'Ver informacion de un usuario especifico',
        ]);
        Permission::create([
        	'name' => 'Eliminar usuario',
        	'slug' => 'users.destroy',
        	'description' => 'Elimina un usuario y toda su informacion',
        ]);
        Permission::create([
        	'name' => 'Editar usuario',
        	'slug' => 'users.edit',
        	'description' => 'Editar la informacion de un usuario',
        ]);

    	//Devices
        Permission::create([
        	'name' => 'Listar dispositivos por usuario',
        	'slug' => 'devices.index',
        	'description' => 'Listar y navegar todos sus dispositivos',
        ]);
        Permission::create([
            'name' => 'Listar todos los dispositivos',
            'slug' => 'devices.all',
            'description' => 'Listar y navegar todos los dispositivos existentes',
        ]);
        Permission::create([
        	'name' => 'Ver dispositivo',
        	'slug' => 'devices.show',
        	'description' => 'Ver informacion de un dispositivo especifico',
        ]);
        Permission::create([
            'name' => 'Ver log',
            'slug' => 'devices.log',
            'description' => 'Ver informacion log de un dispositivo especifico',
        ]);
        Permission::create([
        	'name' => 'Crear dispositivo',
        	'slug' => 'devices.create',
        	'description' => 'Crear un nuevo dispositivo',
        ]);
        Permission::create([
        	'name' => 'Eliminar dispositivo',
        	'slug' => 'devices.destroy',
        	'description' => 'Elimina un dispositivo y toda su informacion',
        ]);
        Permission::create([
        	'name' => 'Editar dispositivo',
        	'slug' => 'devices.edit',
        	'description' => 'Editar la informacion de un dispositivo',
        ]);

        //Alerts
        Permission::create([
            'name' => 'Listar alertas por usuario',
            'slug' => 'alerts.index',
            'description' => 'Ver todas las alertas de un usuario',
        ]);
        Permission::create([
            'name' => 'Listar alertas por equipo',
            'slug' => 'alerts.show',
            'description' => 'Ver las alertas de un dispositivo',
        ]);
        Permission::create([
            'name' => 'Listar todas las alertas',
            'slug' => 'alerts.all',
            'description' => 'Listar y navegar todas las alertas ocurridas organizadas por dispositivo',
        ]);

        //Receptions
        Permission::create([
        	'name' => 'Ver ultima hora',
        	'slug' => 'receptions.show',
        	'description' => 'Ver el grafico de la ultima hora de un dispositivo',
        ]);

        Permission::create([
            'name' => 'Ver todos los datos',
            'slug' => 'receptions.show-all',
            'description' => 'Ver el grafico de todos los datos de un dispositivo',
        ]);

        //User
        Permission::create([
            'name' => 'Ver sus datos',
            'slug' => 'users.show-me',
            'description' => 'Ver sus datos personales de usuario',
        ]);

        Permission::create([
            'name' => 'Editar sus datos',
            'slug' => 'users.edit-me',
            'description' => 'Editar sus datos personales de usuario',
        ]);

        //Pays
        Permission::create([
            'name' => 'Ver sus pagos',
            'slug' => 'pays.index',
            'description' => 'Ver los pagos de un usuario',
        ]);

        Permission::create([
            'name' => 'Ver pago',
            'slug' => 'pays.show',
            'description' => 'Ver un pago especifico de un usuario',
        ]);

        Permission::create([
            'name' => 'Pagar',
            'slug' => 'pays.create',
            'description' => 'Crear un pago para un dispositivo',
        ]);

        //Webhooks
        Permission::create([
            'name' => 'Ver WebHooks',
            'slug' => 'webhooks.index',
            'description' => 'Ver todos los webhooks de la plataforma',
        ]);

        Permission::create([
            'name' => 'Ver WebHook',
            'slug' => 'webhooks.show',
            'description' => 'Ver un webhook especifico',
        ]);

    }
}
