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
                        <router-link to="/login"><i class="pi pi-user" style="font-size: 1.5rem;"></i></router-link>
                    </div>
                </div>
            </div>
        </nav>
  </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>