export const note = {
  namespaced: true,
  state: {
    notes: [],
    noteLine:[],
    // MODEL
    note: {
      user_id: "",
      activation_id: "",
      activation_line_id: "",
      title: "",
      body: ""
    },
    // DEFAULT
    defaultNote: {
      user_id: "",
      activation_id: "",
      activation_line_id: "",
      title: "",
      body: ""
    }
  },
  getters: {
    notes: state => state.notes,
    note_line: state => state.note_line,
    model_note: state => state.note,
    noteLine:state =>state.noteLine
  },
  mutations: {
    SET_DATAID(state, data) {
      state.note.activation_id = data.activation_id,
      state.note.activation_line_id = data.activation_line_id,
      state.note.user_id = data.user_id
    },
    SET_NOTE(state, data) {
      state.notes = data
    },
    POST_NOTE(state) {
      var objClone = { ...state.note };
      objClone.body = "";
      state.note= JSON.parse(JSON.stringify(objClone)) 
     
    },
    SET_NOTELINE(state, data) {
      state.noteLine =data
    }
  },
  actions: {
    async GET_ID_NOTE({ commit}, id) {
      const response = await axios.get(`/note/${id}/get`).then((response) => { // SET STATE
        commit('SET_EDIT_NOTE', response.data.note);
        return response;
      })
      return response;
    },
    async GET_NOTE({commit }, id) {
      const response = await axios.get(`/note/get`).then((response) => { // SET STATE
        commit('SET_NOTE', response.data.note);
        return response;
      })
      return response;
    },
    async GET_NOTE_ACTIVATIONID_ACTIVATIONLINEID({commit},payload) {
      const response = await axios.get(`note/get/activation/${payload.activation_id}/activation-line/${payload.activation_line_id}`).then((response) => {
              // SET STATE
        commit('SET_NOTELINE', response.data.note);
        return response;
      })
     
    },
    async CREATE_NOTE({commit}, state) {
         const response = await axios.post(`note/create`,state.note ).then((response) => {
        // SET STATE
        commit('POST_NOTE');
        return response;
      })
    }
  }
};
