<?php

return
[
    'text' => Lang::get('dashboard.modules.administration'),

    'icon'=> 'fa fa-cogs',

    'module' => 'backend',

    'submodules' => [
        'administrators',
        'profiles',
        'matriculas',
        'inscripciones',
        'profesores',
        'pensum'
    ]
];