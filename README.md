# PR LOG Viewer 1.3.2
 
## How to Configure (config.php)
 
#### Set Date/Time format
Configure the date/time format.
```php
$config['date_format']="Y-m-d";
$config['hour_format']="H:i:s";
```
Configure expiration.
```php
// Expiration time examples: 4 hours, 20 hours, 10 seconds
$config['expiration_time'] = '30 minutes';
```
 
#### Set your log file server
You need to host the ra_adminlog.txt and cd_hash.log or have internally access to configure the link/folder on 'path'.

Local file example for windows:
'path' => 'c:/prserver/logs/ra_admin_or_cdhash.txt',
 
Local file example for linux:
'path' => '/home/prserver/logs/ra_admin_or_cdhash.txt',
```php
/* --------- SERVERS --------- */
$config['servers_list'][] = [
    'id' => 1, // keep the sequential order
    'name' => 'DIVSUL BRA', // server name

    // log files
    'active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog.txt', // filelog 1
    'path' => 'http://sposerver.divsul.com:666/PRServer/logs/ra_adminlog_main.txt', // filelog 2

    // hash files
    'hash_active_log' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash.txt', // filelog 1
    'path_hash' => 'http://sposerver.divsul.com:666/PRServer/logs/cdhash_main.txt', // filelog 2

    'local_name' => 'divsul_bra.txt', // file name for this server
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
 
#### Enable/Disable Login access to view the logs
```php
$config['require_login'] = false;
```
#### Display/Hide the last two blocks from the IP
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
 
*** IMPORTANT NOTE ***
Need write permissions on the folder public/logs
 
### Maintainers
- Ferreira
- Danesh_italiano
 
### Initializers
- Jeferson Costa
- Renan Costa (xlShogunlx)
