<script setup>
import Dialog from "primevue/dialog";
import FormCreate from "./form_create.vue";
</script>

<template>
    <div class="grid grid-cols-3 gap-4 p-2">
        <button @click="opentCreateNewDialog">Create new</button>

        <Dialog header="Header" v-model:visible="DialogCreate.display"
            :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
            <FormCreate :params="DialogCreate" />
        </Dialog>

        {{ getUserList }}
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "UserPage",
    data() {
        return {
            DialogCreate: {
                display: false,
                data: Object,
            },
        };
    },
    created() {
        try {
            this.$store.dispatch("user/fetchUsers");
        } catch (e) {
            return null;
        }
    },
    computed: {
        ...mapGetters({
            list: "user/list",
        }),

        getUserList() {
            try {
                return this.list;
            } catch (e) {
                return null;
            }
        },
    },

    methods: {
        opentCreateNewDialog() {
            try {
                this.$store.dispatch("user/addNew").then(resp => {
                    this.DialogCreate = {
                        display: true,
                        data: resp.data,
                    }
                });
            } catch (e) {
                return null;
            }
        },
    },
};
</script>