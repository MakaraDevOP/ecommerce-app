<template>
  <div>
    <div>Photo</div>
    <img :src="preview" alt="" class="w-[500px]">
  </div>
</template>

<script>
export default {
  data() {
    return {
      preview: ''
    }
  },

  created() {
    // console.log(this.$route.query.myProperty)
    const dataFile = JSON.parse(this.$route.query.myProperty);

    // Convert the string to bytes
    var bytes = new Uint8Array(dataFile.data.length / 2);

    for (var i = 0; i < dataFile.data.length; i += 2) {
      bytes[i / 2] = parseInt(dataFile.data.substring(i, i + 2), /* base = */ 16);
    }

    // Make a Blob from the bytes
    var blob = new Blob([bytes], { type: 'image/bmp' });
    this.preview = URL.createObjectURL(blob);
    console.log(this.preview)
  }
}
</script>

<style>

</style>