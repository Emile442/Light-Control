<template>
    <div>
        <div class="row" v-for="(group, index) in groups">
            <div class="col-md-4 my-auto">
            <span class="guest__timer pull-left text-uppercase">{{ group.name }}</span>
            </div>
            <div class="col-md-4">
                <div v-for="timer in group.timers">
                    <timer-progress :name="timer.job.id" :start="timer.job.created_t" :end="timer.job.available_at"></timer-progress>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-warning btn-lg" type="submit" :dusk="'on-light-' + group.id" :disabled="!group.canSwitch" @click="switchButton(group)">
                    <i v-if="loader || group.loader" class="fas fa-spinner fa-spin"></i>
                    <span v-else>Allumer</span>
                </button>
            </div>
            <hr v-if="index !== groups.length - 1">
        </div>
        <div class="alert alert-warning" v-if="!groups.length && !loader">
            Aucun groupe n'est publique.
        </div>
    </div>
</template>

<script>
    export default {
        name: "StudentTable",
        data() {
            return {
                loader: true,
                groups: [],
                interval: null,
            }
        },
        mounted () {
            this.init();
            this.interval = setInterval(this.refresh, 10000)
        },
        methods: {
            init () {
                this.loader = true;
                this.refresh()
            },
            refresh() {
                axios.get('/api/v1/guest/groups').then(response => {
                    this.groups = response.data;
                    this.groups.forEach(group => {
                        this.$set(group, 'loader', false);
                    });
                    this.loader = false;
                }).catch(error => {
                    clearInterval(this.interval);
                })
            },
            switchButton(group) {
                group.loader = true;
                group.canSwitch = false;
                axios.get(`/api/v1/guest/groups/${group.id}/switch`).then(response => {
                    group.timers = response.data.group.timers;
                }).catch(error => {
                    group.canSwitch = true;
                    error.response.data.errors.forEach(item => {
                        new Noty({
                            type: 'error',
                            theme: 'mint',
                            layout: 'topRight',
                            text: item,
                            closeWith: ['click', 'button'],
                            timeout: 3000
                        }).show();
                    })
                }).then(() => {
                    group.loader = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>
