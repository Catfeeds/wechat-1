#!/bin/bash
#ps -fe|grep 'php think queue:work --queue emailJobQueue --daemon'
PATH=/bin:/sbin:/usr/bin:/usr/sbin:/usr/local/bin:/usr/local/sbin:~/bin
export PATH
count=`ps -ef | grep emailJobQueue | grep -v "grep" | wc -l`
if [ $count ==  0 ]
then
	echo "start process....."
         /var/www/html/tp5/queue.sh
	#nohup php think queue:work --queue emailJobQueue --daemon >/dev/null 2>&1
else
	echo "runing....."
fi