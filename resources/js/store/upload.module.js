import router from '../router'
export const upload = {
  namespaced: true,
  state: {
    dataFile: [],
  },
  getters: {
    upload_file: state => state.dataFile
  },
  mutations: {
    SET_UPLOAD_FILE(state, data) {
      state.dataFile = data;
    }
  },
  actions: {
    async GET_UPLOAD_ACTIVATIONID({ commit }, id) {
      const response = await axios.get(`/files/get/upload/${id}`).then((response) => {
        // SET STATE
        commit('SET_UPLOAD_FILE', response.data.file);
        return response;
      });
    },
    async UPLOAD_FILE({ commit }, payload) {
      const myHeaders = new Headers();
      myHeaders.append('Authorization', "Bearer " + JSON.parse(localStorage.getItem("token")) ?? '');
      myHeaders.append('Content-Type', "multipart/form-data;charset=utf-8; boundary=" + Math.random().toString().substr(2));
      const response = await axios.post(`/files/create/upload/${payload.id}`, payload.data, { headers: myHeaders }).then((response) => {
        // SET STATE
        // commit('SET_UPLOAD_FILE', response.data.file);
        return response;
      });
    },
    PREVIEW_DOC({ commit }, payload) {
      axios.get(`/files/storage/${payload}`).then((response) => {
        if (response) {

          let link = document.createElement('a');
          var bytes = new Uint8Array(response.data.length / 2);

           for (var i = 0; i < response.data.length; i += 2) {
              bytes[i / 2] = parseInt(dataFile.data.substring(i, i + 2), /* base = */ 16);
          }

            // Make a Blob from the bytes
          var blob = new Blob([bytes], { type: 'image/bmp' });
          this.preview = URL.createObjectURL(blob);
          console.log(this.preview)
          
          // window.open("/preview", '_blank');
          // var data = JSON.stringify(response);
          // router.push({
          //   path: '/preview',
          //   query: {
          //     myProperty: data
          //   }
          // })
        }
        return response;
      });
    }
  }
}
