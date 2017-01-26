# CSB-Messaging

## Description
This is a simple message board application written for University of Helsinki's course "Cyber Security Base"(cybersecuritybase.github.io). It intentionally contains several security flaws from the OWASP Top 10 2013 list(https://www.owasp.org/index.php/Top 10 2013-Top 10).


## Requirements:
* PHP5.4+
* PDO and PDO-SQlite extension [included in PHP]

PHP installation instructions can be found at http://php.net/manual/en/install.php

## Usage (Unix/Mac/Windows)
1. If PDO-SQLite extension is not enabled, edit your php.ini file (http://php.net/manual/en/configuration.file.php) and uncomment ;extension=pdo_sqlite
2. Clone the repository
3. Run "php -S address:port" (in the directory where you cloned the repository)
4. The application can now be accessed from your browser


## Documentation
* In docs/report.pdf
