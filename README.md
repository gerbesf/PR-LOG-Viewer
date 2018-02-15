# PR LOG Viewer 1.0

[LIVE DEMO](http://45.77.193.220:8080)

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
    'id' => 1, // sequential please
    'name' => 'DIVSUL-BR', // server display name

    // log files
    'path' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // for complete log, after restart
    'active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // for active log, before restart

    // hash files
    'path_hash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt', // for complete log, after restart
    'hash_active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt', // for active log, before restart

    'local_name' => 'divsul_01_main.txt', // local created base filename
];


$config['servers_list'][] = [
    'id' => 2, // sequential please
    'name' => 'NWG', // server display name

    // log files
    'path' => 'http://192.154.108.178:666/logs/ra_adminlog_main.txt', // for complete log, after restart
    'active_log' => 'http://192.154.108.178:666/logs/ra_adminlog.txt', // for active log, before restart

    // hash files
    'path_hash' => 'http://192.154.108.178:666/logs/cdhash_main.txt', // for complete log, after restart
    'hash_active_log' => 'http://192.154.108.178:666/logs/cdhash.txt', // for active log, before restart

    'local_name' => 'n2g_02_main.txt', // local created base filename
];
```

#### Enable / Disable Password
```php
$config['require_login'] = false;
```
#### Display / Hide Full IP
This feature change ip to 999.999.000.000
```php
$config['hide_ips'] = true;
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
