<template>
    <div class="group-buttons">
        <button @click="changeState(1)" :disabled="blocked" type="button" class="btn btn-round btn-group-change-state btn-success" v-bind:dusk="'on-' + id">
            <i v-if="loader.on" class="fas fa-spinner fa-spin"></i>
            On
        </button>
        <button @click="changeState(0)" :disabled="blocked" type="button" class="btn btn-round btn-group-change-state" v-bind:dusk="'off-' + id">
            <i v-if="loader.off" class="fas fa-spinner fa-spin"></i>
            Off
        </button>
    </div>
</template>

<script>
    export default {
        name: "GroupButton",
        props: ['id'],
        data() {
            return {
                loader: {
                    on: false,
                    off: false
                },
                blocked: false
            }
        },
        methods: {
            changeState(state) {
                if (state) {
                    this.loader.on = true;
                } else {
                    this.loader.off = true;
                }
                this.blocked = true;

                axios.get(`/api/v1/groups/${this.id}/state/${state}`).then(response => {
                    new Noty({
                        type: 'success',
                        theme: 'mint',
                        layout: 'topRight',
                        text: state ? 'Group switched to On' : 'Group switched to Off',
                        closeWith: ['click', 'button'],
                        timeout: 3000
                    }).show();
                }).catch(error => {
                    if (error.response.status === 500) {
                        new Noty({
                            type: 'error',
                            theme: 'mint',
                            layout: 'topRight',
                            text: "Unable to get the bridge",
                            closeWith: ['click', 'button'],
                            timeout: 3000
                        }).show();
                    } else {
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
                    }
                }).then(() => {
                    this.blocked = false;
                    if (state) {
                        this.loader.on = false;
                    } else {
                        this.loader.off = false;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
