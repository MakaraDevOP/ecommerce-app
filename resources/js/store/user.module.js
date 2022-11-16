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
                    commit("storeUsers", resp.data.users);
                    return resp;
                });
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

        async store({commit}, request){

            const response = await axios
                .post("/user/store", request)
                .then((resp) => {
                    return resp;
                });
            return response;
        }
    },
    getters: {
        list: (state) => state.users,
    },
};
