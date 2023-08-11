<template>
	<div class="px-[12px] lg:px-[30px] bg-gray-100 mt-[50px]">
		<div class="max-w-screen-xl mx-auto">
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-2 text-lg py-[50px]">
				<div class="flex flex-col space-y-2 text-left">
					<div class="text-2xl flex items-center">
						<i
							class="pi pi-apple"
							style="font-size: 2rem;color: rgb(92, 89, 89);"
						></i><i
							class="pi pi-android"
							style="font-size: 1rem;margin-left: -5px;color: rgb(8, 188, 8);"
						></i>
						<p class="text-blue-500 px-2">E-IpAnd</p>
					</div>
					<div><router-link
							to="/product"
							class=""
						>Products</router-link></div>
					<div><router-link
							to="/contact"
							class=""
						>Contact Us</router-link></div>
					<div><a
							href="https://website-nuxt-front.vercel.app/"
							target="_blank"
							class=""
						>About US</a></div>
					<div class="flex space-x-2">

						<i
							class="pi  pi-map-marker"
							style="font-size: 1rem;color: rgb(248, 5, 5);"
						></i>
						<p>Wat Bo village, Sangkat Sala komreuk, krong Siem Reap, Cambodia
						</p>
					</div>
				</div>
				<div class="">
					<p class="text-xl text-black">Cooperation with</p>
					<div class="flex flex-row items-center space-x-2">
						<i
							class="pi pi-apple"
							style="font-size: 2rem;color: rgb(92, 89, 89);"
						></i>
						<img
							src="../assets/Huawei_Standard_logo.svg.png"
							class="w-[2rem]"
							alt=""
						>
						<img
							src="../assets/Samsung_Logo.svg.webp"
							class="w-[3rem]"
							alt=""
						>
						<img
							src="../assets/Vivo_logo_2019.svg.png"
							class="w-[3rem]"
							alt=""
						>
						<img
							src="../assets/realme-logo-transparent-free-png.webp"
							class="w-[3rem]"
							alt=""
						>
						<img
							src="../assets/windows-logo-logok-0.png"
							class="w-[4rem]"
							alt=""
						>
						<img
							src="../assets/OPPO_LOGO_2019.svg.png"
							class="w-[3rem]"
							alt=""
						>
						<img
							src="../assets/LG_symbol.svg.png"
							class="w-[2rem]"
							alt=""
						>
					</div>
					<p class="text-xl text-black pt-[10px]">Contact Us By</p>
					<div class="flex flex-row items-center space-x-4 pt-[20px]">
						<i
							class="pi pi-twitter"
							style="font-size: 2rem;color: rgb(92, 89, 89);"
						></i>
						<i
							class="pi pi-youtube"
							style="font-size: 2rem;color: rgb(248, 11, 11);"
						></i>
						<i
							class="pi pi-telegram"
							style="font-size: 2rem;color: rgb(18, 191, 222);"
						></i>
						<i
							class="pi pi-instagram"
							style="font-size: 2rem;color: rgb(248, 20, 217);"
						></i>
						<i
							class="pi pi-github"
							style="font-size: 2rem;color: rgb(35, 33, 33);"
						></i>
						<i
							class="pi pi-facebook"
							style="font-size: 2rem;color: rgb(5, 29, 250);"
						></i>
						<i
							class="pi pi-discord"
							style="font-size: 2rem;color: rgb(11, 15, 243);"
						></i>
						<i
							class="pi pi-envelope"
							style="font-size: 2rem;color: rgb(18, 1, 1);"
						></i>
						<i
							class="pi pi-linkedin"
							style="font-size: 2rem;color: rgb(8, 8, 246);"
						></i>
						<i
							class="pi pi-whatsapp"
							style="font-size: 2rem;color:green"
						></i>

					</div>
				</div>
				<div class="">
					<p class="text-xl text-black">Payment Method</p>
					<div class="flex flex-row items-center space-x-2">

						<img
							src="https://t4.ftcdn.net/jpg/04/73/84/61/360_F_473846184_0k637f6855ZJqaulKqAmgJTEVGVibR1P.jpg"
							alt=""
						>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {

}
</script>

<style>
</style>