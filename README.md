UnBlocker Service
=============================

![Workflow Build Status](https://github.com/fractalzombie/unblocker-service/actions/workflows/build.yml/badge.svg?event=push)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=bugs)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Lines of Code](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=ncloc)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=fractalzombie_unblocker-service&metric=coverage)](https://sonarcloud.io/summary/new_code?id=fractalzombie_unblocker-service)

The `UnBlocker Service` allows you get update of rules for your router to unblock it via VPN or other ISP

Installation
------------
The recommended way to install is through Composer:

```
composer install
```

It requires PHP version 8.2 and higher.

Usage of `UnBlocker Service`

Example of .env file
```
###> mikrotik ###
MIKROTIK_ADDRESS=192.168.88.1
MIKROTIK_PORT=8728
MIKROTIK_USER=admin
MIKROTIK_PASSWORD=secret
MIKROTIK_LEGACY_MODE=false
###> mikrotik ###

###> router ###
ROUTER_TYPE=mikrotik
###< router ###

###> external-subnet-provider ###
PROVIDER_LIST='[{"url": "https://uablacklist.net/subnets.txt", "country": "RUSSIA"},{"url": "https://www.iwik.org/ipcountry/RU.cidr", "country": "RUSSIA"}]'
###< external-subnet-provider ###

###> symfony/telegram-notifier ###
TELEGRAM_DSN="telegram://api:key@default?channel=12345678"
###< symfony/telegram-notifier ###
```

```
make start
```

Resources
---------
* [License](https://github.com/fractalzombie/unblocker-service/blob/main/LICENSE.md)
