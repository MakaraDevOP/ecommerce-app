<script setup>
    import FormCreate from "./form_create.vue";
</script>

<template>
    <div class="w-full flex flex-col">
        <DataTable :value="Users" class="p-datatable-sm">
            <template #header>
                <div class="flex justify-between">
                    <div class="">
                        <Button label="Addnew" class="p-button-sm" />
                    </div>
                    <div class="">
                        <Button @click="opentCreateNewDialog" label="Addnew" icon="pi pi-plus" iconPos="right" class="p-button-sm " />
                    </div>
                </div>
            </template>
            <Column field="name" header="Name"></Column>
            <Column field="email" header="Email"></Column>
            <Column field="brand" header="Phone"></Column>
            <Column field="roles" header="Role" class="flex">
                <template #body="params">
                    <div v-for="role in params?.data?.roles" :key="role.id" class="mr-1">
                        <Badge class="p-badge-sm text-xs font-normal p-badge-info">{{ role.name }}</Badge>
                    </div>
                </template>
            </Column>
        </DataTable>

        <Dialog header="Header" v-model:visible="DialogCreate.display" :modal="true"
            :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
            <FormCreate :params="DialogCreate" />
        </Dialog>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "UserPage",
    data() {
        const badgeClass = [
            'p-badge-success',
            'p-badge-info',
            'p-badge-warning',
            'p-badge-danger',
        ]
        return {
            badgeClass,
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

        Users() {
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
                this.$store.dispatch("user/create").then(resp => {
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