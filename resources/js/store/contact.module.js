export const contact = {
  namespaced: true,
  state: {
    contacts: [],
    // MODEL
    contact: {
      company_id: "",
      title: "",
      full_name: "",
      phone: "",
      email: "",
      description: "",
      is_active: "1"
    },
    //DEFAULT
    defaultContact: {
      company_id: "",
      title: "",
      full_name: "",
      phone: "",
      email: "",
      description: "",
      is_active: "1"
    }
  },
  getters: {
    contacts: state => state.contacts,
    contact: state => state.contact,
  },
  mutations: {
    SET_CONTACT(state, data) {
      state.contacts = data
    },
    SET_EDIT_CONTACT(state, data) {
      state.contact = Object.assign({}, data);
      state.contact.is_active = state.contact.is_active?.toString();
      state.contact.company_id = state.contact.company_id?.toString();
    },
    ADD_CONTACT(state) {
      state.contact = Object.assign({}, state.defaultContact);
    }
  },
  actions: {
    async GET_ID_CONTACT({ commit }, id) {
      const response = await axios.get(`/contact/${id}/get`).then((response) => {
        // SET STATE
        commit('SET_EDIT_CONTACT', response.data.contact);
        return response;
      })
      return response;
    },
    async GET_CONTACT({ commit }) {
      await axios.get('/contact/get-all').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_CONTACT', response.data.contact)
        return response;
      })
    },
    async CREATE_CONTACT({ dispatch, state }) {
      const response = await axios.post('/contact/create', state.contact).then((response) => {
        // RE LOAD DATA
        dispatch('GET_CONTACT');
        return response;
      })
      return response;
    },
    async UPDATE_CONTACT({ dispatch, state }) {
      const response = await axios.put(`/contact/${state.contact.id}/update`, state.contact).then((response) => {
        // RE LOAD DATA
        dispatch('GET_CONTACT');
        return response;
      })
      return response;
    },
    async DESTROY_CONTACT({ dispatch }, id) {
      const response = await axios.delete(`/contact/${id}/destroy`).then((response) => {
        // RE LOAD DATA
        dispatch('GET_CONTACT');
        return response;
      })
      return response;
    }
  }
};