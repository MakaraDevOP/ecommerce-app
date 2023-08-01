export const user = {
    namespaced: true,
    state: {
        users: [],
    },
    mutations: {
        storeUsers: (state, value) => state.users = value,
    },
    actions: {
        async fetchUsers({ commit }) {
            const response = await axios
                .get("/user/get")
                .then((resp) => {
                    commit("storeUsers", resp.data.users);
                    return resp;
                }).catch((error) => {
                    commit('auth/CLEAR_TOKEN', null, { root: true });
                })
            return response;
        },

        async create() {
            const response = await axios
                .get("/user/create")
                .then((resp) => {
                    return resp;
                });
            return response;
        },

        async store({ commit }, formdate) {

            const response = await axios
                .post("/user/store", formdate)
                .then((resp) => {
                    return resp;
                });
            return response;
        },

        async edit({ commit }, id) {
            const response = await axios
                .get(`/user/${id}/edit`)
                .then((resp) => {
                    return resp.data;
                });
            return response;
        },

        async update({ commit }, formdate) {
            var id = formdate?.id

            const response = await axios
                .put(`/user/${id}/update`, formdate)
                .then((resp) => {
                    return resp;
                });
            return response;
        },

        async destroy({ commit }, id) {
            const response = await axios
                .delete(`/user/${id}/destroy`)
                .then((resp) => {
                    return resp.data;
                });
            return response;
        },
        async viewProfile() {

        }
    },
    getters: {
        list: (state) => state.users,
    },
};
