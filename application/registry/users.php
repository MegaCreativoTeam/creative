<?php

return
[
    'text' => Lang::get('dashboard.users'),

    'icon'=> 'fa fa-user',

    'module' => 'backend',

    'info' => Lang::get('dashboard.info.users_module'),
    
    'fields' => [
        'dni' => Lang::get('personal_attr.dni'),
        'name' => Lang::get('personal_attr.name'),
        'last_name' => Lang::get('personal_attr.last_name'),
    ],
    
    'fields_info' => [
        'dni' => [
            'text' => Lang::get('dashboard.attrs.dni'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.dni'),
            'col' => array('sm'=>4,'md'=>3),
            'type' => 'text'
        ],
        'name' => [
            'text' => Lang::get('dashboard.attrs.name'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.profile_name'),
            'col' => array('sm'=>6,'md'=>3),
            'type' => 'text'
        ],
        'last_name' => [
            'text' => Lang::get('dashboard.attrs.last_name'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.last_name'),
            'col' => array('sm'=>6,'md'=>3),
            'type' => 'text'
        ],     
        'email' => [
            'text' => Lang::get('dashboard.attrs.email'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.email'),
            'col' => array('sm'=>6,'md'=>3),
            'type' => 'email'
        ],
        'pass' => [
            'text' => Lang::get('dashboard.attrs.pass'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.pass'),
            'col' => array('sm'=>6,'md'=>3),
            'type' => 'password',
            
        ],
       'profile_id' => [
            'text' => Lang::get('dashboard.attrs.profile'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.profile'),
            'col' => array('sm'=>6,'md'=>4),
            'type' => 'select'
        ],
          'nicname' => [
            'text' => Lang::get('dashboard.attrs.nicname'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.nicname'),
            'col' => array('sm'=>6,'md'=>4),
            'type' => 'text'
        ],
    
        'status' => [
            'text' => Lang::get('dashboard.attrs.status'),
            'required' => TRUE,
            'info' => Lang::get('dashboard.info.status'),
            'col' => array('sm'=>6,'md'=>4),
            'type' => 'select'
        ],
     ],
    


    'filters' => [
        'dni' => Lang::get('dashboard.personal_attr.dni'),
        'name' => Lang::get('dashboard.personal_attr.name'),
        'last_name' => Lang::get('dashboard.personal_attr.last_name'),
        'email' => Lang::get('dashboard.personal_attr.email'),
        'profile_id' => Lang::get('dashboard.personal_attr.profile'),
    ]
    
];
