#!/bin/bash
killall nserverstart.sh;
killall serverstart.sh;
composer update;
composer install;
nohup ./serverstart.sh &> php_server.out &
nohup ./nserverstart.sh &> node_server.out &
