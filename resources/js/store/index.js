import { createStore } from "vuex";
import axios from "axios";
export default createStore({
    state() {
        return { categories: [] };
    },
    getters: {
        getCategories: (state) => state.categories,
    },
    actions: {
        loadCategories({ commit }) {
            axios
                .get("categories/all")
                .then((res) => {
                    commit("SAVE_CATEGORIES", res.data.data);
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
    mutations: {
        SAVE_CATEGORIES(state, payload) {
            state.categories = payload;
        },
    },
});
