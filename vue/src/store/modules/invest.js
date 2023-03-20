import API from "../../services/api";
import router from "@/router/router";

export default {
    state: {
        invests: [],
        investsF: [],
        invest: {},

        transactions: [],
        transactionsF: [],
        transaction: {},
    },

    mutations: {
        setInvests(state, invests) {
            state.invests = invests;
            state.investsF = invests;
        },
        setInvestsF(state, invests) {
            state.investsF = invests;
        },
        setInvest(state, invest) {
            state.invest = invest;
        },
    },

    actions: {
        getInvest(ctx) {
            API.GET("account/invest-all").then((res) => {
                console.log("getInvest", res.data);
                ctx.commit("setInvests", res.data.invests);
            });
        },

        addInvest(ctx) {
            API.GET("account/add-invest").then((res) => {
                console.log("invest", res.data);
                ctx.commit("setInvests", res.data.invests);
            });
        },

        showInvest(ctx, invest) {
            ctx.dispatch("setInvest", invest);
            router.push("/invest/stat");
        },

        setInvest(ctx, invest) {
            ctx.commit("setInvest", invest);
            localStorage.setItem("invest", JSON.stringify(invest));
        },

        pickInvest(ctx, invest) {
            if (ctx.state.invest?.id == invest.id) {
                ctx.dispatch("unpickInvest");
                return;
            }
            ctx.commit("setInvest", invest);
            ctx.rootState.s.invest_id = invest.id;
            ctx.commit("setSettings", ctx.rootState.s);

            let transactionsF = ctx.state.transactions.filter((item) => item.invest_id == invest.id);
            ctx.commit("setTransactionsF", transactionsF);
        },

        unpickInvest(ctx) {
            ctx.commit("setInvest", null);
            ctx.rootState.s.invest_id = null;
            ctx.commit("setSettings", ctx.rootState.s);
            ctx.commit("setTransactionsF", ctx.state.transactions);
        },
    },

    getters: {
        invests(state) {
            return state.investsF;
        },
        invest(state) {
            return state.invest;
        },
    },
};
