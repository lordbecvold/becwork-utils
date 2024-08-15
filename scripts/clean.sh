#!/bin/bash

yellow_echo () { echo "\033[33m\033[1m$1\033[0m"; }

# cleans up the project
rm -rf ./vendor
rm -rf ./composer.lock

# print info message
yellow_echo 'Project clean is completed.'
