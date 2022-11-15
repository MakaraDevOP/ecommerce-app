<template>
  <div>
    <div class="flex h-screen items-center justify-center  px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8 border p-8">
        <div>
          <h1 class="text-4xl text-orange-600  font-bold ">DEV OP</h1>
          <h2 class="mt-6 text-center text-2xl text-gray-800">Subscription Management</h2>
        </div>
        <form class="mt-8 space-y-6" id="login-form">
          <input type="hidden" name="remember" value="true" />
          <div class="-space-y-px rounded-md shadow-sm">
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input id="email-address" v-model="objData.email" name="email" type="email" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address" />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input id="password" v-model="objData.password" name="password" type="password" class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Password" />
            </div>
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>
            <div class="text-sm">
              <a href="#" class="font-medium text-orange-600 ">Forgot your password?</a>
            </div>
          </div>
          <div>
          </div>
        </form>
        <button @click="login" class="group relative flex w-full justify-center rounded-md border border-transparent bg-gray-800 py-2 px-4 text-sm font-medium text-white hover:bg-gray-700">
          Sign in
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      objData: {
        email: 'admin@gmail.com',
        password: 'dev123'
      }
    }
  },
  methods: {
    login() {
      this.$store.dispatch("auth/LOGIN_SYSTEM", this.objData).then(reponse => {
        if (reponse.status == '201') {
          this.$router.push('/');
        }
      })
    }
  }
}
</script>

<style>

</style>