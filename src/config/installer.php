<?php

use Illuminate\Validation\Rule;

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '7.0.0'
    ],
    'final' => [
        'key' => true,
        'publish' => false
    ],    
    'requirements' => [
        'php' => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/framework/'     => '775',
        'storage/logs/'          => '775',
        'bootstrap/cache/'       => '775'
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Form Wizard
    |--------------------------------------------------------------------------
    |
    | These are the configurable options for the Laravel environment.
    | 
    | Available control types:
    |  * buttons
    |  * button
    |  * password
    |  * radio
    |  * radios
    |  * select
    |  * step
    |  * tab
    |  * text
    |
    | For validation rules see:
    | https://laravel.com/docs/5.7/validation#available-validation-rules
    |
    */
    'environment' => [
		'environment' => [
			'label' => 'installer_messages.environment.wizard.tabs.environment',
			'icon' => 'fa fa-cog fa-2x fa-fw',
			'type' => 'step',
			'controls' => [
				'app_name' => [
					'envName' => 'APP_NAME',
					'type' => 'text',
					'label' => 'installer_messages.environment.wizard.form.app_name_label',
					'placeholder' => 'installer_messages.environment.wizard.form.app_name_placeholder',
					'rules' => 'required|string|max:50'
				], 
				'environment' => [
					'envName' => 'APP_ENV',
					'type' => 'select',
					'label' => 'installer_messages.environment.wizard.form.app_environment_label',
					'options' => [
						'local' => 'installer_messages.environment.wizard.form.app_environment_label_local',
						'development' => 'installer_messages.environment.wizard.form.app_environment_label_developement',
						'qa' => 'installer_messages.environment.wizard.form.app_environment_label_qa',
						'production' => 'installer_messages.environment.wizard.form.app_environment_label_production',
						'other' => 'installer_messages.environment.wizard.form.app_environment_label_other',
					],
					'rules' => 'required|string|max:50',
					'extras' => [
						'select' => [
							'onchange' => 'checkEnvironment(this.value);'
						]
					]
				],
				'app_key' => [
					'envName' => 'APP_KEY',
					'type' => 'app_key',
					'label' => 'installer_messages.environment.wizard.form.app_key_label',
					'rules' => 'required|string|max:50'
				], 
				'app_debug' => [
					'envName' => 'APP_DEBUG',
					'type' => 'radios',
					'label' => 'installer_messages.environment.wizard.form.app_debug_label',
					'value' => 'app_debug_true',
					'controls' => [
						'app_debug_true' => [
							'label' => 'installer_messages.environment.wizard.form.app_debug_label_true',
							'value' => true
						],
						'app_debug_false' => [
							'label' => 'installer_messages.environment.wizard.form.app_debug_label_false',
							'value' => false
						]
					],
					'rules' => 'required|in:true,false'
				],
				'app_log_level' => [
					'envName' => 'APP_LOG_LEVEL',
					'type' => 'select',
					'label' => 'installer_messages.environment.wizard.form.app_log_level_label',
					'value' => 'debug',
					'options' => [
						'debug' => 'installer_messages.environment.wizard.form.app_log_level_label_debug',
						'info' => 'installer_messages.environment.wizard.form.app_log_level_label_info',
						'notice' => 'installer_messages.environment.wizard.form.app_log_level_label_notice',
						'warning' => 'installer_messages.environment.wizard.form.app_log_level_label_warning',
						'error' => 'installer_messages.environment.wizard.form.app_log_level_label_error',
						'critical' => 'installer_messages.environment.wizard.form.app_log_level_label_critical',
						'alert' => 'installer_messages.environment.wizard.form.app_log_level_label_alert',
						'emergency' => 'installer_messages.environment.wizard.form.app_log_level_label_emergency',
					],
					'rules' => 'required|string|max:50'
				],
				'app_url' => [
					'envName' => 'APP_URL',
					'type' => 'text',
					'label' => 'installer_messages.environment.wizard.form.app_url_label',
					'value' => 'http://localhost',
					'placeholder' => 'installer_messages.environment.wizard.form.app_url_placeholder',
					'extras' => [
						'input' => [
							'type' => 'url'
						]
					],
					'rules' => 'required|url'
				],
				'app_buttons' => [
					'type' => 'buttons',
					'controls' => [
						'setup_database' => [
							'type' => 'button',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.buttons.setup_database',
								'icon' => 'fa fa-angle-right fa-fw'
							],
							'extras' => [
								'button' => [
									'onclick' => 'showDatabaseSettings();return false'
								]
							]
						]
					]
				]
			],
		],
		'database' => [
			'label' => 'installer_messages.environment.wizard.tabs.database',
			'icon' => 'fa fa-database fa-2x fa-fw',
			'type' => 'step',
			'controls' => [
				'database_connection' => [
					'envName' => 'DB_CONNECTION',
					'type' => 'select',
					'label' => 'installer_messages.environment.wizard.form.db_connection_label',
					'value' => 'mysql',
					'options' => [
						'mysql' => 'installer_messages.environment.wizard.form.db_connection_label_mysql',
						'sqlite' => 'installer_messages.environment.wizard.form.db_connection_label_sqlite',
						'pgsql' => 'installer_messages.environment.wizard.form.db_connection_label_pgsql',
						'sqlsrv' => 'installer_messages.environment.wizard.form.db_connection_label_sqlsrv'
					],
					'rules' => 'required|string|max:50',
					'extras' => [
						'select' => [
							'onchange' => 'checkDbConnection(this.value);'
						]
					]
				],
				'database_hostname' => [
					'envName' => 'DB_HOST',
					'type' => 'text',
					'label' => 'installer_messages.environment.wizard.form.db_host_label',
					'value' => '127.0.0.1',
					'placeholder' => 'installer_messages.environment.wizard.form.db_host_placeholder',
					'rules' => 'required|string|max:50'
				],
				'database_port' => [
					'envName' => 'DB_PORT',
					'type' => 'text',
					'label' => 'installer_messages.environment.wizard.form.db_port_label',
					'value' => '3306',
					'placeholder' => 'installer_messages.environment.wizard.form.db_port_placeholder',
					'extras' => [
						'input' => [
							'type' => 'number'
						]
					],
					'rules' => 'required|numeric'
				],
				'database_name' => [
					'envName' => 'DB_DATABASE',
					'type' => 'text',
					'label' => 'installer_messages.environment.wizard.form.db_name_label',
					'placeholder' => 'installer_messages.environment.wizard.form.db_name_placeholder',
					'rules' => 'required|string|max:50'
				],
				'database_username' => [
					'envName' => 'DB_USERNAME',
					'type' => 'text',
					'label' => 'installer_messages.environment.wizard.form.db_username_label',
					'placeholder' => 'installer_messages.environment.wizard.form.db_username_placeholder',
					'rules' => 'required|string|max:50'
				],
				'database_password' => [
					'envName' => 'DB_PASSWORD',
					'type' => 'password',
					'label' => 'installer_messages.environment.wizard.form.db_password_label',
					'placeholder' => 'installer_messages.environment.wizard.form.db_password_placeholder',
					'rules' => 'required|string|max:50'
				],
				'db_buttons' => [
					'type' => 'buttons',
					'controls' => [
						'setup_application' => [
							'type' => 'button',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.buttons.setup_application',
								'icon' => 'fa fa-angle-right fa-fw'
							],
							'extras' => [
								'button' => [
									'onclick' => 'showApplicationSettings();return false'
								]
							]
						]
					]
				]
			],
			
		],

		'app_settings' => [
			'label' => 'installer_messages.environment.wizard.tabs.application',
			'icon' => 'fa fa-cogs fa-2x fa-fw',
			'type' => 'step',
			'controls' => [
				'drivers' => [
					'type' => 'tab',
					'label' => 'installer_messages.environment.wizard.form.app_tabs.broadcasting_title',
					'controls' => [
						'broadcast_driver' => [
							'envName' => 'BROADCAST_DRIVER',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.broadcasting_label',
								'link' => [
									'href' => 'https://laravel.com/docs/5.4/broadcasting',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'value' => 'log',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.broadcasting_placeholder',
							'rules' => 'required|string|max:50'
						],
						'cache_driver' => [
							'envName' => 'CACHE_DRIVER',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.cache_label',
								'link' => [
									'href' => 'https://laravel.com/docs/5.4/cache',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'value' => 'file',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.cache_placeholder',
							'rules' => 'required|string|max:50'
						],
						'session_driver' => [
							'envName' => 'SESSION_DRIVER',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.session_label',
								'link' => [
									'href' => 'https://laravel.com/docs/5.4/session',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'value' => 'file',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.session_placeholder',
							'rules' => 'required|string|max:50'
						],
						'queue_driver' => [
							'envName' => 'QUEUE_DRIVER',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.queue_label',
								'link' => [
									'href' => 'https://laravel.com/docs/5.4/queues',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'value' => 'sync',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.queue_placeholder',
							'rules' => 'required|string|max:50'
						],
					]
				],
				'redis' => [
					'type' => 'tab',
					'label' => 'installer_messages.environment.wizard.form.app_tabs.redis_label',
					'controls' => [
						'redis_hostname' => [
							'envName' => 'REDIS_HOST',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.redis_host',
								'link' => [
									'href' => 'https://laravel.com/docs/5.4/redis',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'value' => '127.0.0.1',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.redis_host',
							'rules' => 'required|string|max:50'
						],
						'redis_password' => [
							'envName' => 'REDIS_PASSWORD',
							'type' => 'password',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.redis_password',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.redis_password',
							'rules' => 'required|string|max:50'
						],
						'redis_port' => [
							'envName' => 'REDIS_PORT',
							'type' => 'text',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.redis_port',
							'value' => '6379',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.redis_port',
							'rules' => 'required|numeric',
							'extras' => [
								'input' => [
									'type' => 'number'
								]
							]
						]
					]
				],
				'mail' => [
					'type' => 'tab',
					'label' => 'installer_messages.environment.wizard.form.app_tabs.mail_label',
					'controls' => [
						'mail_driver' => [
							'envName' => 'MAIL_DRIVER',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.mail_driver_label',
								'link' => [
									'href' => 'https://laravel.com/docs/5.4/mail',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'value' => 'smtp',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder',
							'rules' => 'required|string|max:50'
						],
						'mail_host' => [
							'envName' => 'MAIL_HOST',
							'type' => 'text',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.mail_host_label',
							'value' => 'smtp.mailtrap.io',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder',
							'rules' => 'required|string|max:50'
						],
						'mail_port' => [
							'envName' => 'MAIL_PORT',
							'type' => 'text',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.mail_port_label',
							'value' => '2525',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder',
							'rules' => 'required|numeric',
							'extras' => [
								'input' => [
									'type' => 'number'
								]
							]
						],
						'mail_username' => [
							'envName' => 'MAIL_USERNAME',
							'type' => 'text',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.mail_username_label',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder',
							'rules' => 'required|string|max:50'
						],
						'mail_password' => [
							'envName' => 'MAIL_PASSWORD',
							'type' => 'password',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.mail_password_label',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder',
							'rules' => 'required|string|max:50'
						],
						'mail_encryption' => [
							'envName' => 'MAIL_ENCRYPTION',
							'type' => 'text',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.mail_encryption_label',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder',
							'rules' => 'required|string|max:50'
						],
					]
				],
				'pusher' => [
					'type' => 'tab',
					'label' => 'installer_messages.environment.wizard.form.app_tabs.pusher_label',
					'controls' => [
						'pusher_app_id' => [
							'envName' => 'PUSHER_APP_ID',
							'type' => 'text',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.app_tabs.pusher_app_id_label',
								'link' => [
									'href' => 'https://pusher.com/docs/server_api_guide',
									'icon' => 'fa fa-info-circle fa-fw',
									'title' => 'installer_messages.environment.wizard.form.app_tabs.more_info'
								]
							],
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.pusher_app_id_palceholder',
							'rules' => 'max:50'
						],
						'pusher_app_key' => [
							'envName' => 'PUSHER_APP_KEY',
							'type' => 'text',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.pusher_app_key_label',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.pusher_app_key_palceholder',
							'rules' => 'max:50'
						],
						'pusher_app_secret' => [
							'envName' => 'PUSHER_APP_SECRET',
							'type' => 'password',
							'label' => 'installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_label',
							'placeholder' => 'installer_messages.environment.wizard.form.app_tabs.pusher_app_secret_palceholder',
							'rules' => 'max:50'
						]
					]
				],
				'app_buttons' => [
					'type' => 'buttons',
					'controls' => [
						'submit' => [
							'type' => 'button',
							'label' => [
								'text' => 'installer_messages.environment.wizard.form.buttons.install',
								'icon' => 'fa fa-angle-right fa-fw'
							],
							'extras' => [
								'button' => [
									'type' => 'submit'
								]
							]
						]
					]
				]
			]
		]
    ],

    /*
    |--------------------------------------------------------------------------
    | Installed Middlware Options
    |--------------------------------------------------------------------------
    | Different available status switch configuration for the
    | canInstall middleware located in `canInstall.php`.
    |
    */
    'installed' => [
        'redirectOptions' => [
            'route' => [
                'name' => 'welcome',
                'data' => [],
            ],
            'abort' => [
                'type' => '404',
            ],
            'dump' => [
                'data' => 'Dumping a not found message.',
            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Selected Installed Middlware Option
    |--------------------------------------------------------------------------
    | The selected option fo what happens when an installer intance has been
    | Default output is to `/resources/views/error/404.blade.php` if none.
    | The available middleware options include:
    | route, abort, dump, 404, default, ''
    |
    */
    'installedAlreadyAction' => '',

    /*
    |--------------------------------------------------------------------------
    | Updater Enabled
    |--------------------------------------------------------------------------
    | Can the application run the '/update' route with the migrations.
    | The default option is set to False if none is present.
    | Boolean value
    |
    */
    'updaterEnabled' => 'true',

];
