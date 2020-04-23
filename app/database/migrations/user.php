<?php

return [
	'id INTEGER PRIMARY KEY AUTOINCREMENT',
	'login VARCHAR UNIQUE',
	'password VARCHAR',
	'token TEXT',
	'admin BOOL',
];
