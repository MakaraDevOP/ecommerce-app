<template>
  <Navbar></Navbar>
  <div class=" pt-[80px] overflow-auto h-full" style="">
    <router-view />
<Footer></Footer>
  </div>
</template>

<script>
import Footer from '../../components/Footer.vue';
import Navbar from '../../components/Navbar.vue';
export default {
  components:{
    Navbar,
    Footer,
  }
}
</script>

<style>

</style>