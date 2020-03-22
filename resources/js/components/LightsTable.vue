<template>
    <div>
        <div class="pull-right">
            <button class="btn btn-info btn-round" @click="init" dusk="refresh" :disabled="loader">
                <i v-if="loader" class="fas fa-spinner fa-spin"></i>
                Refresh
            </button>
        </div>
        <table class="table">
            <thead class=" text-primary">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Groups Associate</th>
                <th>networkId</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr class="light-list" v-for="light in lights">
                <td>
                    <i v-if="light.state != null" v-bind:class="[light.state ? 'text-warning' : '']" class="far fa-lightbulb light-state"></i>
                    <i v-else class="far fa-lightbulb light-state text-danger"></i>
                </td>
                <td>{{ light.name }}</td>
                <td>
                    <span class="badge badge-secondary" v-for="group in light.groups">{{ group.name }}</span>
                </td>
                <td>{{ light.networkId }}</td>
                <td class="text-right">
                    <button v-if="loader || light.loader || light.state === false || light.state" v-bind:class="[light.state ? 'btn-success' : '']" type="button" class="btn btn-round btn-light-change-state" @click="changeState(light)">
                        <i v-if="loader || light.loader" class="fas fa-spinner fa-spin"></i>
                        <span v-else>On</span>
                    </button>
                    <button v-else type="button" class="btn btn-round btn-light-change-state btn-danger">
                        <span>Unable to connect</span>
                    </button>
                    <a v-bind:href="'/lights/' + light.id +'/edit'" class="btn btn-round btn-secondary" v-bind:dusk="'edit-' + light.id">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-round btn-danger" v-bind:dusk="'delete-' + light.id" @click="deleteLight(light)">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "LightsTable",
        data() {
            return {
                textDanger: 'text-danger',
                loader: true,
                lights: []
            }
        },
        mounted () {
            this.init();
        },
        methods: {
            init() {
                this.loader = true;
                axios.get('/api/v1/lights').then(response => {
                    this.lights = response.data;
                    this.lights.forEach(light => {
                        this.$set(light, 'state', null);
                        this.$set(light, 'loader', true);
                        axios.get(`/api/v1/lights/${light.id}`).then(response => {
                            if (response.status === 200) {
                                light.state = response.data.state.on;
                                light.loader = false;
                            }
                        }).catch(response => {
                            light.loader = false;
                        });
                    });
                    this.loader = false;
                });
            },
            changeState(light) {
                light.loader = true;
                axios.get(`/api/v1/lights/${light.id}/state`).then(response => {
                    if (response.status === 200) {
                        light.state = response.data.state;
                    } else {
                        light.state = null;
                    }
                    light.loader = false;
                });
            },
            deleteLight(light) {
                axios.delete(`api/v1/lights/${light.id}`).then(response => {
                    let index = this.lights.indexOf(light);
                    if (index > -1) {
                        this.lights.splice(index, 1);
                    }
                    new Noty({
                        type: 'success',
                        theme: 'mint',
                        layout: 'topRight',
                        text: `The Light ${light.name} has been deleted.`,
                        closeWith: ['click', 'button'],
                        timeout: 3000
                    }).show();
                });
            }
        }
    }
</script>

<style scoped>

</style>
