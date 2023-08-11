<template>
	<div class="text-center px-[12px] lg:px-[30px] ">
		<div class=" max-w-screen-lg mx-auto">
			<h1 class="text-[30px] text-gray-500 font-bold">Get your Product what you want !</h1>
			<div class="text-[15px] items-center">Times are tough. Living with the luxury <i
					class="pi pi-verified"
					style="font-size: 0.9rem;color: blue;"
				></i> </div>
			<div class="flex items-center space-x-[5px]">
				<div class="text-left text-lg">Category: </div>
				<div class="py-1">
					<InputText
						v-model="category"
						class="w-[200px]"
					></InputText>
				</div>
				<div>
					<Button
						label="Search"
						icon="pi pi-search"
						class="p-button-info p-button-sm"
						iconPos="left"
						@click="clickSearch(this.product_type)"
					/>
				</div>
			</div>
			<div class="flex py-4 space-x-2">
				<div
					class="bg-gray-200 text-gray-600 rounded-full cursor-pointer py-2 px-5 "
					:class="'all'==category?'bg-gray-400 ':''"
					:key="row"
					@click="category='all'"
				> All </div>
				<div
					class="bg-gray-200 text-gray-600 rounded-full cursor-pointer py-2 px-5 "
					v-for="row in data.category"
					:class="row.name==category?'bg-gray-400 ':''"
					:key="row"
					@click="category=row.name "
				> {{ row.name }}</div>
			</div>
			<div class="grid md:grid-cols-2 lg:grid-cols-3 md:gap-2 xl:gap-4 pt-4">
				<div
					class="animate-pulse flex space-x-4"
					v-if="loading"
				>
					<div class="rounded-full bg-slate-200 h-10 w-10"></div>
					<div class="flex-1 space-y-6 py-1">
						<div class="h-2 w-full bg-slate-200 rounded"></div>
						<div class="space-y-3">
							<div class="grid grid-cols-3 gap-4">
								<div class="h-2 w-full bg-slate-200 rounded col-span-2"></div>
								<div class="h-2 w-full bg-slate-200 rounded col-span-1"></div>
							</div>
							<div class="h-2 w-full bg-slate-200 rounded"></div>
						</div>
					</div>
				</div>
				<div
					v-else
					class="items-center border p-4 rounded shadow h-[450px] cursor-pointer"
					v-for="item in data.Product"
					:key="item.id"
					@click="openDialog(item)"
				>
					<div
						class="flex justify-center items-center h-[200px]"
						v-if="item.type!= category"
					>
						<img
							class=""
							:src="item.img"
							alt=""
						>
					</div>
					<div class="text-xl text-left pt-[20px] text-gray-500">{{ item.name }}</div>
					<div class=" text-left py-2">{{ item.description }}</div>
					<div class="text-end justify-self-end text-2xl text-gray-500">
						<p class="pb-[20px]">{{ item.price }} $</p>
						<i
							class="pi pi-shopping-cart"
							style="font-size: 1.5rem;"
							@click="openDialog"
						></i>
					</div>
				</div>
				<!-- <div class="items-center border p-4 rounded shadow-lg" @click="openDialog">
            <div class="flex justify-center items-center h-[200px]">
                <img class="" src="../../assets/logo.png" alt="" >
            </div>
            <div class="text-3xl text-left pt-[20px] text-gray-500">Iphone 5s</div>
            <div class="text-lg text-left py-2">New Arrival!</div>
            <div class="text-end justify-self-end text-2xl text-gray-500">
                <p class="pb-[20px]">9.00 $</p>
                <i class="pi pi-shopping-cart" style="font-size: 1.5rem;" @click="openDialog"></i>
            </div>
        </div>
        <div class="items-center border p-4 rounded shadow-lg" @click="openDialog">
            <div class="flex justify-center items-center h-[200px]">
                <img class="" src="../../assets/logo.png" alt="" >
            </div>
            <div class="text-3xl text-left pt-[20px] text-gray-500">Iphone 5s</div>
            <div class="text-lg text-left py-2">New Arrival!</div>
            <div class="text-end justify-self-end text-2xl text-gray-500">
                <p class="pb-[20px]">9.00 $</p>
                <i @click="openDialog" class="pi pi-shopping-cart" style="font-size: 1.5rem;"></i>
            </div>
        </div> -->
				<!-- {{ data }} -->
			</div>
			<Dialog
				header="Product Detail"
				v-model:visible="showDialog"
				:breakpoints="{ '960px': '75vw', '640px': '100vw' }"
				:style="{ width: '60vw' }"
				:modal="true"
			>
				<div class="py-2 grid grid-cols-2 gap-4">
					<div>
						<div class="flex justify-center items-center border rounded p-2">
							<img
								:src="itemOne.img"
								alt=""
								class="w-[300px]"
							>
						</div>

					</div>
					<div>
						<div class="text-3xl text-left pt-[20px] text-gray-500">{{ itemOne.name }}</div>
						<div class="text-lg text-left py-2">{{ itemOne.description }}</div>
						<p class="pt-[20px] text-2xl text-gray-500">{{ itemOne.price }}</p>
						<div class="py-[10px]">
							<p>Model: {{ itemOne.category?.name }}</p>
							<p>Dest: {{ itemOne.category?.description }}</p>
							<p></p>
						</div>
						<div class="pt-[30px] flex space-x-2 text-lg">
							<div class="flex flex-col space-y-2">
								<label for="value">Qty.</label>
								<input
									type="number"
									v-model="itemOne.qty"
									inputId="integeronly"
									class="border rounded p-2 w-[50px] text-lg"
									@change="addQTY(itemOne.price)"
								/>
							</div>
							<div class="flex flex-col space-y-2 text-lg">
								<label for="value">Amount</label>
								<input
									v-model="itemOne.amount"
									inputId="integeronly"
									class="border rounded p-2 w-[200px] text-lg"
									disabled
								/>
							</div>
						</div>
					</div>
				</div>
				<template #footer>
					<!-- <Button label="Cancel" icon="pi pi-times" @click="cancel" class="p-button-text p-button-secondary" /> -->
					<Button
						label="Add to Cart"
						icon="pi pi-shopping-cart"
						@click="addToCard()"
						autofocus
						class="p-button-info"
					/>
				</template>
			</Dialog>
		</div>
	</div>
</template>

<script>
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Dialog from 'primevue/dialog'
import InputNumber from 'primevue/inputnumber'
import Dropdown from 'primevue/dropdown'
import { mapGetters } from "vuex"
export default {
	layout: 'client',
	components: {
		InputText,
		Button,
		Dialog,
		InputNumber,
		Dropdown,
		mapGetters
	},
	data() {
		return {
			showDialog: false,
			loading: true,
			search: '',
			name: '',
			value1: null,
			product_type: null,
			itemOne: [],
			qty: 0,
			amount: 0,
			category: '',
			cart: 0
		}
	},
	computed: {
		...mapGetters({
			data: 'client/data',

		})
	},
	mounted() {
		this.$store.dispatch('client/GET_DATA')
		this.loading = false;
	},
	methods: {
		addToCard() {
			localStorage.setItem('cart', JSON.stringify(this.itemOne));
			this.showDialog = false
		},
		addQTY(price) {
			this.itemOne.amount = this.itemOne.qty * price
		},
		clickSearch(e) {
			// this.$store.dispatch('product/GET_PRODUCT')
			console.log(e);
		},
		edit(id) {

			this.showDialog = true
		},
		openDialog(item) {
			this.itemOne = item;
			this.showDialog = true;
			// this.$store.commit('product/ADD_PRODUCT')
		},
	}
}
</script>

<style>
</style>