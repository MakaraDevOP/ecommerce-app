<template>
  <div class="fixed top-0 w-full z-50">
    <div class="relative">
        <nav class="mx-auto w-full px-[12px] lg:px-[30px] space-x-4 bg-gray-100 shadow-sm border-b navbar-page">
            <div class="max-w-screen-lg mx-auto ">
                <div class="flex flex-row space-x-2 justify-between items-center py-[10px] ">
                    <div class="text-2xl flex items-center">
                        <i class="pi pi-apple" style="font-size: 2rem;color: rgb(92, 89, 89);"></i><i class="pi pi-android" style="font-size: 1rem;margin-left: -5px;color: rgb(8, 188, 8);"></i><p class="text-blue-500 px-2">E-IpAnd</p>
                    </div>
                    <router-link to="/home" class="p-2">HOME</router-link>
                    <router-link to="/products" class="p-2">PRODUCTS</router-link>
                    <router-link to="/contact" class="p-2">CONTACT US</router-link>
                    <a href="https://website-nuxt-front.vercel.app/" target="_blank" class="p-2">ABOUT US</a>
                    <div class="flex flex-row space-x-4">
                        <router-link to="/cart"><i class="pi pi-shopping-cart" style="font-size: 1.5rem;color: blue;"></i></router-link>
                        <router-link to="/"><i class="pi pi-user" style="font-size: 1.5rem;"></i></router-link>
                        <div class="text-blue-500" @click="openDialog">Sign up</div>

                    </div>
                </div>
            </div>
        </nav>
        <Dialog
				header="Customer"
				v-model:visible="showDialog"
				:breakpoints="{ '960px': '75vw', '640px': '100vw' }"
				:style="{ width: '50vw' }"
			>
				<div class="py-2 grid grid-cols-2 gap-4">
					<div class="flex flex-col space-y-4">
						<InputText
							v-model="customer.company_name"
							placeholder="company name"
						/>
						<InputText
							v-model="customer.phone"
							placeholder="phone"
						/>
						<InputText
							v-model="customer.email"
							placeholder="email"
						/>
						<Dropdown
							v-model="customer.parent_company_id"
							:options="parentCompany"
							optionLabel="company_name"
							optionValue="id"
						/>
						<div class="field-checkbox">
							<Checkbox
								v-model="customer.is_active"
								:binary="true"
								trueValue="1"
								falseValue="0"
								inputId="is_active"
							/>
							<label
								for="is_active"
								class="px-2"
							>is active</label>
						</div>
					</div>
					<div class=" flex flex-col space-y-4">
						<InputText
							v-model="customer.province_city"
							placeholder="province city"
							class="w-full"
						/>
						<Textarea
							v-model="customer.detail_address"
							placeholder="detail address"
							rows="4"
							class="w-full"
						/>
					</div>
				</div>
				<template #footer>
					<Button
						label="Cancel"
						icon="pi pi-times"
						@click="cancel"
						class="p-button-text p-button-secondary"
					/>
					<Button
						label="Save"
						icon="pi pi-check"
						@click="clickAdd"
						autofocus
						class="p-button-info"
					/>
				</template>
			</Dialog>
  </div>
  </div>
</template>

<script>
import Dropdown from 'primevue/dropdown';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Checkbox from 'primevue/checkbox';
import { mapGetters } from "vuex"
export default {
    components:{
        Dropdown,
        mapGetters,
        Button,
        InputText,
        Textarea,
        Checkbox
    },
    data() {
		return {
			showDialog: false,
            parentCompany: []
        }
    },
    computed: {
		...mapGetters({
			customers: 'customer/customers',
			customer: 'customer/customer',
		})
	},
methods:{
    openDialog() {
			this.showDialog = true;
			this.parentCompany = [];
			// ` `  `
			this.$store.commit('customer/ADD_CUSTOMER')
		},
		cancel() {
			this.showDialog = false;
			this.$store.commit('customer/ADD_CUSTOMER')
		},
    clickAdd(){
            this.$store.dispatch('customer/CREATE_CUSTOMER').then(respnse => {
                if (respnse) {
                    this.$toast.add({ severity: 'success', summary: 'Success Message', detail: 'Created successfully', life: 3000 });
                    this.showDialog = false
                }
            }).catch(error => {
                this.$toast.add({ severity: 'error', summary: 'Error Message', detail: error, life: 3000 });
            })
    }
}
}
</script>

<style>

</style>