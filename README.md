# Ip-info

Ip-info is script to get ip address basic info.

## Usage
Write in CLI
```bash
php ip-info.php 1.1.1.1                 # returns basic ip address info in table format

php ip-info.php 1.1.1.1 C:\myfolder     # saves basic ip address info in json located in C:\myfolder
```

#### To run tests
Write in CLI
```bash
.\vendor\bin\phpunit                    # windows
./vendor/bin/phpunit                    # unix
