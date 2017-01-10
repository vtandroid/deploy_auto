### BEGIN INIT INFO
# Provides:          StreamCast
# Required-Start:    $local_fs $remote_fs $network $syslog
# Required-Stop:     $local_fs $remote_fs $network $syslog
# Default-Start:     2 3 4 5
# Default-Stop:      0 1 6
# X-Interactive:     true
# Short-Description: Start/stop StreamCast server
### END INIT INFO
case $1 in
    start)
        echo "Starting Kettle ...";
        if [ ! -f pid ]
		then
			rm -rf x.out y.out;
            nohup java -jar KettleClient-1.0-jar-with-dependencies.jar 2>> x.out >> y.out &
			echo $! > pid;
            echo "Kettle started ...";
        else
            PID=$(cat pid);
            if ps -p $PID > /dev/null
            then 
                echo "Kettle is already running ...";
            else
                echo "Inactive";
                nohup java -jar KettleClient-1.0-jar-with-dependencies.jar 2>> x.out >> y.out &
                echo $! > pid;
            fi
        fi
    ;;
    stop)
        if [ -f pid ]; then
            PID=$(cat pid);
            echo "Stopping Kettle ..."
            kill $PID;
            echo "Kettle stopped ..."
            rm pid;
        else
            echo "Kettle is not running ..."
        fi
    ;;
    restart)
        if [ -f pid ]; then
            PID=$(cat pid);
            echo "Stopping Kettle ...";
            kill $PID;
            echo "Kettle stopped ...";
            rm pid;
		fi;
		rm -rf x.out y.out;
		echo "Starting Kettle ...";
		nohup java -jar KettleClient-1.0-jar-with-dependencies.jar 2>> x.out >> y.out &
		echo $! > pid
		echo "Kettle started ...";
    ;;
	clear_log)
		rm -rf x.out y.out;
		echo "Clear Log Done ...";
    ;;
esac
