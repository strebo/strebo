#!/bin/bash
killall nserverstart.sh;
killall serverstart.sh;
nohup ./serverstart.sh &> php_server.out &
nohup ./nserverstart.sh &> node_server.out &
