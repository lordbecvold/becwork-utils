#!/bin/bash

# install the project dependencies
if [ ! -d 'vendor/' ]
then
    composer install
fi
