<?php

return
[
    'text' => 'Carreras',

    'icon'=> '',

    'module' => 'backend',

    'api' => '/api/v1/carreras.json/',

    'table' => 'carreras',

    'filters' => [
        'dni' => Lang::get('dashboard.personal_attr.dni'),
        'name' => Lang::get('dashboard.personal_attr.name'),
        'last_name' => Lang::get('dashboard.personal_attr.last_name'),
        'email' => Lang::get('dashboard.personal_attr.email'),
        'profile_id' => Lang::get('dashboard.personal_attr.profile'),
    ],

    'fields_info' => [

        'codigo' => [
            'text' => Lang::get('dashboard.attrs.code'),
            'required' => TRUE,
            'info' => 'Cédula',
            'col' => col(12),
            'type' => 'text',
            'uninique' => TRUE,
            'validation' => "/^[a-z 0-9]{4,10}$/i",
            'failed' => 'Ingrese un Código válido para continuar, este debe tener entre 4 y 10 caracteres alfanuméricos.',
        ],

        'nombre' => [
            'text' => 'Nombre',
            'required' => TRUE,
            'info' => 'Nombre de la carrera o especialidad',
            'col' => col(12),
            'type' => 'text',
            'validation' => "/^\w{4,50}/i", //Establece cualquier caractere alfanumerico  con una longitud entre 4 y 50
            'failed' => 'Ingrese un Nombre válido para continuar, este debe tener entre 4 y 50 caracteres alfanuméricos.'
        ],

        'status' => [
            'text' => 'Estatus',
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.status'),
            'col' => col(12),
            'type' => 'select',
            'items' => [
                '-1' => Lang::get('dashboard.select'),
                '1' => Lang::get('dashboard.status.active'),
                '0' => Lang::get('dashboard.status.inactive')
            ],
            'validation' => "/^[0-1]+$/", //Número entero
            'failed' => Lang::get('dashboard.required_status'),
        ],

       /* 'materias' => [
            'text' => 'Materias',
            'required' => FALSE,
            'col' => col(12,12),
            'outtable' => TRUE,
            'type' => 'select',
            'multiple' => TRUE,            
            'items' => Creative::get( 'Components' )
                        ->render( 'DataSource' )
                        ->create( 'materias_simplelist', [
                            'source'=> 'materias',
                            'key'	=> 'id',
                            'value'	=> 'nombre'
                        ])
                        ->execute()
        ],*/
     ],

    'filters' => [
        'codigo' => Lang::get('dashboard.attrs.code'),
        'name' => Lang::get('dashboard.attrs.name')
    ]
];