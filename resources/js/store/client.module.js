export const client = {
    namespaced: true,
    state: {
        data: [],
        activation: {
            customer_id: "",
            details: "",
            is_active: "",
            activation_line: [
                {
                    activation_id: "",
                    product_id: "",
                    term_id: "5",
                    qty: "",
                    amount: "",
                    period: "",
                    note: "",
                    activated_date: "",
                    expired_date: "",
                    status: "2",
                    is_free: "0",
                    is_notify_email: "0",
                    order_by: "0",
                    is_active: "1"
                }
            ]
        },

    },
    getters: {
        data: state => state.data,
        activation: state => state.activation,

    },
    mutations: {
        SET_PRODUCT(state, data) {
            state.data = data
        },

    },
    actions: {
        async GET_DATA({ commit }, id) {
            const response = await axios.get(`/product`).then((response) => {
                commit('SET_PRODUCT', response.data);
                return response;
            })
            return response;
        },
        async CREATE_DATA({ commit, state }, payload) {
            const response = await axios.post(`/client-create`, state.activation).then((response) => {
                console.log(response)
                return response;
            })
            return response;
        }

    }
};