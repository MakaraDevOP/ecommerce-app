<template>
  <div class="text-center px-[12px] lg:px-[30px] ">
    <div class=" max-w-screen-lg mx-auto">
    <h1 class="text-[30px] text-purple-500 font-bold">Get your Product what you want !</h1>
    <div class="text-[15px] items-center">Times are tough. Living with the luxury <i class="pi pi-verified" style="font-size: 0.9rem;color: blue;"></i> </div>
    <div class="flex items-center space-x-[5px]">
        <div class="text-left text-lg">Category: </div>
        <div class="py-1">
            <Dropdown
                v-model="product_type"
                :options="productType"
                optionLabel="name"
                optionValue="id"
                class="w-[200px]"
            />
        </div>  
        <div>
            <!-- <Button
                @click="clickSearch"
                icon="pi pi-search"
                class="p-button-sm"
            /> -->
            <Button
                label="Search"
                icon="pi pi-search"
                class="p-button-info p-button-sm"
                iconPos="left"
                @click="clickSearch(this.product_type)"
            />
        </div>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 md:gap-4 xl:gap-16 pt-8">
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
        <div v-else class="items-center border p-4 rounded shadow-lg h-[450px] cursor-pointer" v-for="item in products" :key="item.id" @click="openDialog">
            <div class="flex justify-center items-center h-[200px]">
                <img class="" src="../../assets/logo.png" alt="" >
            </div>
            <div class="text-3xl text-left pt-[20px] text-purple-500">{{ item.name }}</div>
            <div class="text-lg text-left py-2">New Arrival!</div>
            <div class="text-end justify-self-end text-2xl text-purple-500">
                <p class="pb-[20px]">{{ item.price }} $</p>
                <i class="pi pi-shopping-cart" style="font-size: 1.5rem;" @click="openDialog"></i>
            </div>
        </div>
        <!-- <div class="items-center border p-4 rounded shadow-lg" @click="openDialog">
            <div class="flex justify-center items-center h-[200px]">
                <img class="" src="../../assets/logo.png" alt="" >
            </div>
            <div class="text-3xl text-left pt-[20px] text-purple-500">Iphone 5s</div>
            <div class="text-lg text-left py-2">New Arrival!</div>
            <div class="text-end justify-self-end text-2xl text-purple-500">
                <p class="pb-[20px]">9.00 $</p>
                <i class="pi pi-shopping-cart" style="font-size: 1.5rem;" @click="openDialog"></i>
            </div>
        </div>
        <div class="items-center border p-4 rounded shadow-lg" @click="openDialog">
            <div class="flex justify-center items-center h-[200px]">
                <img class="" src="../../assets/logo.png" alt="" >
            </div>
            <div class="text-3xl text-left pt-[20px] text-purple-500">Iphone 5s</div>
            <div class="text-lg text-left py-2">New Arrival!</div>
            <div class="text-end justify-self-end text-2xl text-purple-500">
                <p class="pb-[20px]">9.00 $</p>
                <i @click="openDialog" class="pi pi-shopping-cart" style="font-size: 1.5rem;"></i>
            </div>
        </div> -->
        
    </div>
    <Dialog header="Product Detail" v-model:visible="showDialog" :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '60vw' }">
        <div class="py-2 grid grid-cols-2 gap-4">
            <div>
                <div class="flex justify-center items-center border rounded p-2">
                    <img src="../../assets/LG_symbol.svg.png" alt="" class="w-[300px]">
                </div>
                
            </div>
            <div>
                <div class="text-3xl text-left pt-[20px] text-purple-500">Iphone 5s</div>
                <div class="text-lg text-left py-2">New Arrival!</div>
                <p class="pt-[20px] text-2xl text-purple-500">9.00 $</p>
                <div class="py-[10px]">
                    <p>Model: Iphone</p>
                    <p>Company: Apple Inc</p>
                    <p>Function: Games, Video, Music,Entertainment</p>
                </div>
                <div class="pt-[30px] flex space-x-2">
                    <div class="flex flex-col space-y-2">
                        <label for="value">Qty.</label>
                        <input type="number" v-model="value1" inputId="integeronly" class="border rounded p-2 w-[50px]"/>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="value">Amount</label>
                        <InputNumber v-model="value1" inputId="integeronly" />
                    </div>
                </div>
            </div>
        </div>
        <template #footer>
          <!-- <Button label="Cancel" icon="pi pi-times" @click="cancel" class="p-button-text p-button-secondary" /> -->
          <Button label="Add to Cart" icon="pi pi-shopping-cart" @click="createORupdateProduct" autofocus class="p-button-info" />
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
    components:{
        InputText,
        Button,
        Dialog,
        InputNumber,
        Dropdown,
        mapGetters
    },
    data(){
        return{
            showDialog: false,
            loading: true,
            search:'',
            name:'',
            value1:null,
            product_type:null,
        }
    },
    computed: {
		...mapGetters({
			products: 'product/products',
			product: 'product/product',
			productType: 'product/productType'
		})
	},
	mounted() {
		this.$store.dispatch('product/GET_PRODUCT')
        this.loading =false;
	},
    methods:{
        clickSearch(e){
            // this.$store.dispatch('product/GET_PRODUCT')
            console.log(e);
        },
        edit(id) {
           
            this.showDialog = true
        },
        openDialog() {
        this.showDialog = true;
        // this.$store.commit('product/ADD_PRODUCT')
        },
    }
}
</script>

<style>

</style>