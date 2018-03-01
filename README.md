# PR LOG Viewer 1.1
 
[LIVE DEMO](http://logs.divsul.com/adminpanel)
 
## How to Configure (config.php)
 
#### Set Date/Time format
Configure the date/time format.
```php
$config['date_format']="Y-m-d";
$config['hour_format']="H:i:s";
```
 
#### Set your log file server
You need to host the ra_adminlog.txt on your PR Server and configure the link on 'path'.
```php
$config['servers_list'][] = [
    'id' => 1, // sequential please
    'name' => 'DIVSUL-BR', // server display name
 
    // log files
    'active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // filelog 1
    'path' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // filelog 2
 
    // It is possible read a local file on windows. Example:
    // 'path' => 'c:/server_log/ra_adminlog_main.txt',
 
    // It is possible read a local file on linux. Example:
    // 'path' => '/var/logs/pr/ra_adminlog_main.txt',
 
    // hash files
    'hash_active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt', // filelog 1
    'path_hash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt', // filelog 2
 
    'local_name' => 'divsul_br.txt', // file name for this server
];
 
 
$config['servers_list'][] = [
    'id' => 2, // keep the sequential order
    'name' => 'DIVSUL USA', // server name
 
    // log files
    'active_log' => 'http://miaserver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // filelog 1
    'path' => 'http://miaserver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // filelog 2
   
    // hash files
    'hash_active_log' => 'http://miaserver.divsul.com:666/PRServer/logs/cdhash.txt', // filelog 1
    'path_hash' => 'http://miaserver.divsul.com:666/PRServer/logs/cdhash_main.txt', // filelog 2
   
    'local_name' => 'divsul_usa.txt', // file name for this server
];
```
 
#### Enable / Disable Password
```php
$config['require_login'] = false;
```
#### Display / Hide the last two blocks from the IP
This feature change ip from 201.201.201.201 to 201.201.000.000
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
        'name'=>'Admin'
    ]
];
```
 
 
#### Page Settings
```php
 
// width of page
$config['full_width'] = false;
 
// height of modal
$config['modal_height'] = '700px';
 
```
 
Permissions Note:
Need write permission on the folder public/logs
 
### Maintainers
- Ferreira
- Danesh_italiano
 
### Initializers
- Jeferson Costa
- Renan Costa (xlShogunlx)