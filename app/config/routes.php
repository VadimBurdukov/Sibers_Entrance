<?
return [

//Main routes

	'' => [
		'CONTROLLER' => 'main',
		'ACTION' => 'login'
	],

//Admin routes

	'admin/list' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'list'
	],

	'admin/list/{page:\d+}' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'list',
	],

	'admin/detail/{id:\d+}' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'detail'
	],

	'admin/add' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'add'
	],

	'admin/edit/{id:\d+}' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'edit'
	],

	'admin/delete/{id:\d+}' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'delete',
	],

	'admin/logout' => [
		'CONTROLLER' => 'admin',
		'ACTION' => 'logout'
	],
];
?>