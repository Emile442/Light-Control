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
                <button class="btn btn-warning btn-lg" type="submit" dusk="on-light" @click="switchButton(group)">
                    <i v-if="loader || group.loader" class="fas fa-spinner fa-spin"></i>
                    <span v-else>Allumer</span>
                </button>
            </div>
            <hr v-if="index != groups.length - 1">
        </div>
        <div class="alert alert-warning" v-if="!groups && !loader">
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
                groups: []
            }
        },
        mounted () {
            this.init();
        },
        methods: {
            init () {
                this.loader = true;
                axios.get('/api/v1/guest/groups').then(response => {
                    this.groups = response.data;
                    this.groups.forEach(group => {
                        this.$set(group, 'loader', false);
                    });
                    this.loader = false;
                })
            },
            switchButton(group) {
                console.log(group);
                group.loader = true;
                axios.get(`/api/v1/guest/groups/${group.id}/switch`).then(response => {
                    group.timers = response.data.group.timers;
                    console.log(response.data);
                }).catch(error => {
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
