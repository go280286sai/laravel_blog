<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Потрібно прийняти :attribute.',
    'accepted_if' => 'Атрибут :attribute повинен прийматися, якщо :other є :value.',
    'active_url' => ':attribute не є дійсною URL-адресою.',
    'after' => ':attribute має бути датою після :date.',
    'after_or_equal' => ':attribute має бути датою після або дорівнювати :date.',
    'alpha' => ':attribute має містити лише літери.',
    'alpha_dash' => ':attribute повинен містити лише літери, цифри, тире та підкреслення.',
    'alpha_num' => 'Поле :attribute має містити лише літери та цифри.',
    'array' => ':attribute має бути масивом.',
    'before' => ':attribute має бути датою перед :date.',
    'before_or_equal' => 'Поле :attribute має бути датою, що передує або дорівнює :date.',
    'between' => [
        'array' => 'Поле :attribute має містити між :min і :max елементами.',
        'file' => 'Поле :attribute має бути між :min і :max кілобайтами.',
        'numeric' => 'Поле :attribute має бути між :min і :max.',
        'string' => 'Поле :attribute має бути між символами :min і :max.',
    ],
    'boolean' => 'Поле :attribute має бути true або false.',
    'confirmed' => 'Підтвердження :attribute не збігається.',
    'current_password' => 'Пароль невірний.',
    'date' => ':attribute не є дійсною датою.',
    'date_equals' => 'Поле :attribute має бути датою, що дорівнює :date.',
    'date_format' => ':attribute не відповідає формату:format.',
    'declined' => ':attribute має бути відхилено.',
    'declined_if' => 'Атрибут :attribute має бути відхилений, якщо :other є :value.',
    'different' => 'Параметри :attribute і :other мають бути різними.',
    'digits' => ':attribute має бути :digits цифрами.',
    'digits_between' => 'Поле :attribute має бути між :min та :max цифрами.',
    'dimensions' => 'Атрибут :attribute має недійсні розміри зображення.',
    'distinct' => 'Поле :attribute має повторюване значення.',
    'doesnt_end_with' => 'Поле :attribute не може закінчуватися одним із наступних: :values.',
    'doesnt_start_with' => 'Поле :attribute не може починатися з одного з наступного: :values.',
    'email' => ':attribute має бути дійсною електронною адресою.',
    'ends_with' => 'Поле :attribute має закінчуватися одним із наступних: :values.',
    'enum' => 'Вибраний :attribute недійсний.',
    'exists' => 'Вибраний :attribute недійсний.',
    'file' => ':attribute має бути файлом.',
    'filled' => 'Поле :attribute повинно мати значення.',
    'gt' => [
        'array' => ':attribute повинен містити більше ніж :value елементів.',
        'file' => 'Параметр :attribute має бути більшим за :value кілобайт.',
        'numeric' => 'Параметр :attribute має бути більшим за :value.',
        'string' => 'Поле :attribute має бути більше ніж :value символів.',
    ],
    'gte' => [
        'array' => ':attribute повинен містити елементи :value або більше.',
        'file' => 'Поле :attribute має бути більше або дорівнювати :value кілобайт.',
        'numeric' => 'Поле :attribute має бути більше або дорівнювати :value.',
        'string' => 'Поле :attribute має бути більше або дорівнювати символам :value.',
    ],
    'image' => ':attribute має бути зображенням.',
    'in' => 'Вибраний :attribute недійсний.',
    'in_array' => 'Поле :attribute не існує в :other.',
    'integer' => 'Поле :attribute має бути цілим числом.',
    'ip' => ':attribute має бути дійсною IP-адресою.',
    'ipv4' => ':attribute має бути дійсною адресою IPv4.',
    'ipv6' => ':attribute має бути дійсною адресою IPv6.',
    'json' => ':attribute має бути дійсним рядком JSON.',
    'lt' => [
        'array' => ':attribute має містити менше ніж :value елементів.',
        'file' => 'Поле :attribute має бути меншим за :value кілобайт.',
        'numeric' => 'Поле :attribute має бути менше за :value.',
        'string' => 'Поле :attribute має містити менше символів :value.',
    ],
    'lte' => [
        'array' => ':attribute не може містити більше ніж :value елементів.',
        'file' => 'Поле :attribute має бути менше або дорівнювати :value кілобайт.',
        'numeric' => 'Поле :attribute має бути менше або дорівнювати :value.',
        'string' => 'Поле :attribute має бути менше або дорівнювати символам :value.',
    ],
    'mac_address' => ':attribute має бути дійсною MAC-адресою.',
    'max' => [
        'array' => ':attribute не може містити більше ніж :max елементів.',
        'file' => 'Параметр :attribute не повинен перевищувати :max кілобайт.',
        'numeric' => 'Параметр :attribute не повинен перевищувати :max.',
        'string' => 'Поле :attribute не повинно перевищувати :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно містити більше ніж :max цифр.',
    'mimes' => ':attribute має бути файлом типу: :values.',
    'mimetypes' => ':attribute має бути файлом типу: :values.',
    'min' => [
        'array' => ':attribute повинен містити принаймні :min елементів.',
        'file' => 'Поле :attribute має бути не менше :min кілобайт.',
        'numeric' => 'Поле :attribute має бути не менше :min.',
        'string' => 'Поле :attribute має містити принаймні :min символів.',
    ],
    'min_digits' => 'Атрибут :attribute повинен містити принаймні :min цифр.',
    'multiple_of' => 'Поле :attribute має бути кратним :value.',
    'not_in' => 'Вибраний :attribute недійсний.',
    'not_regex' => 'Формат :attribute недійсний.',
    'numeric' => ':attribute має бути числом.',
    'password' => [
        'letters' => ':attribute повинен містити принаймні одну літеру.',
        'mixed' => ':attribute повинен містити принаймні одну велику та одну малу літери.',
        'numbers' => ':attribute повинен містити принаймні одне число.',
        'symbols' => ':attribute повинен містити принаймні один символ.',
        'uncompromised' => 'Даний :attribute зявився в результаті витоку даних. Виберіть інший :attribute.',
    ],
    'present' => 'Поле :attribute повинно бути присутнім.',
    'prohibited' => 'Поле :attribute заборонено.',
    'prohibited_if' => 'Поле :attribute заборонено, якщо :other дорівнює :value.',
    'prohibited_unless' => 'Поле :attribute заборонено, якщо :other не міститься в :values.',
    'prohibits' => 'Поле :attribute забороняє присутність :other.',
    'regex' => 'Формат :attribute недійсний.',
    'required' => 'Поле :attribute є обовязковим.',
    'required_array_keys' => 'Поле :attribute має містити записи для: :values.',
    'required_if' => 'Поле :attribute є обовязковим, якщо :other є :value.',
    'required_if_accepted' => 'Поле :attribute є обовязковим, якщо прийнято :other.',
    'required_unless' => 'Поле :attribute є обовязковим, якщо :other не міститься в :values.',
    'required_with' => 'Поле :attribute є обовязковим, якщо присутній :values.',
    'required_with_all' => 'Поле :attribute є обовязковим, якщо присутні :values.',
    'required_without' => 'Поле :attribute є обовязковим, якщо немає :values.',
    'required_without_all' => 'Поле :attribute є обовязковим, якщо немає жодного з :values.',
    'same' => ':attribute і :other повинні збігатися.',
    'size' => [
        'array' => ':attribute повинен містити елементи :size.',
        'file' => 'Поле :attribute має бути :size кілобайт.',
        'numeric' => 'Поле :attribute має бути :size.',
        'string' => 'Поле :attribute має містити символи :size.',
    ],
    'starts_with' => 'Поле :attribute повинно починатися з одного з наступного: :values.',
    'string' => ':attribute має бути рядком.',
    'timezone' => 'Поле :attribute має бути дійсним часовим поясом.',
    'unique' => ':attribute вже використано.',
    'uploaded' => 'Не вдалося завантажити :attribute.',
    'url' => 'Поле :attribute має бути дійсною URL-адресою.',
    'uuid' => ':attribute має бути дійсним UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
