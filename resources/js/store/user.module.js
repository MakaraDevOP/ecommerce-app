export const user = {
    namespaced: true,
    state: {
        users: [],
    },
    mutations: {
        storeUsers(state, value) {
            state.users = value;
        },
    },
    actions: {
        async fetchUsers({ commit }) {
            const response = await axios
                .get("/user/get")
                .then((resp) => {
                    commit("storeUsers", resp.data);
                    return resp;
                });
            return response;
        },

        async addNew() {
            const response = await axios
                .get("/user/create")
                .then((resp) => {
                    return resp;
                });
            return response;
        },
    },
    getters: {
        list: (state) => state.users,
    },
};
