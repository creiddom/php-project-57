<?php

return [

    'required' => 'Это обязательное поле',
    'email' => 'Неверный email-адрес',

    'custom' => [
        'password' => [
            'min' => [
                'string' => 'Пароль должен иметь длину не менее :min символов',
            ],
            'confirmed' => 'Пароль и подтверждение не совпадают',
        ],
    ],

    'attributes' => [
        'name' => 'Имя',
        'description' => 'Описание',
        'status_id' => 'Статус',
        'assigned_to_id' => 'Исполнитель',
    ],

];
