<template>
  <div class="flex flex-row">
    <div class="w-full ">
      <div class="flex w-full ">
        <Siade :dataSibar="isOpen"></Siade>
        <div class="w-full border">
          <Header :toggleSideBar="clickToggle"></Header>
          <div class="bg-slate-100 h-full overflow-y-auto p-2" style="height: calc(100vh - 3rem)">
            <router-view />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Siade from "./../../components/sidebar.vue";
import Header from "./../../components/header.vue";
export default {
  components: { Siade, Header },
  data() {
    return {
      isOpen: true
    }
  },
  methods: {
    clickToggle() {
      this.isOpen = !this.isOpen
      console.log("dataSibar");
    }
  }
};
</script>

<style>

</style>
