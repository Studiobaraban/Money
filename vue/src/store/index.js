import { createStore } from "vuex";
import API from "../services/api";
import moment from "moment";

import profile from "./modules/profile";
import invest from "./modules/invest";
import wallet from "./modules/wallet";

export default createStore({
    modules: {
        profile,
        invest,
        wallet,
    },

    state: {
        alert: {},
        popup: false,

        select: {
            category: [],
            month: ["", "Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
            monthMin: ["", "января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря"],
            weekday: ["", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
        },

        s: {
            user_id: null,
            wallet_id: null,
            status: null,
            findme: null,
            category: null,
            type: null,
            month: moment().startOf("month").format("YYYY-MM-DD"),
            start: null,
            end: null,
            popup: null,
            clear: null,
        },
    },

    mutations: {
        setAlert: (state, alert) => {
            state.alert = alert;
        },
        setSelect: (state, masters) => {
            state.select_masters = masters;
        },
        setSettings(state, s) {
            state.s = s;
        },
    },

    actions: {
        setSettings(ctx, s) {
            localStorage.setItem("s", JSON.stringify(s));
            ctx.commit("setSettings", s);
        },

        loadSettings(ctx) {
            let s = localStorage.getItem("s");
            if (s) {
                ctx.commit("setSettings", JSON.parse(s));
            }
        },

        clearSettings(ctx) {
            localStorage.removeItem("s");
            let s = {
                user_id: null,
                wallet_id: null,
                status: null,
                findme: null,
                category: null,
                type: null,
                month: moment().startOf("month").format("YYYY-MM-DD"),
                start: null,
                end: null,
                popup: null,
                clear: null,
            };
            ctx.commit("setSettings", s);
        },

        getSelects(ctx) {
            console.log("getSelects");
            API.GET("profile/selects").then((res) => {
                ctx.commit("setSelect", res.data.workers);
            });
        },
    },

    getters: {
        alert(state) {
            return state.alert;
        },
        select(state) {
            return state.select;
        },
        selectMonth(state) {
            return state.select_month;
        },
        selectMonthMin(state) {
            return state.select_monthMin;
        },
        selectWeekDay(state) {
            return state.select_weekday;
        },
        popup(state) {
            return state.popup;
        },
        s(state) {
            return state.s;
        },
    },
});
