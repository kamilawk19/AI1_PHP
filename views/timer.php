<?php
/** @var $this \app\core\View */

$this->title = 'Timer';

?>

<h1>Timer</h1>
<form action="" method="post">
    <div id="timer">
        <input type="text" name="task" placeholder="Nad czym pracujesz?"></input>
        <button id="controler" type="button" style="width: 100px; height: 30px;">Start/Stop</button>
        <button id="save" type="submit" disabled="disabled" type="button" style="width: 100px; height: 30px;">Save</button>
        <div id="time" style="background-color: antiquewhite; width: 100px; height: 20px; text-align: center;">00:00:00</div>
        <input id="timeToSend" type="hidden", name="time"/>
    </div>
</form>
<!--<script src="../scripts/timer.js"></script> error -->
<script>
    function buildTimer() {
        /**
         * Self-adjusting interval to account for drifting
         *
         * @param {function} workFunc  Callback containing the work to be done
         *                             for each interval
         * @param {int}      interval  Interval speed (in milliseconds)
         * @param {function} errorFunc (Optional) Callback to run if the drift
         *                             exceeds interval
         */
        function AdjustingInterval(workFunc, interval, errorFunc) {
            var that = this;
            var expected, timeout;
            this.interval = interval;

            this.start = function () {
                expected = Date.now() + this.interval;
                timeout = setTimeout(step, this.interval);
            }

            this.stop = function () {
                clearTimeout(timeout);
            }

            function step() {
                var drift = Date.now() - expected;
                if (drift > that.interval) {
                    if (errorFunc) errorFunc();
                }
                workFunc();
                expected += that.interval;
                timeout = setTimeout(step, Math.max(0, that.interval - drift));
            }
        }
        let hidden = document.querySelector('#timeToSend')
        var doWork = function () {
            sec_num++;
            renderTime();
            hidden.value = divForTime.textContent;
        };

        return new AdjustingInterval(doWork, 1000);
    }

    function renderTime()
    {
        let hours   = Math.floor(sec_num / 3600);
        let minutes = Math.floor((sec_num - (hours * 3600)) / 60);
        let seconds = sec_num - (hours * 3600) - (minutes * 60);

        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
        if (seconds < 10) {seconds = "0"+seconds;}
        divForTime.textContent = hours+':'+minutes+':'+seconds;
    }

    function controleTimer()
    {
        if(timerStatus === -1)
            timerStatus = 1

        if(timerStatus === 0)
        {
            ticker.start();
            timerStatus = 1;
            button_save.disabled = true;
            return;
        }

        else if(timerStatus === 1)
        {
            ticker.stop();
            timerStatus = 0;
            button_save.disabled = false;
            return;
        }
    }

    let sec_num = -1;
    let ticker = buildTimer();
    let timerStatus = 0; // 0 stopped/not started, 1 running
    let button_controler = document.querySelector('#controler');
    let button_save = document.querySelector('#save');
    button_controler.addEventListener("click", controleTimer, false);
    let divForTime = document.querySelector('#time');

</script>
