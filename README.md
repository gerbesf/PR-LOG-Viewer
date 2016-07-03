# PR-Logviwer
The tool you can se the log by ONLY one CLICK!

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
        'name' => 'SERVER 01',
        'path' => 'http://domain.com/ra_adminlog.txt'
    ];
```

#### Passwors with MD5
When you configure the 'password' with MD5, need to be encrypted and configure on the 'password' line.
```php
$config['with_md5']=false;
$config['auth'] = [
    0 => [
        'id' => 1,
        'username' => 'admin',
        'password' => '21232f297a57a5a743894a0e4a801fc3',
        'name'=>'Administrator'
    ]
];
```


### Colaborators
- Jeferson Costa
- Renan Costa (xlShogunlx)
- Danesh_italiano
- Ferreira