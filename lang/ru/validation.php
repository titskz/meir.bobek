<?php

return [

    'required' => 'Поле :attribute обязательно для заполнения.',
    'email' => 'Поле :attribute должно быть действительным email адресом.',
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',
    'string' => 'Поле :attribute должно быть строкой.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'boolean' => 'Поле :attribute должно иметь значение «да» или «нет».',
    'array' => 'Поле :attribute должно быть массивом.',
    'file' => 'Поле :attribute должно быть файлом.',
    'image' => 'Поле :attribute должно быть изображением.',
    'mimes' => 'Файл :attribute должен иметь один из форматов: :values.',
    'url' => 'Поле :attribute должно содержать корректный URL.',
    'unique' => 'Такое значение поля :attribute уже используется.',
    'alpha_dash' => 'Поле :attribute может содержать только латинские буквы, цифры, дефисы и подчёркивания.',
    'min' => [
        'numeric' => 'Значение поля :attribute должно быть не меньше :min.',
        'file' => 'Размер файла :attribute должен быть не меньше :min КБ.',
        'string' => 'Поле :attribute должно содержать не менее :min символов.',
        'array' => 'Поле :attribute должно содержать не менее :min элементов.',
    ],
    'max' => [
        'numeric' => 'Значение поля :attribute не должно превышать :max.',
        'file' => 'Размер файла :attribute не должен превышать :max КБ.',
        'string' => 'Поле :attribute не должно содержать больше :max символов.',
        'array' => 'Поле :attribute не должно содержать больше :max элементов.',
    ],
    'current_password' => 'Неверный пароль.',

    'attributes' => [
        'email' => 'email',
        'password' => 'пароль',
        'current_password' => 'текущий пароль',
        'password_confirmation' => 'подтверждение пароля',
        'name' => 'имя',
        'code' => 'код',
        'recovery_code' => 'код восстановления',
        'title' => 'название',
        'slug' => 'URL',
        'content' => 'содержание',
        'image' => 'изображение',
        'sort_order' => 'порядок',
        'position' => 'должность',
        'logo' => 'логотип',
        'favicon' => 'favicon',
        'hero_image' => 'фото главного экрана',
        'manager_photo' => 'фото руководителя',
    ],

];
