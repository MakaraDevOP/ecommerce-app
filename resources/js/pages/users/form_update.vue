<script setup>

</script>

<template>
    <Form id="form-create" @submit="submit" :validation-schema="schema" v-slot="{ errors }">
        <div class="flex flex-col">
            <div class="w-full flex flex-col md:flex-row md:mb-5">
                <div class="w-full md:w-1/2 md:pr-4 mb-0 md:mb-5">
                    <div class="flex flex-col">
                        <div class="">
                            <h1 class="text-lg">User info</h1>
                        </div>
                        <div class="flex flex-col mb-2">
                            <Field type="text" name="id" class="hidden" v-model="user.id" />
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="name" class="mb-2">Name</label>
                            <Field type="text" name="name" class="p-component p-inputtext p-inputtext-sm mb-2"
                                v-model="user.name" />
                            <span class="p-error">{{ errors.name }}</span>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="email" class="mb-2">Email</label>
                            <Field type="text" name="email" class="p-component p-inputtext p-inputtext-sm mb-2"
                                v-model="user.email" />
                            <span class="p-error">{{ errors.email }}</span>
                        </div>

                        <div class="flex flex-col">
                            <div class="card-title">
                                <h1 class="text-lg">Roles</h1>
                            </div>
                            <div class="px-2 py-1 border rounded">
                                <div v-for="role in data.roles" :key="role.id" class="field-checkbox m-2">
                                    <Checkbox :inputId="role.id" :value="role.name" v-model="user_has_role"
                                        class="mr-2 p-checkbox-lg" :checked="true" />
                                    <label :for="role.id" class="text-md">{{ role.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 mb-5 md:mb-0">
                    {{ params }}
                </div>
            </div>
            <div class="flex items-center justify-between w-full">
                <Button @click="closeDialog" label="Cancel" class="p-button-sm" />
                <Button type="submit" label="Save" icon="pi pi-save" iconPos="right" class="p-button-sm" />
            </div>
        </div>
    </Form>
</template>

<script>

import * as yup from "yup";

export default {

    props: {
        params: {
            required: true,
            type: Object,
        }
    },
    emits: ['callback'],
    computed: {
        data() {
            try {
                return this.params?.data;
            } catch (e) {
                return null;
            }
        }
    },
    data() {
        const schema = yup.object({
            name: yup
                .string()
                .min(3)
                .required(),
            email: yup
                .string()
                .required()
                .email(),
        });

        return {
            schema,
            roles: [],
            user: [],
            user_has_role: []
        }
    },
    mounted() {
        this.user_has_role = this.data?.user_has_role
        this.user = this.data?.user
    },
    methods: {
        submit(formdate) {
            console.log(formdate)
            try {
                formdate.roles = this.user_has_role;
                this.$store.dispatch("user/update", formdate).then(resp => {
                    this.$emit('callback', resp?.data);
                });
            } catch (e) {
                return null;
            }
        },
        closeDialog(){
            
            try{
                this.params.display = false
                
            } catch (e){
                return null;
            }   
        }
    }
}
</script>