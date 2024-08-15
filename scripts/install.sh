#!/bin/bash

yellow_echo () { echo "\033[33m\033[1m$1\033[0m"; }

# install the project dependencies
if [ ! -d 'vendor/' ]
then
    composer install
fi

# print info message
yellow_echo 'Project dependencies installed.'
