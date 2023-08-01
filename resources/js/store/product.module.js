export const product = {
  namespaced: true,
  state: {
    products: [],
    productType: [],
    // MODEL
    product: {
      name: "",
      type: "",
      price: "",
      stock: "",
      description: "",
      is_active: "1"
    },
    //DEFAULT
    defaultProduct: {
      name: "",
      type: "",
      price: "",
      stock: "",
      description: "",
      is_active: "1"
    }
  },
  getters: {
    products: state => state.products,
    product: state => state.product,
    productType: state => state.productType,
    chartProduct(state) {
      var obj = [];
      for (var data of state.products) {
        obj = [...obj, data.name]
      }
      return obj;
    }
  },
  mutations: {
    SET_PRODUCT(state, data) {
      state.products = data
    },
    SET_TYPE(state, data) {
      state.productType = data
    },
    SET_EDIT_PRODUCT(state, data) {
      state.product = Object.assign({}, data);
      state.product.is_active = state.product.is_active.toString();
    },
    ADD_PRODUCT(state) {
      state.product = Object.assign({}, state.defaultProduct);
    }
  },
  actions: {
    async GET_ID_PRODUCT({ commit }, id) {
      const response = await axios.get(`/product/${id}/get`).then((response) => {
        let product = response.data.product
        product.type = Number(product.type)
        console.log(product)
        // SET STATE
        commit('SET_EDIT_PRODUCT', product);
        return response;
      })
      return response;
    },
    async GET_PRODUCT({ commit, dispatch }) {
      const respone = await axios.get('/product/get').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_PRODUCT', response.data.Product);
        dispatch('GET_TYPE');
        return response;
      })
      return respone;
    },
    async GET_TYPE({ commit }) {
      await axios.get('/type/get').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_TYPE', response.data.type)
        return response;
      })
    },
    async CREATE_PRODUCT({ dispatch, state }) {
      const response = await axios.post('/product/create', state.product).then((response) => {
        // RE LOAD DATA
        dispatch('GET_PRODUCT');
        return response;
      })
      return response;
    },
    async UPDATE_PRODUCT({ dispatch, state }) {
      const response = await axios.put(`/product/${state.product.id}/update`, state.product).then((response) => {
        // RE LOAD DATA
        dispatch('GET_PRODUCT');
        return response;
      })
      return response;
    },
    async DESTROY_PRODUCT({ dispatch }, id) {
      const response = await axios.delete(`/product/${id}/destroy`).then((response) => {
        // RE LOAD DATA
        dispatch('GET_PRODUCT');
        return response;
      })
      return response;
    },
    async SHOW_PRODUCT({ dispatch }, id) {
      const response = await axios.get(`/product/show/${id}`).then((response) => {
        // RE LOAD DATA
        dispatch('GET_PRODUCT');
        return response;
      })
      return response;
    }
  }
};