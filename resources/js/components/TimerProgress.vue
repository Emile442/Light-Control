<template>
    <div v-bind:id="name" class="circle-progress" data-animation-start-value="">
        <strong>{{ timeStr }}</strong>
    </div>
</template>

<script>
    export default {
        name: "TimerProgress",
        props: ['name', 'start', 'end'],
        data() {
            return {
                timer: null,
                timeStr: '',
                interval: null,
                startDate: null,
                endDate: null,
                percent: 0,
            }
        },
        created() {
            this.startDate = new Date(this.start * 1000);
            this.endDate = new Date(this.end * 1000);
            this.percent = Math.round((100 - (this.endDate -  new Date()) / (this.endDate - this.startDate) * 100));
        },
        mounted() {
            this.timer = $('#' + this.name);
            this.timer.circleProgress({
                value: 1 - (this.percent /100),
                fill: {gradient: ['#0c2646', '#3c99dc']},
                size: 50,
                animationStartValue: 1 - (this.percent /100)
            });
            this.updateStr();
            this.interval = setInterval(this.updateTime, 500)
        },
        methods: {
            updateTime() {
                this.percent = Math.round((100 - (this.endDate -  new Date()) / (this.endDate - this.startDate) * 100));
                if (this.percent >= 100) {
                    this.percent = 100;
                    clearInterval(this.interval);
                }
                this.timer.circleProgress('value', 1 - (this.percent /100));
                this.updateStr();
            },
            updateStr() {
                let diff = this.endDate.getTime() - new Date().getTime();
                let minutes= Math.round((diff % 3600000 ) / 60000);
                let seconds= Math.round((diff % 60000) / 1000);
                if (seconds >= 30)
                    minutes--;
                let minutesText = minutes <= 0 ? '00' : ('0' + minutes).slice(-2);
                let secondsText = seconds <= 0 ? '00' : ('0' + seconds).slice(-2);
                this.timeStr = minutesText + ":" + secondsText;
            }
        }
    }
</script>

<style scoped>

</style>
