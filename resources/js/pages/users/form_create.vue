<template>
    <Form @submit="submit" :validation-schema="schema" v-slot="{ errors }">
        <div class="flex space-x-4 py-5">
            <div class="w-1/2">
                <div class="flex flex-col">
                    <label for="name" class="mb-1">Name</label>
                    <Field type="text" name="name" class="p-component p-inputtext p-inputtext-sm mb-2" :class="{ 'p-invalid': errors.name }" />
                    <span class="p-error">{{ errors.name }}</span>
                </div>
                <div class="flex flex-col">
                    <label for="name" class="mb-1">Email</label>
                    <Field type="text" name="email" class="p-component p-inputtext p-inputtext-sm mb-2" :class="{ 'p-invalid': errors.email }" />
                    <span class="p-error">{{ errors.email }}</span>
                </div>
                <div class="flex flex-col">
                    <label for="name" class="mb-1">Password</label>
                    <Field type="text" name="password" class="p-component p-inputtext p-inputtext-sm mb-2" :class="{ 'p-invalid': errors.password }" />
                    <span class="p-error">{{ errors.password }}</span>
                </div>
                <div class="flex flex-col">
                    <label for="name" class="mb-1">Confirm Password</label>
                    <Field type="text" name="confirmed" class="p-component p-inputtext p-inputtext-sm mb-2" :class="{ 'p-invalid': errors.confirmed }" />
                    <span class="p-error">{{ errors.confirmed }}</span>
                </div>
            </div>
            <div class="w-1/2">
                <label for="" class="mb-1">Roles</label>
                <div class="px-2 py-1 border rounded">
                    <div v-for="role in data.roles" :key="role" class="field-checkbox m-2">
                        <Checkbox :inputId="role.id" :value="role.name" v-model="roles" class="mr-2 p-checkbox-lg" />
                        <label :for="role.id" class="text-md">{{ role.name }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-between ">
            <Button class="p-button-sm p-button-secondary" @click="closeDialog"> Close</Button>
            <Button class="p-button-sm " type="submit"> Save</Button>
        </div>
    </Form>
</template>

<script>
import *  as yup from 'yup';
import { Field, Form, ErrorMessage } from 'vee-validate';
export default {
    components: { Field, Form, ErrorMessage },
    props: {
        params: {
            required: true,
            type: Object,
        }
    },
    data() {
        const schema = yup.object({
            name: yup.string().required(),
            email: yup.string().email().required(),
            password: yup.string().min(8).required(),
            confirmed: yup.string().min(8).required(),
        })
        return {
            schema,
            roles: []
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
        },
    },
    methods: {

        //  For Submit data
        submit(formdate) {
            try {
                formdate.roles = this.roles;
                this.$store.dispatch("user/store", formdate).then(resp => {
                    this.$emit('callback', resp?.data);
                });
            } catch (e) {
                return null;
            }
        },
        closeDialog() {
            try {
                this.params.display = false
            } catch (e) {
                return null;
            }
        }
    }
}
</script>

<style>

</style>