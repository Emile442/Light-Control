$(document).ready(function() {
    $('.timer').each(function(index, value) {
        let timer = $(this);

        let start = new Date(timer.attr("data-start") * 1000)
        let end = new Date(timer.attr("data-end") * 1000)
        let percent = Math.round((100 - (end -  new Date()) / (end - start) * 100));

        let diff = end.getTime() - new Date().getTime()
        let minutes= Math.round((diff % 3600000 ) / 60000);
        let secondes= Math.round((diff % 60000) / 1000);

        timer.attr("data-animation-start-value", 1 - (percent /100))

        let timerBar = timer.circleProgress({
            value: 1 - (percent /100),
            fill: {gradient: ['#0681c4', '#4ac5f8']},
            size: 50
        }).on('circle-animation-progress', function(event, progress, stepValue) {
            diff = end.getTime() - new Date().getTime()
            minutes= Math.round((diff % 3600000 ) / 60000);
            secondes= Math.round((diff % 60000) / 1000);
            if (secondes >= 30)
                minutes--;
            let minutesText = minutes <= 0 ? '00' : ('0' + minutes).slice(-2)
            let secondesText = secondes <= 0 ? '00' : ('0' + secondes).slice(-2)

            $(this).find('strong').text( minutesText + ":" + secondesText);
            // $(this).find('strong').text(100 - percent);
        });

        let update = setInterval(function(){
            percent = Math.round((100 - (end - new Date()) / (end - start) * 100));
            if (percent >= 100) {
                percent = 100;
                clearInterval(update)
            }
            timerBar.circleProgress('value', 1 - (percent /100));
        }, 500);

    });
});
