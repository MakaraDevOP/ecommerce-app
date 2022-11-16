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
                            <label for="name" class="mb-2">Name</label>
                            <Field type="text" name="name" class="p-component p-inputtext p-inputtext-sm mb-2" />
                            <span class="p-error"></span>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="email" class="mb-2">Email</label>
                            <Field type="text" name="email" class="p-component p-inputtext p-inputtext-sm mb-2" />
                            <span class="p-error">{{ errors.email }}</span>
                        </div>
                        <div class="flex flex-col mb-2">
                            <label for="password" class="mb-2">Password</label>
                            <Field type="text" name="password" class="p-component p-inputtext p-inputtext-sm mb-2" />
                            <span class="p-error">{{ errors.password }}</span>
                        </div>
                        <div class="flex flex-col">
                            <div class="card-title">
                                <h1 class="text-lg">Roles</h1>
                            </div>
                            <div class="px-2 py-1 border rounded">
                                <div v-for="role in data.roles" :key="role" class="field-checkbox m-2">
                                    <Field type="checkbox" name="roles[]" class="" v-model="role.is_selected"/>

                                    <Checkbox :inputId="role.name" v-model="role.is_selected" :binary="true"
                                        class="mr-2 p-checkbox-lg" />
                                    <label :for="role.name" class="text-md">{{ role.name }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 mb-5 md:mb-0">
                    Testing
                </div>
            </div>
            <div class="flex items-center justify-between w-full">
                <Button label="Cancel" class="p-button-sm" />
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
    computed: {
        data() {
            try {
                return this.params.data;
            } catch (e) {
                return null;
            }
        },
    },
    data() {
        const schema = yup.object({
            email: yup
                .string()
                .required()
                .email(),
            password: yup
                .string()
                .min(8)
                .required(),
        });

        return {
            schema,
        }
    },
    methods: {
        submit(formdate) {
            try {
                this.$store.dispatch("user/store", formdate).then(resp => {
                   console.log(resp)
                });
            } catch (e) {
                return null;
            }
        }
    }
}
</script>