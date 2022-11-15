export const product = {
  namespaced: true,
  state: {
    products: [],
  },
  getters: {
    product:state=>state.products
  },
  mutations: {
    SET_PRODUCT(state , data) {
      state.products =data
    }
  },
  actions: {
    async GET_PRODUCT({ commit }) {
      await axios.get('/product/get').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_PRODUCT', response.data.Product)
        return response;
      })
    }
  }
};