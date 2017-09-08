<?php

return
[
    'text' => 'Profesores',

    'icon'=> '',

    'module' => 'backend',

    'api' => '/api/v1/profesores.json/',

    'table' => 'profesores',

    'filters' => [
        'dni' => Lang::get('dashboard.personal_attr.dni'),
        'name' => Lang::get('dashboard.personal_attr.name'),
        'last_name' => Lang::get('dashboard.personal_attr.last_name'),
        'email' => Lang::get('dashboard.personal_attr.email'),
        'profile_id' => Lang::get('dashboard.personal_attr.profile'),
    ],

    'fields_info' => [
        'cedula' => [
            'text' => Lang::get('dashboard.attrs.dni'),
            'type' => 'text',
            'col' => col(3,3,6),
            'required' => TRUE,
            'uninique' => TRUE,
            'validation' => "/^[0-9]{4,8}$/",
            'failed' => 'Ingrese un Número de Cédula válido para continuar, este debe tener entre 4 y 8 caracteres alfanuméricos.',
        ],
        'nombre' => [
            'text' => Lang::get('dashboard.attrs.name'),
            'required' => TRUE,
            'col' => col(3,3,6),
            'type' => 'text',
            'validation' => "/^\w{4,50}/i", //Establece cualquier caractere alfanumerico  con una longitud entre 4 y 50
            'failed' => 'Ingrese un Nombre válido para continuar, este debe tener entre 4 y 50 caracteres alfanuméricos.',
        ],
        'apellido' => [
            'text' => Lang::get('dashboard.attrs.last_name'),
            'required' => TRUE,
            'col' => col(3,3,6),
            'type' => 'text'
        ],
        'status' => [
            'text' => Lang::get('dashboard.attrs.status'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.status'),
            'col' => col(3,3,6),
            'type' => 'select',
            'items' => [
                '-1' => Lang::get('dashboard.select'),
                '1' => Lang::get('dashboard.status.active'),
                '0' => Lang::get('dashboard.status.inactive')
            ]
        ],

        'email' => [
            'text' => Lang::get('dashboard.attrs.email'),
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'email'
        ],
        'tel_movil' => [
            'text' => Lang::get('dashboard.attrs.tel_mobile'),
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'tel'
        ],
        'tel_habitacion' => [
            'text' => Lang::get('dashboard.attrs.tel_house'),
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'tel'
        ],
        'tel_contacto' => [
            'text' => Lang::get('dashboard.attrs.tel_contact'),
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'tel'
        ],        

        'nivel_profesion' => [
            'text' => 'Nivel profesional',
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'select',
            'items' => Creative::get( 'Components' )
                        ->render( 'DataSource' )
                        ->get_stock( 'nivel_profesion' )
        ],
        'area_profesional' => [
            'text' => 'Área profesional',
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'select',
            'items' => Creative::get( 'Components' )
                        ->render( 'DataSource' )
                        ->get_stock( 'area_profesional' )
        ],

        'estado' => [
            'text' => 'Estado',
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'tel'
        ],
        'ciudad' => [
            'text' => 'Ciudad',
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'tel'
        ],
        'parroquia' => [
            'text' => 'Parroquia',
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'tel'
        ],
        'direccion' => [
            'text' => 'Dirección',
            'required' => FALSE,
            'col' => col(12),
            'type' => 'text'
        ],

        'sede_id' => [
            'text' => 'Sede',
            'required' => FALSE,
            'col' => col(3,3,6),
            'type' => 'select',
            'multiple' => FALSE,
            'items' => Creative::get( 'Components' )
                        ->render( 'DataSource' )
                        ->create( 'sedes', [
                            'source'=> 'sedes',
                            'key'	=> 'id',
                            'value'	=> 'nombre'
                        ])
                        ->execute()
        ],
        'materias' => [
            'text' => 'Materias',
            'required' => FALSE,
            'outtable' => TRUE,
            'col' => col(9,9,6),
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
        ],
     ],

    
    'filters' => [
        'cedula' => Lang::get('dashboard.attrs.dni'),
        'nombre' => Lang::get('dashboard.attrs.name'),
        'apellido' => Lang::get('dashboard.attrs.last_name'),
        'email' => Lang::get('dashboard.attrs.email'),
        'sede_id' => 'Sedes',
        'nivel_profesion' => 'Nivel de instrucción',
        'area_profesional' => 'Área de profesión',
    ]
];