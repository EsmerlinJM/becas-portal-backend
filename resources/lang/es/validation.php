<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validación del idioma
	|--------------------------------------------------------------------------
	|
    | Las siguientes líneas de idioma contienen los mensajes de error predeterminados utilizados por
    | La clase validadora. Algunas de estas reglas tienen múltiples versiones tales
    | como las reglas de tamaño. Siéntase libre de modificar cada uno de estos mensajes aquí.
	|
	*/

	'accepted'              => 'El :attribute debe ser aceptado.',
	'active_url'            => 'El :attribute no es una URL válida.',
	'after'                 => 'El :attribute debe ser una fecha después de :date.',
	'after_or_equal'        => 'El :attribute debe ser una fecha después o igual a :date.',
	'alpha'                 => 'El :attribute sólo puede contener letras.',
	'alpha_dash'            => 'El :attribute sólo puede contener letras, números y guiones.',
	'alpha_num'             => 'El :attribute sólo puede contener letras y números.',
	'array'                 => 'El :attribute debe ser un dato tipo array.',
	'before'                => 'El :attribute debe ser una fecha antes de :date.',
	'before_or_equal'       => 'El :attribute debe ser una fecha antes o igual a :date.',
	'between'               => [
		'numeric' => 'El :attribute debe estar entre :min - :max.',
		'file'    => 'El :attribute debe estar entre :min - :max kilobytes.',
		'string'  => 'El :attribute debe estar entre :min - :max caracteres.',
		'array'   => 'El :attribute debe tener entre :min y :max elementos.',
	],
	'boolean'               => 'El :attribute debe ser verdadero o falso.',
	'confirmed'             => 'El campo de confirmación de :attribute no coincide.',
	'date'                  => 'El :attribute no es una fecha válida.',
	'date_equals'			=> 'El :attribute debe ser una fecha igual a :date.',
	'date_format' 	        => 'El :attribute no corresponde con el formato :format.',
	'different'             => 'Los campos :attribute y :other deben ser diferentes.',
	'digits'                => 'El :attribute debe ser de :digits dígitos.',
	'digits_between'        => 'El :attribute debe tener entre :min y :max dígitos.',
	'dimensions'            => 'El :attribute no tiene una dimensión válida.',
	'distinct'              => 'El :attribute tiene un valor duplicado.',
	'email'                 => 'El formato del :attribute es inválido.',
	'ends_with'				=> 'El :attribute debe terminar con alguno de los valores: :values.',
	'exists'                => 'El :attribute seleccionado es inválido.',
	'file'                  => 'El :attribute debe ser un archivo.',
	'filled'                => 'El :attribute es requerido.',
	'gt'                    => [
		'numeric' => 'El :attribute debe ser mayor que :value.',
		'file'    => 'El :attribute debe ser mayor que :value kilobytes.',
		'string'  => 'El :attribute debe ser mayor que :value caracteres.',
		'array'   => 'El :attribute puede tener hasta :value elementos.',
	],
	'gte'                   => [
		'numeric' => 'El :attribute debe ser mayor o igual que :value.',
		'file'    => 'El :attribute debe ser mayor o igual que :value kilobytes.',
		'string'  => 'El :attribute debe ser mayor o igual que :value caracteres.',
		'array'   => 'El :attribute puede tener :value elementos o más.',
	],
	'image'                 => 'El :attribute debe ser una imagen.',
	'in'                    => 'El :attribute seleccionado es inválido.',
	'in_array'              => 'El :attribute no existe en :other.',
	'integer'               => 'El :attribute debe ser un entero.',
	'ip'                    => 'El :attribute debe ser una dirección IP válida.',
	'ipv4'                  => 'El :attribute debe ser una dirección IPv4 válida.',
	'ipv6'                  => 'El :attribute debe ser una dirección IPv6 válida.',
	'json'                  => 'El :attribute debe ser una cadena JSON válida.',
	'lt'                   => [
		'numeric' => 'El :attribute debe ser menor que :max.',
		'file'    => 'El :attribute debe ser menor que :max kilobytes.',
		'string'  => 'El :attribute debe ser menor que :max caracteres.',
		'array'   => 'El :attribute puede tener hasta :max elementos.',
	],
	'lte'                   => [
		'numeric' => 'El :attribute debe ser menor o igual que :max.',
		'file'    => 'El :attribute debe ser menor o igual que :max kilobytes.',
		'string'  => 'El :attribute debe ser menor o igual que :max caracteres.',
		'array'   => 'El :attribute no puede tener más que :max elementos.',
	],
	'max'                   => [
		'numeric' => 'El campo :attribute debe ser menor que :max.',
		'file'    => 'El campo :attribute debe ser menor que :max kilobytes.',
		'string'  => 'El campo :attribute debe ser menor que :max caracteres.',
		'array'   => 'El campo :attribute puede tener hasta :max elementos.',
	],
	'mimes'                 => 'El :attribute debe ser un archivo de tipo: :values.',
	'mimetypes'             => 'El :attribute debe ser un archivo de tipo: :values.',
	'min'                   => [
		'numeric' => 'El :attribute debe tener al menos :min.',
		'file'    => 'El :attribute debe tener al menos :min kilobytes.',
		'string'  => 'El :attribute debe tener al menos :min caracteres.',
		'array'   => 'El :attribute debe tener al menos :min elementos.',
	],
	'multiple_of' 			=> 'El :attribute debe ser un múltiplo de :value.',
	'not_in'                => 'El :attribute seleccionado es invalido.',
	'not_regex'             => 'El formato del campo :attribute es inválido.',
	'numeric'               => 'El :attribute debe ser un número.',
	'password'				=> 'La contraseña es incorrecta.',
	'present'               => 'El :attribute debe estar presente.',
	'regex'                 => 'El formato del campo :attribute es inválido.',
	'required'              => 'El :attribute es requerido.',
	'required_if'           => 'El :attribute es requerido cuando el :other es :value.',
	'required_unless'       => 'El :attribute es requerido a menos que :other esté presente en :values.',
	'required_with'         => 'El :attribute es requerido cuando :values está presente.',
	'required_with_all'     => 'El :attribute es requerido cuando :values está presente.',
	'required_without'      => 'El :attribute es requerido cuando :values no está presente.',
	'required_without_all'  => 'El :attribute es requerido cuando ningún :values está presente.',
    'prohibited' 			=> 'El :attribute está prohibido.',
    'prohibited_if'			=> 'El :attribute está prohibido cuando :other es :value.',
    'prohibited_unless'		=> 'El :attribute está prohibido si :other no está en :values.',
	'same'                  => 'El :attribute y :other debe coincidir.',
	'size'                  => [
		'numeric' => 'El :attribute debe ser :size.',
		'file'    => 'El :attribute debe tener :size kilobytes.',
		'string'  => 'El :attribute debe tener :size caracteres.',
		'array'   => 'El :attribute debe contener :size elementos.',
	],
	'starts_with'           => 'El :attribute debe empezar con uno de los siguientes valores :values',
	'string'                => 'El :attribute debe ser una cadena de texto.',
	'timezone'              => 'El :attribute debe ser una zona horaria válida.',
	'unique'                => 'El :attribute ya ha sido tomado.',
	'uploaded'              => 'El :attribute no ha podido ser cargado.',
	'url'                   => 'El formato de :attribute es inválido.',
	'uuid'                  => 'El :attribute debe ser un UUID valido.',

	/*
	|--------------------------------------------------------------------------
	| Validación del idioma personalizado
	|--------------------------------------------------------------------------
	|
	|	Aquí puede especificar mensajes de validación personalizados para atributos utilizando el
	| convención "attribute.rule" para nombrar las líneas. Esto hace que sea rápido
	| especifique una línea de idioma personalizada específica para una regla de atributo dada.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name'  => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Atributos de validación personalizados
	|--------------------------------------------------------------------------
	|
        | Las siguientes líneas de idioma se utilizan para intercambiar los marcadores de posición de atributo.
        | con algo más fácil de leer, como la dirección de correo electrónico.
        | de "email". Esto simplemente nos ayuda a hacer los mensajes un poco más limpios.
	|
	*/

	'attributes' => [],

];