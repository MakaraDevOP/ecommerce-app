import * as moment from "moment";
export const activation = {
  namespaced: true,
  state: {
    activations: [],
    activationLines: [],
    terms:[],
    // MODEL
    activation: {
      customer_id: "",
      details: "",
      is_active: "",
      activation_line: [
        {
          activation_id: "",
          product_id: "",
          term_id: "5",
          user_no: "",
          period: "",
          note: "",
          activated_date: "",
          expired_date: "",
          status: "1",
          is_free: "0",
          is_notify_email: "0",
          order_by: "0",
          is_active: "1"
        }
      ]
    },
    activationLine: [
      {
        activation_id: "",
        product_id: "",
        term_id: "5",
        user_no: "",
        period: "1",
        note: "test",
        activated_date: "",
        expired_date: "",
        status: "1",
        is_free: "0",
        is_notify_email: "0",
        order_by: "1",
        is_active: "1"
      }],
    //DEFAULT
    defaultActivation: {
      customer_id: "",
      details: "",
      is_active: "",
      activation_line: [
        {
          activation_id: "",
          product_id: "",
          term_id: "5",
          user_no: "",
          period: "",
          note: "",
          activated_date: "",
          expired_date: "",
          status: "1",
          is_free: "0",
          is_notify_email: "0",
          order_by: "0",
          is_active: "1"
        }
      ]
    },
    defaultActivationLine: [{
      activation_id: "",
      product_id: "",
      term_id: "5",
      user_no: "",
      period: "",
      note: "",
      activated_date: "",
      expired_date: "",
      status: "1",
      is_free: "0",
      is_notify_email: "0",
      order_by: "1",
      is_active: "1"
    }]
  },
  getters: {
    activations: state => state.activations,
    activationLines: state => state.activationLines,
    terms: state => state.terms,
    // Data
    activation: state => state.activation,
    activationLine: state => state.activationLine
  },
  mutations: {
    SET_ACTIVATION(state, data) {
      state.activations = data
    },
    SET_TERM(state, data) {
      data.forEach(d => {
        d.id =d.id.toString()
      })
      state.terms =data
    },
    SET_ACTIVATION_LINE(state, data) {

      state.activationLines = data
    },
    SET_EDIT_ACTIVATION(state, data) {
      // CLEAR OBJECT
      state.activation = [];
      //ASSIGN OBJECT
      state.activation = Object.assign({}, data);
      state.activation.is_active = state.activation.is_active?.toString();
      state.activation?.activation_line.forEach(element => {
        element.term_id = element.term_id?.toString();
        element.is_free = element.is_free?.toString();
        element.status = element.status?.toString();
      });
    },
    ADD_ACTIVATION(state) {
      const objClone = { ...state.defaultActivation };
      state.activation = JSON.parse(JSON.stringify(objClone)) 
    },
    ADD_ACTIVATION_LINE(state) {
      // state.activation.activation_line = [...state.activation.activation_line, state.defaultActivationLine[0]]
      const objClone = { ...state.defaultActivationLine[0] };
      state.activation.activation_line = [...state.activation.activation_line, JSON.parse(JSON.stringify(objClone)) ]
    },
    SET_DATE_ACTIVATION(state) {
      state.activation?.activation_line.forEach(element => {
        var ex = new Date(element.expired_date);
        var ac = new Date(element.activated_date);
        element.expired_date = moment(ex.toLocaleDateString("en-US")).format("DD-MMM-YYYY"); 
        element.activated_date = moment(ac.toLocaleDateString("en-US")).format("DD-MMM-YYYY"); 
      });
    },
    REMOVE_ACTIVATION_LINE(state, payload) {
      state.activation.activation_line.forEach((element, i) => {
        if (payload == i) {
          state.activation.activation_line.splice(i, 1);
        }
      })
    } 

  },
  actions: {
    async GET_ID_ACTIVATION({ commit }, id) {
      const response = await axios.get(`/activation/${id}/get`).then((response) => {
        // SET STATE
        commit('SET_EDIT_ACTIVATION', response.data?.activation[0]);
        console.log(response.data?.activation[0])
        return response;
      })
      return response;
    },
    async GET_ACTIVATION({ commit ,dispatch}) {
      await axios.get('/activation/get-all').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_ACTIVATION', response.data.activation);
        dispatch('GET_TERM');
        return response;
      })
    },
    async GET_TERM({ commit }) {
      await axios.get('/term/get').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_TERM', response.data.term)
        return response;
      })
    },
    async GET_ACTIVATION_LINE({ commit }) {
      await axios.get('/activation-line/get').then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_ACTIVATION_LINE', response.data.activation_line)
        return response;
      })
    },
    async CREATE_ACTIVATION({ dispatch, commit,state }) {
      commit('SET_DATE_ACTIVATION');
      const response = await axios.post('/activation/create', state.activation).then((response) => {
        // RE LOAD DATA
        dispatch('GET_ACTIVATION');
        commit('ADD_ACTIVATION');
        return response;
      })
      return response;
    },
    async UPDATE_ACTIVATION({ dispatch,commit, state }) {
            commit('SET_DATE_ACTIVATION');
      const response = await axios.put(`/activation/${state.activation.id}/update`, state.activation).then((response) => {
        // RE LOAD DATA
        dispatch('GET_ACTIVATION');
        return response;
      })
      return response;
    },
    async DESTROY_ACTIVATION({ dispatch }, id) {
      const response = await axios.delete(`/contact/${id}/destroy`).then((response) => {
        // RE LOAD DATA
        dispatch('GET_ACTIVATION');
        return response;
      })
      return response;
    }
  }
};