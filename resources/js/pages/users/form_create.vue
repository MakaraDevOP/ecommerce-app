<script setup>
import { Form, Field, ErrorMessage } from "vee-validate";
import * as yup from "yup";
import Message from "primevue/message";
</script>

<template>
    <Form>
        <div class="flex flex-col">
        <div class="w-full flex flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                {{ data.roles }}
            </div>
            <div class="w-full md:w-1/2">
                <div class="flex flex-col">
                    <div class="card-title">
                        <h1 class="text-lg">Roles</h1>
                    </div>
                    <div v-for="role in data.roles" :key="role" class="field-checkbox m-1">
                        <input type="checkbox" name="role[]" class="hidden" v-model="role.is_selected">
                        <Checkbox :inputId="role.name" v-model="role.is_selected" :binary="true" class="mr-2" />
                        <label :for="role.name">{{ role.name }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between w-full bg-red-500">
            <Button label="Cancel" class="p-button-sm"/>
            <Button label="Save" class="p-button-sm"/>
        </div>
    </div>
    </Form>
</template>

<script>
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
    }
}
</script>