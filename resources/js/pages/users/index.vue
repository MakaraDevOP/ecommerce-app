<script setup>
import DialogCreate from "./form_create.vue";
import DialogUpdate from "./form_update.vue";
import DialogProfile from './profile.vue'
</script>

<template>
    <div class="border rounded  ">
        <div class="h-[calc(100vh-4.1rem)]">
            <div class="w-full flex flex-col">
                <DataTable :value="Users" class="p-datatable-sm">
                    <template #header>
                        <div class="flex justify-between">
                            <div class="">
                                <Button label="Addnew" class="p-button-sm" />
                            </div>
                            <div class="">
                                <Button @click="opentCreateNewDialog" label="Addnew" icon="pi pi-plus" iconPos="right"
                                    class="p-button-sm " />
                            </div>
                        </div>
                    </template>
                    <Column field="name" header="Name"></Column>
                    <Column field="email" header="Email"></Column>
                    <Column field="roles" header="Role" class="flex">
                        <template #body="params">
                            <div v-for="role in params?.data?.roles" :key="role.id" class="mr-1">
                                <Badge class="p-badge-sm text-xs font-normal p-badge-info">{{ role.name }}</Badge>
                            </div>
                        </template>
                    </Column>
                    <Column header="Actions" style="width: 15rem;">
                        <template #body="params">
                            <div class="flex space-x-3">
                                <div class="" @click="openDialogUpdateProfile(params.data.id)">
                                    Detail
                                </div>
                                <div class="" @click="openDialogUpdate(params.data.id)">
                                    Update me
                                </div>
                                <div class="" @click="openDialogDelete(params.data.id)">
                                    Delete me
                                </div>
                            </div>
                        </template>
                    </Column>
                </DataTable>

                <Dialog header="Create User" v-model:visible="dialogCreate.display" :modal="true"
                    :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
                    <DialogCreate :params="dialogCreate" @callback="dialogCallback" />
                </Dialog>

                <Dialog header="Update User" v-model:visible="dialogUpdate.display" :modal="true"
                    :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
                    <DialogUpdate :params="dialogUpdate" @callback="dialogCallback" />
                </Dialog>

                <Dialog header="Profile" v-model:visible="dialogProfile.display" :modal="true"
                    :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
                    <DialogProfile :params="dialogProfile" @callback="dialogCallback" />
                </Dialog>
            </div>
        </div>
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
            dialogCreate: {
                display: false,
                data: Object,
            },
            dialogUpdate: {
                display: false,
                data: Object,
            },
            dialogProfile: {
                display: false,
                data: Object,
            }
        };
    },
    created() {
        this.initialData()
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
        name: 'user-layout',
        
        initialData() {
            try {
                this.$store.dispatch("user/fetchUsers");
            } catch (e) {
                return null;
            }
        },
        opentCreateNewDialog() {
            try {
                this.$store.dispatch("user/create").then(resp => {
                    this.dialogCreate = {
                        display: true,
                        data: resp.data,
                    }
                });
            } catch (e) {
                return null;
            }
        },
        openDialogUpdate(id) {
            console.log(id)
            try {
                this.$store.dispatch("user/edit", id).then(resp => {
                    var data = Object
                    data.roles = resp.roles
                    data.user = resp.user
                    data.user_has_role = resp.user_has_roles

                    this.dialogUpdate = {
                        display: true,
                        data: data
                    }
                });
            } catch (e) {
                return null;
            }
        },
        openDialogUpdateProfile() {
            this.dialogProfile = {
                display: true,
                data: []
            }
        },
        openDialogDelete(id) {
            this.$confirm.require({
                target: event.currentTarget,
                message: 'Are you sure you want to proceed?',
                icon: 'pi pi-exclamation-triangle',
                accept: () => {
                    this.$store.dispatch('user/destroy', id).then(respnse => {
                        this.initialData()
                        if (respnse) {
                            this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Deleted successfully', life: 3000 });
                        }
                    })
                },
                reject: () => {
                    this.$toast.add({ severity: 'info', summary: 'Infomation Message', detail: 'Rejected', life: 3000 });
                }
            });
        },

        dialogCallback(resp) {
            if (resp.errors) {
                console.log
            }

            this.dialogCreate = {
                display: false,
                data: [],
            }
            this.dialogUpdate = {
                display: false,
                data: [],
            }

            this.initialData()
        }
    },
};
</script>