<template>
  <div class="border-b flex justify-between shadow-sm" style="height: 3rem">
    <div class="flex items-center justify-between  w-full p-button-sm">
      <div class="flex space-x-2 h-full">
        <div @click="toggleSideBar" class="h-full px-5 hover:bg-gray-100 flex items-center cursor-pointer">
          <span class="pi pi-bars" style="font-size: 1rem"></span>
        </div>

      </div>
      <div class="py-1">
        <InputText placeholder="Search Menu" type="text" class="min-w-[300px]" />
      </div>
      <div>
        <div class="px-4 flex justify-center items-center space-x-4" v-if="user">
          <span class="text-gray-600 ">{{ user.email }}</span>
          <button class="p-panel-header-icon p-link mr-2" @click="toggle">
            <!-- <span class="pi pi-cog"></span> -->
            <img src="https://avatars.githubusercontent.com/u/97021587?v=4" class="p-1 w-8 h-8 rounded-full border" alt="Avatar" />
          </button>
          <Menu id="config_menu" ref="menu" :model="items" :popup="true" class="text-xs" />
        </div>
      </div>
    </div>
    <div></div>
  </div>
</template>

<script>

import { mapGetters } from 'vuex'
export default {
  components: { mapGetters },
  props: {
    toggleSideBar: Function,
  },
  data() {
    return {
      collapsed: true,
      items: [
        {
          label: 'Options',
          items: [{
            label: 'Update',
            icon: 'pi pi-refresh',
            command: () => {
              this.$toast.add({ severity: 'success', summary: 'Updated', detail: 'Data Updated', life: 3000 });
            }
          },
          {
            label: 'Logout',
            icon: 'pi pi-sign-out',
            command: () => {
              this.logout()
            }
          }
          ]
        },
      ]
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    })
  },
  methods: {
    toggle(event) {
      this.$refs.menu.toggle(event);
    },
    logout() {
      this.$store.dispatch('auth/LOGOUT_SYSTEM').then(respnse => {
        if (respnse) {
          this.$router.push('/login');
        }
      })
    }
  }
};
</script>

<style>

</style>