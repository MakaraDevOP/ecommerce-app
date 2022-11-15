
// import axios from "axios";
export const auth = {
  namespaced: true,
  state: {
    LOGGINED: JSON.parse(localStorage.getItem('logined'))??false,
    TOKEN: JSON.parse(localStorage.getItem('token'))??'',
    USER: JSON.parse(localStorage.getItem('user'))??'',
  },
  getters: {
    user:state=>state.USER
  },
  mutations: {
    //LOGIN 
    SET_TOKEN(state, value) {
      //SET SATE
      state.TOKEN = value.token;
      state.USER = value.user;
      state.LOGGINED = true;
      //LOCAL STORE
      localStorage.setItem('token', JSON.stringify(state.TOKEN));
      localStorage.setItem('user', JSON.stringify(state.USER));
      localStorage.setItem('logined', JSON.stringify(state.LOGGINED));
    },
    // LOGOUT
    CLEAR_TOKEN() {
      
    }
  },
  actions: {
    // LOGIN 
    async LOGIN_SYSTEM({commit}, payload) {
      const response = await axios.post('/login', payload).then(resp => {
        // SET STATE AND LOCAL STORE
        commit('SET_TOKEN', resp.data)
        return resp;
      });
      return response;
    },
    async LOGOUT_SYSTEM({ commit }) {
      await axios.post('/logout', payload).then((response) => {
        // SET STATE AND LOCAL STORE
        commit('SET_TOKEN', response.data)
        return response;
      })
    }
  }
};