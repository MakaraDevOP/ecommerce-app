export const activation = {
  namespaced: true,
  state: {
    activations: [],
    // MODEL
    activation: {

    },
    //DEFAULT
    defaultActivation: {

    }
  },
  getters: {
    activations: state => state.activations,
    activation:state=>state.activation,
  },
  mutations: {
    SET_ACTIVATION(state , data) {
      state.activations =data
    },
    SET_EDIT_ACTIVATION(state, data) {
      state.contact = Object.assign({}, data);
    },
    ADD_ACTIVATION(state) {
        state.contact = Object.assign({}, state.defaultActivation);
    }
  },
  actions: {
    async GET_ID_ACTIVATION({ commit },id) {
      const response = await axios.get(`/contact/${id}/get`).then((response) => {
        // SET STATE
        commit('SET_EDIT_ACTIVATION', response.data.contact);
        return response;
        })
      return response;
    },
    async GET_ACTIVATION({ commit }) {
      await axios.get('/activation/get-all').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_ACTIVATION', response.data.activation)
        return response;
      })
    },
    async CREATE_ACTIVATION({dispatch ,state}) {
      const response = await axios.post('/contact/create', state.contact).then((response) => {
        // RE LOAD DATA
        dispatch('GET_ACTIVATION');
        return response;
        })
      return response;
    },
    async UPDATE_ACTIVATION({ dispatch ,state}) {
      const response = await axios.put(`/contact/${state.contact.id}/update`,  state.contact).then((response) => {
        // RE LOAD DATA
        dispatch('GET_ACTIVATION');
        return response;
        })
      return response;
    },
    async DESTROY_ACTIVATION({dispatch},id) {
      const response = await axios.delete(`/contact/${id}/destroy`).then((response) => {
        // RE LOAD DATA
        dispatch('GET_ACTIVATION');
        return response;
        })
      return response;
    }
  }
};