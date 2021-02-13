<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <script type="text/javascript">
        var seconds = <?php
                            //using this script i will be taking in the time from a session variable calle time leave it as it is for now
                            $minutesTime=1;
                            $dbSessionDurationTime = $minutesTime*60;
                            echo $dbSessionDurationTime;
                        ?>;
        //echo statements are allowed in javascript devansh!! yipeeee


        function displaytimer(){
            var hours = Math.floor(seconds/3600),
                mins = Math.floor(seconds%3600/60),
                secs = Math.floor((seconds % 60));
                tempsecs=secs;
                if(secs==0&&hours==0&&mins==0)
                {
                    //go to other page "test completion"
                    window.location.href="testt.php";
                }
                if(secs<10)
                {
                    tempsecs="0"+secs;
                }
                if(hours<10)
                {
                    hours="0"+hours;
                }
                if(mins<10)
                {
                    mins="0"+mins;
                }
                

                //Here, the DOM that the timer will appear using jQuery
                document.getElementById("count").innerHTML=hours+':'+mins+':'+tempsecs;  
        }

        setInterval(function(){
            seconds -= 1;
            displaytimer();
        }, 1000);

    </script>
</head>
<body onload="displaytimer()">
        <div id="count"></div>
</body>
</html>
