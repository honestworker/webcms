<?php

return array(

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

	"accepted"             => "The &laquo;:attribute&raquo; must be accepted.",
	"active_url"           => "The &laquo;:attribute&raquo; is not a valid URL.",
	"after"                => "The &laquo;:attribute&raquo; must be a date after :date.",
	"alpha"                => "The &laquo;:attribute&raquo; may only contain letters.",
	"alpha_dash"           => "The &laquo;:attribute&raquo; may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The &laquo;:attribute&raquo; may only contain letters and numbers.",
	"array"                => "The &laquo;:attribute&raquo; must be an array.",
	"before"               => "The &laquo;:attribute&raquo; must be a date before :date.",
	"between"              => array(
		"numeric" => "The &laquo;:attribute&raquo; must be between :min and :max.",
		"file"    => "The &laquo;:attribute&raquo; must be between :min and :max kilobytes.",
		"string"  => "The &laquo;:attribute&raquo; must be between :min and :max characters.",
		"array"   => "The &laquo;:attribute&raquo; must have between :min and :max items.",
	),
	"boolean"              => "The &laquo;:attribute&raquo; field must be true or false.",
	"confirmed"            => "The &laquo;:attribute&raquo; confirmation does not match.",
	"date"                 => "The &laquo;:attribute&raquo; is not a valid date.",
	"date_format"          => "The &laquo;:attribute&raquo; does not match the format :format.",
	"different"            => "The &laquo;:attribute&raquo; and :other must be different.",
	"digits"               => "The &laquo;:attribute&raquo; must be :digits digits.",
	"digits_between"       => "The &laquo;:attribute&raquo; must be between :min and :max digits.",
	"email"                => "Поле &laquo;:attribute&raquo; заполнено неверно.",
	"exists"               => "The selected &laquo;:attribute&raquo; is invalid.",
	"image"                => "The &laquo;:attribute&raquo; must be an image.",
	"in"                   => "The selected &laquo;:attribute&raquo; is invalid.",
	"integer"              => "The &laquo;:attribute&raquo; must be an integer.",
	"ip"                   => "The &laquo;:attribute&raquo; must be a valid IP address.",
	"max"                  => array(
		"numeric" => "The &laquo;:attribute&raquo; may not be greater than :max.",
		"file"    => "The &laquo;:attribute&raquo; may not be greater than :max kilobytes.",
		"string"  => "The &laquo;:attribute&raquo; may not be greater than :max characters.",
		"array"   => "The &laquo;:attribute&raquo; may not have more than :max items.",
	),
	"mimes"                => "The &laquo;:attribute&raquo; must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "Значение в поле &laquo;:attribute&raquo; должно быть не менее :min.",
		"file"    => "The &laquo;:attribute&raquo; must be at least :min kilobytes.",
		"string"  => "Поле &laquo;:attribute&raquo; должно содержать не менее :min символов.",
		"array"   => "The &laquo;:attribute&raquo; must have at least :min items.",
	),
	"not_in"               => "The selected &laquo;:attribute&raquo; is invalid.",
	"numeric"              => "The &laquo;:attribute&raquo; must be a number.",
	"regex"                => "The &laquo;:attribute&raquo; format is invalid.",
	"required"             => "Поле &laquo;&laquo;:attribute&raquo;&raquo; должно быть заполнено.",
	"required_if"          => "The &laquo;:attribute&raquo; field is required when :other is :value.",
	"required_with"        => "The &laquo;:attribute&raquo; field is required when :values is present.",
	"required_with_all"    => "The &laquo;:attribute&raquo; field is required when :values is present.",
	"required_without"     => "The &laquo;:attribute&raquo; field is required when :values is not present.",
	"required_without_all" => "The &laquo;:attribute&raquo; field is required when none of :values are present.",
	"same"                 => "Поля &laquo;:attribute&raquo; и :other должны совпадать.",
	"size"                 => array(
		"numeric" => "The &laquo;:attribute&raquo; must be :size.",
		"file"    => "The &laquo;:attribute&raquo; must be :size kilobytes.",
		"string"  => "The &laquo;:attribute&raquo; must be :size characters.",
		"array"   => "The &laquo;:attribute&raquo; must contain :size items.",
	),
	"unique"               => "Такой &laquo;:attribute&raquo; уже существует.",
	"url"                  => "The &laquo;:attribute&raquo; format is invalid.",
	"timezone"             => "The &laquo;:attribute&raquo; must be a valid zone.",

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

	'custom' => array(
		'attribute-name' => array(
		'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
			'title' => 'Заголовок',
			'body' => 'Содержание',
			'password' => 'Пароль',
			'repeat_password' => 'Повтор пароля',
			'email' => 'Email',
			'first_name' => 'Имя',
			'last_name' => 'Фамилия',
			'topic' => 'Тема'
		),

);
