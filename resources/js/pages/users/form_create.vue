<template>
    <div class="w-full flex flex-row">
        <div class="w-1/2">
            {{data.roles}}
        </div>
        <div class="w-1/2">
            <div class="m-2 border p-2">
                <div class="input-group">
                    <Checkbox v-model="checked" :binary="true" />
                </div>
            </div>
        </div>
    </div>
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