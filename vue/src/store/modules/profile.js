import API from "../../services/api";
import axios from "axios";
import router from "@/router/router";

export default {
    state: {
        menu: {},
        profile: {},
    },

    mutations: {
        menu: (state, menu) => {
            state.menu = menu;
        },
        profile: (state, profile) => {
            state.profile = profile;
        },
    },

    actions: {
        login(ctx, data) {
            console.log("Login");
            let formData = new FormData();
            formData.append("username", data.username);
            formData.append("password", data.password);
            axios.post("https://moneyapi.studiobaraban.ru/site/login", formData).then((res) => {
                // axios.post("http://localhost/site/login", formData).then((res) => {
                console.log(res.data);
                if (res.data && res.data.token) {
                    localStorage.setItem("AUTH", res.data.token);
                    ctx.commit("profile", res.data.profile);
                    ctx.commit("menu", res.data.menu);
                    router.push("/wallet");
                }
            });
        },

        logout(ctx) {
            localStorage.removeItem("AUTH");
            localStorage.removeItem("profile");
            ctx.commit("profile", null);
            ctx.commit("menu", null);
            router.push({ name: "Login" });
        },

        getProfile(ctx) {
            API.GET("profile/profile").then((res) => {
                console.log("getProfile", res.data);
                if (res.data.profile) {
                    ctx.commit("profile", res.data.profile);
                    ctx.commit("menu", res.data.menu);
                } else {
                    ctx.commit("profile", null);
                    router.push("/login");
                }
            });
        },
    },

    getters: {
        menu(state) {
            return state.menu;
        },
        profile(state) {
            return state.profile;
        },
    },
};
