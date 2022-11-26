<template>
  <div style="height: 100vh; width: 100vw">
    <router-view />
  </div>
  <!-- USING GLOBAL COMPONENTS -->
  <Toast />
  <ConfirmPopup></ConfirmPopup>
  <!-- USING GLOBAL COMPONENTS -->
</template>

<script>
export default {
  name: "App",
  components: {},
  mounted() {
    console.log(`\n%cDev OP - Subscription APP 🚀`, 'color:#0dd8d8; background:#0b1021; font-size:1.5rem; padding:0.15rem 0.25rem; margin: 1rem auto; font-family: Rockwell; border: 2px solid #0dd8d8; border-radius: 4px;font-weight: bold; text-shadow: 1px 1px 1px #00af87bf;');
  }
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,400&display=swap");

body {
  overflow-y: hidden;
  overflow-x: hidden;
}

#app {
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  font-size: 14px;
}
</style>
