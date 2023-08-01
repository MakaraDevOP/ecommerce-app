export const customer = {
  namespaced: true,
  state: {
    customers: [],
    // MODEL
    customer: {
      company_name: "",
      province_city: "",
      detail_address: "",
      is_active: "1",
      phone: "",
      email: "",
      password: "",
      parent_company_id: ""
    },
    //DEFAULT
    defaultCustomer: {
      company_name: "",
      province_city: "",
      detail_address: "",
      is_active: "1",
      phone: "",
      email: "",
      password: "",
      parent_company_id: ""
    }
  },
  getters: {
    customers: state => state.customers,
    customer: state => state.customer,
  },
  mutations: {
    SET_CUSTOMER(state, data) {
      state.customers = data
    },
    SET_EDIT_CUSTOMER(state, data) {
      state.customer = Object.assign({}, data);
      state.customer.parent_company_id = state.customer.parent_company_id?.toString();
      state.customer.is_active = state.customer.is_active.toString();
    },
    ADD_CUSTOMER(state) {
      state.customer = Object.assign({}, state.defaultCustomer);
      state.customer.parent_company_id = state.customer.parent_company_id?.toString();
      state.customer.is_active = state.customer.is_active.toString();
    }
  },
  actions: {
    async GET_ID_CUSTOMER({ commit }, id) {
      const response = await axios.get(`/customer/${id}/get`).then((response) => {
        // SET STATE
        commit('SET_EDIT_CUSTOMER', response.data.customer);
        return response;
      }).catch((error) => {
        commit('auth/CLEAR_TOKEN', null, { root: true });
      })
      return response;
    },
    async GET_CUSTOMER({ commit }) {
      await axios.get('/customer/get').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_CUSTOMER', response.data.customer)
        return response;
      })
    },
    async CREATE_CUSTOMER({ dispatch, state }) {
      const response = await axios.post('/customer/create', state.customer).then((response) => {
        // RE LOAD DATA
        dispatch('GET_CUSTOMER');
        return response;
      })
      return response;
    },
    async UPDATE_CUSTOMER({ dispatch, state }) {
      const response = await axios.put(`/customer/${state.customer.id}/update`, state.customer).then((response) => {
        // RE LOAD DATA
        dispatch('GET_CUSTOMER');
        return response;
      })
      return response;
    },
    async DESTROY_CUSTOMER({ dispatch }, id) {
      const response = await axios.delete(`/customer/${id}/destroy`).then((response) => {
        // RE LOAD DATA
        dispatch('GET_CUSTOMER');
        return response;
      })
      return response;
    }
  }
};