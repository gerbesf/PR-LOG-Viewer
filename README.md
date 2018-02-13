# PR-Logviwer
The tool you can se the log by ONLY one CLICK! (actually with three clicks)


| View Command Log  | View Hash Players Log |
| ------------- | ------------- |
| ![alt text](http://i.imgur.com/nel5cdF.png)  | ![alt text](http://i.imgur.com/vPLjMTP.png)  |



## How to Configure (config.php)

#### Set Date/Time
Configure the date/time format.
```php
$config['date_format']="Y-m-d";
$config['hour_format']="H:i:s";
```

#### Set your log server
You need to host the ra_adminlog.txt on your PR Server and configure the link on 'path'.
```php
$config['servers_list'][] = [
        'id' => 1,
        'name' => 'DIVSUL - BR',

        // log files
        'path' => 'http://logs.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // for complete log, after restart
        'active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // for active log, before restart

        // hash files
        'path_hash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt', // for complete log, after restart
        'hash_active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt', // for active log, before restart

        'local_name' => 'divsul_01_main.txt',
    ];
```

#### Enable / Disable Password
```php
/* ---------- AUTH ---------- */
$config['require_login'] = false;
```


#### Passwors with MD5
When you configure the 'password' with MD5, need to be encrypted and configure on the 'password' line.
```php
$config['with_md5']=true;
$config['auth'] = [
    0 => [
        'id' => 1,
        'username' => 'admin',
        'password' => '21232f297a57a5a743894a0e4a801fc3',
        'name'=>'Administrator'
    ]
];
```


### Maintainers
- Ferreira
- Danesh_italiano

### Initializers
- Jeferson Costa
- Renan Costa (xlShogunlx)