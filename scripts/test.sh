#!/bin/bash

yellow_echo () { echo "\033[33m\033[1m$1\033[0m"; }

# clear console
clear

# test code with php code sniffer rules
yellow_echo 'PHPCS: testing...'
php ./vendor/bin/phpcbf
php ./vendor/bin/phpcs

# test code with phpstan analyzer
yellow_echo 'PHPSTAN: testing...'
php ./vendor/bin/phpstan -vvv

# run unit tests
yellow_echo 'PHPUNIT: testing...'
php ./vendor/bin/phpunit

# print info message
yellow_echo 'Project tests completed.'