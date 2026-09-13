<?php

return [

    'required' => ':attribute өрісі міндетті.',
    'email' => ':attribute өрісі жарамды email болуы керек.',
    'confirmed' => ':attribute растаумен сәйкес келмейді.',
    'string' => ':attribute мәтін болуы керек.',
    'integer' => ':attribute бүтін сан болуы керек.',
    'boolean' => ':attribute «иә» немесе «жоқ» мәніне ие болуы керек.',
    'array' => ':attribute массив болуы керек.',
    'file' => ':attribute файл болуы керек.',
    'image' => ':attribute сурет болуы керек.',
    'mimes' => ':attribute файлының пішімі мына тізімде болуы керек: :values.',
    'url' => ':attribute дұрыс URL болуы керек.',
    'unique' => ':attribute мәні бұрыннан қолданылған.',
    'alpha_dash' => ':attribute тек латын әріптерінен, сандардан, сызықша мен астыңғы сызықтан тұруы керек.',
    'min' => [
        'numeric' => ':attribute мәні кемінде :min болуы керек.',
        'file' => ':attribute файлының көлемі кемінде :min КБ болуы керек.',
        'string' => ':attribute кемінде :min таңба болуы керек.',
        'array' => ':attribute кемінде :min элементтен тұруы керек.',
    ],
    'max' => [
        'numeric' => ':attribute мәні :max мөлшерінен аспауы керек.',
        'file' => ':attribute файлының көлемі :max КБ-тан аспауы керек.',
        'string' => ':attribute :max таңбадан аспауы керек.',
        'array' => ':attribute :max элементтен аспауы керек.',
    ],
    'current_password' => 'Құпия сөз дұрыс емес.',

    'attributes' => [
        'email' => 'email',
        'password' => 'құпия сөз',
        'current_password' => 'ағымдағы құпия сөз',
        'password_confirmation' => 'құпия сөзді растау',
        'name' => 'аты',
        'code' => 'код',
        'recovery_code' => 'қалпына келтіру коды',
        'title' => 'атауы',
        'slug' => 'URL',
        'content' => 'мазмұны',
        'image' => 'сурет',
        'sort_order' => 'реті',
        'position' => 'лауазымы',
        'logo' => 'логотип',
        'favicon' => 'favicon',
        'hero_image' => 'басты экран фотосы',
        'manager_photo' => 'меңгеруші фотосы',
    ],

];
