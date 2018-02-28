<?php
return [
	'title' => 'Permission|Permissions',
	'id' => 'ID',
	'display_name' => 'Display Name',
	'name' => 'Name',
	'description' => 'Description',
	'not_found' => 'The Permission Record not found',
	'no_records' => 'Permissions  not found',
	'create' => 'Create Permission',
	'edit' => 'Edit Permission',
	'allow_user_to' =>'ALLOW A USER TO',
	'types' => [
		'basic' => 'Basic Permission',
		'crud' => 'CRUD Permission',
	],
	'crud' => [
		'c' => 'create|CREATE',
		'r' => 'read|READ',
		'u' => 'read|UPDATE',
		'd' => 'delete|DELETE'
	],
	'placeholders' => [
		'name' => 'enter your permission name here',
		'display_name' => 'enter your display name here',
		'description' => 'enter your permission description here',
		'resource' => 'enter your resource name here',
	],
	'alerts' => [
		'created' => 'Permission Successfully Created',
		'crud_created' => ':count Permissions were Successfully Created',
		'crud_error' => 'Permissions were not Created',
		'updated' => 'Permission Successfully Updated',
		'error' => 'Permission not Created',
		'deleted' => 'Permission has been deleted',
		'reactivated' => 'Permission has been reactivated',
		'deactivated' => 'Permission has been deactivated',
	]
];