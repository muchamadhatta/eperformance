<?php

return [

    /*
     |--------------------------------------------------------------------------
     | Debugbar Settings
     |--------------------------------------------------------------------------
     |
     | Debugbar is enabled by default, when debug is set to true in app.php.
     | You can override the value by setting enable to true or false instead of null.
     |
     */

    'enabled' => env('DEBUGBAR_ENABLED', null),
    'except' => [
        'telescope*',
        'horizon*',
    ],

    /*
     |--------------------------------------------------------------------------
     | Storage settings
     |--------------------------------------------------------------------------
     |
     | DebugBar stores data for session/ajax Requests.
     | You can disable this, so the debugbar stores data in headers/session,
     | but this can cause problems with large data collectors.
     | By default, file storage (in the storage folder) is used. Redis and PDO
     | can also be used. For PDO, run the package migrations first.
     |
     */
    'storage' => [
        'enabled'    => true,
        'driver'     => 'file', // redis, file, pdo, socket, custom
        'path'       => storage_path('debugbar'), // For file driver
        'connection' => null,   // Leave null for default connection (Redis/PDO)
        'provider'   => '', // Instance of StorageInterface for custom driver
        'hostname'   => '127.0.0.1', // Hostname to use with the "socket" driver
        'port'       => 2304, // Port to use with the "socket" driver
    ],

    /*
     |--------------------------------------------------------------------------
     | Editor
     |--------------------------------------------------------------------------
     |
     | Choose your preferred editor to use when clicking file name.
     |
     | Supported: "phpstorm", "vscode", "vscode-insiders", "vscode-remote",
     |            "vscode-insiders-remote", "vscodium", "textmate", "emacs",
     |            "sublime", "atom", "nova", "macvim", "idea", "netbeans",
     |            "xdebug"
     |
     */

    'editor' => env('DEBUGBAR_EDITOR', 'phpstorm'),

    /*
     |--------------------------------------------------------------------------
     | Remote Path Mapping
     |--------------------------------------------------------------------------
     |
     | If you are using a remote dev server, like Laravel Homestead, Docker, or
     | even a remote VPS, it will be necessary to specify your path mapping.
     |
     | Leaving one, or both of these, empty or null will not trigger the remote
     | feature. "remote_sites_path" is an absolute base path for your sites or
     | projects in Homestead, Vagrant, Docker, etc.
     |
     | Example:
     |
     | remote_sites_path => '/home/vagrant/Code'
     | local_sites_path => 'C:\Users\Username\hvroot'
     |
     */

    'remote_sites_path' => env('DEBUGBAR_REMOTE_SITES_PATH', ''),
    'local_sites_path' => env('DEBUGBAR_LOCAL_SITES_PATH', ''),

    /*
     |--------------------------------------------------------------------------
     | Vendors
     |--------------------------------------------------------------------------
     |
     | Vendor files are included by default, but can be set to false.
     | This can also be set to 'uncompiled', to only vendor files with
     | a max of 1 character.
     |
     */

    'include_vendors' => true,

    /*
     |--------------------------------------------------------------------------
     | Capture Queries
     |--------------------------------------------------------------------------
     |
     | Whether to capture database queries or not.
     |
     */

    'capture_queries' => true,

    /*
     |--------------------------------------------------------------------------
     | Capture Views
     |--------------------------------------------------------------------------
     |
     | Whether to add views to the data or not.
     | This can slow down the application, so can be disabled if not needed.
     |
     */

    'capture_views' => true,

    /*
     |--------------------------------------------------------------------------
     | Capture Console
     |--------------------------------------------------------------------------
     |
     | Whether to add console messages to the views.
     |
     */

    'capture_console' => true,

    /*
     |--------------------------------------------------------------------------
     | Capture Mail
     |--------------------------------------------------------------------------
     |
     | Whether to capture mail messages.
     |
     */

    'capture_mail' => true,

    /*
     |--------------------------------------------------------------------------
     | Capture Gate
     |--------------------------------------------------------------------------
     |
     | Whether to capture gate checks.
     |
     */

    'capture_gate' => true,

    /*
     |--------------------------------------------------------------------------
     | File recorder (deprecated)
     |--------------------------------------------------------------------------
     |
     | DEPRECATED: Use 'storage' option instead
     |
     */
    'file_recorder' => false,

    /*
     |--------------------------------------------------------------------------
     | Collectors
     |--------------------------------------------------------------------------
     |
     | List of collectors
     |
     */
    'collectors' => [
        'phpinfo'         => true,  // Php version
        'messages'        => true,  // Messages
        'time'            => true,  // Time Datalogger
        'memory'          => true,  // Memory usage
        'exceptions'      => true,  // Exception displayer
        'log'             => true,  // Logs from Monolog (merged in messages if enabled)
        'db'              => true,  // Show database (PDO) queries and bindings
        'views'           => true,  // Views with their data
        'route'           => true,  // Current route information
        'auth'            => false, // Display Laravel authentication status
        'gate'            => true,  // Display Laravel Gate checks
        'session'         => true,  // Display session data
        'symfony_request' => true,  // Only one can be enabled..
        'mail'            => true,  // Catch mail messages
        'laravel'         => false, // Laravel version and environment
        'events'          => false, // All events fired
        'default_request' => false, // Regular or special Symfony request logger
        'logs'            => false, // Add the latest log messages
        'files'           => false, // Show the included files
        'config'          => false, // Display config settings
        'cache'           => false, // Display cache events
    ],

    /*
     |--------------------------------------------------------------------------
     | Extra options
     |--------------------------------------------------------------------------
     |
     | Configure some DataCollectors
     |
     */

    'options' => [
        'auth' => [
            'show_name' => true,   // Also show the users name/email in the debugbar
        ],
        'db' => [
            'with_params'       => true,   // Render SQL with the parameters substituted
            'backtrace'         => true,   // Use a backtrace to find the origin of the query in your files.
            'backtrace_exclude_paths' => [],   // Paths to exclude from backtrace. (in addition to defaults)
            'timeline'          => false,  // Add the queries to the timeline
            'explain' => [                 // Show EXPLAIN output on queries
                'enabled' => false,
                'types' => ['SELECT'],     // Deprecated setting, is always only SELECT
            ],
            'hints'             => false,    // Show hints for common mistakes
            'show_copy'         => false,    // Show copy button next to the query
            'slow_threshold'    => false,   // Only show queries slower than this time. (in milliseconds)
        ],
        'mail' => [
            'full_log' => false
        ],
        'views' => [
            'timeline' => false,              // Add the views to the timeline
            'data' => false,    //Note: Can slow down the application, because the data can be quite large..
        ],
        'route' => [
            'label' => true  // show complete route on bar
        ],
        'logs' => [
            'file' => null
        ],
        'cache' => [
            'values' => true // collect cache values
        ],
    ],

    /*
     |--------------------------------------------------------------------------
     | Inject Debugbar in Response
     |--------------------------------------------------------------------------
     |
     | Usually, the debugbar is added just before </body>, by listening to the
     | Response after the App is done. If you disable this, you have to add them
     | in your template yourself. See http://phpdebugbar.com/docs/rendering.html
     |
     */

    'inject' => true,

    /*
     |--------------------------------------------------------------------------
     | DebugBar route prefix
     |--------------------------------------------------------------------------
     |
     | Sometimes you want to set route prefix to be used by DebugBar to load
     | its resources from. Usually the need comes from misconfigured web server or
     | from trying to overcome bugs like this: http://trac.nginx.org/nginx/ticket/97
     |
     */
    'route_prefix' => '_debugbar',

    /*
     |--------------------------------------------------------------------------
     | DebugBar route domain
     |--------------------------------------------------------------------------
     |
     | By default DebugBar route served from the same domain that request served.
     | To override default domain, specify it as a non-empty value.
     */
    'route_domain' => null,

    /*
     |--------------------------------------------------------------------------
     | DebugBar theme
     |--------------------------------------------------------------------------
     |
     | Switches between light and dark themes. If set to auto it will respect system preferences
     | Possible values: auto, light, dark
     */
    'theme' => env('DEBUGBAR_THEME', 'auto'),

    /*
     |--------------------------------------------------------------------------
     | Backtrace stack limit
     |--------------------------------------------------------------------------
     |
     | By default, the DebugBar limits the number of frames returned by the 'debug_backtrace()' function.
     | If you need larger stacktraces, you can increase this number. Setting it to 0 will result in no limit.
     */
    'debug_backtrace_limit' => 50,

];