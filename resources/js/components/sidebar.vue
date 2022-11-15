<template>
  <div class="bg-gray-800  text-white overflow-hidden" id="side-bar" :class="dataSibar == true ? 'side-bar-visible' : 'side-bar-close'">
    <div style="height: 3rem">
      <div class="h-full flex justify-center items-center  ">
        <span class="font-semibold uppercase text-xl px-6 whitespace-nowrap" v-if="dataSibar">App Dev</span>
        <div class="text-center flex justify-center items-center h-full" v-if="!dataSibar">
          <img src="https://avatars.githubusercontent.com/u/97021587?v=4" class="p-[2px] w-8 h-8 rounded-full ring-1 ring-gray-300 dark:ring-gray-500 " alt="Avatar" />
        </div>
      </div>
      <div class="flex flex-col justify-between h-[calc(100vh-3rem)] bg-gray-900">
        <div class="menu-man text-left px-2 whitespace-nowrap ">
          <div class="profile flex justify-center items-center text-center p-5 " v-show="dataSibar">
            <div class="text-center ">
              <img src="https://avatars.githubusercontent.com/u/97021587?v=4" class="p-1 w-24 h-24 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mb-4" alt="Avatar" />

              <h5 class="text-xl font-medium leading-tight mb-2">{{ user.name }}</h5>
              <p class="text-gray-500">{{ user.roles[0].name }}</p>
            </div>
          </div>
          <div class="   py-3 rounded-sm cursor-pointer text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <router-link to="/" class="px-2 flex space-x-2"><span class="pi pi-microsoft" v-tooltip.right="'Dashboard'"></span> <span v-show="dataSibar">Dashboard</span></router-link>
          </div>
          <div class="   py-3 rounded-md cursor-pointer  text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <router-link to="/user" class="px-2 flex space-x-2"><span class="pi pi-user " v-tooltip.right="'User'"></span> <span v-show="dataSibar">User</span></router-link>
          </div>
          <div class="   py-3 rounded-md cursor-pointer  text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <router-link to="/product" class="px-2 flex space-x-2"><span class="pi pi-cart-plus " v-tooltip.right="'Product'"></span> <span v-show="dataSibar">Product</span></router-link>
          </div>
          <div class="  py-3 rounded-md cursor-pointer text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <div class="px-2 flex space-x-2"><span class="pi pi-whatsapp  " v-tooltip.right="'Contact'"></span> <span v-show="dataSibar">Contact</span></div>
          </div>
          <div class="  py-3 rounded-md cursor-pointer text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <div class="px-2 flex space-x-2"><span class="pi pi-shield " v-tooltip.right="'Customer'"></span> <span v-show="dataSibar">Customer</span></div>
          </div>
          <div class="  py-3 rounded-md cursor-pointer text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <div class="px-2 flex space-x-2"><span class="pi  pi-check-circle " v-tooltip.right="'Activation'"></span> <span v-show="dataSibar">Activation</span></div>
          </div>
          <div class="  py-3 rounded-md cursor-pointer text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <div class="px-2 flex space-x-2"><span class="pi pi-slack" v-tooltip.right="'Setting'"></span> <span v-show="dataSibar">Setting</span></div>
          </div>
        </div>
        <div class="menu-man text-left px-2 justify-self-end whitespace-nowrap">
          <div class="   py-3 rounded-md cursor-pointer text-gray-300 hover:text-white" :class="dataSibar == true ? 'px-2' : ''">
            <div class="px-2 flex space-x-2"><span class="pi pi-question" v-tooltip.right="'About Me'"></span> <span v-show="dataSibar">About Me</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex"
export default {
  data() {
    return {
      sideBarVisible: false,
    };
  },
  props: {
    dataSibar: Boolean,
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    })
  },
};
</script>

<style>
.p-tooltip-text {
  font-size: 10px !important;
}

#side-bar {
  overflow: hidden;
  transition: 300ms;
}

.side-bar-visible {
  width: 250px !important;
}

.side-bar-close {
  width: 50px !important;
}
</style>