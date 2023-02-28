import API from "../../services/api";
import router from "@/router/router";

export default {
    state: {
        account: {},

        users: [],
        usersF: [],
        user: {},

        wallets: [],
        walletsF: [],
        wallet: {},

        transactions: [],
        transactionsF: [],
        transaction: {},
    },

    mutations: {
        setAccount(state, account) {
            state.account = account;
        },

        setUsers(state, users) {
            state.users = users;
            state.usersF = users;
        },
        setUsersF(state, users) {
            state.usersF = users;
        },
        setUser(state, user) {
            state.user = user;
        },

        setWallets(state, wallets) {
            state.wallets = wallets;
            state.walletsF = wallets;
        },
        setWalletsF(state, wallets) {
            state.walletsF = wallets;
        },
        setWallet(state, wallet) {
            state.wallet = wallet;
        },

        setTransactions(state, transactions) {
            state.transactions = transactions;
            state.transactionsF = transactions;
        },
        setTransactionsF(state, transactions) {
            state.transactionsF = transactions;
        },
        setTransaction(state, transaction) {
            state.transaction = transaction;
        },
    },

    actions: {
        getAccount(ctx) {
            API.GET("account/all").then((res) => {
                console.log("getAccount", res.data);
                ctx.commit("setAccount", res.data.account);
                ctx.commit("setUsers", res.data.users);
                ctx.commit("setWallets", res.data.wallets);
            });
        },

        addWallet(ctx) {
            API.GET("account/add-wallet").then((res) => {
                console.log("wallet", res.data);
                ctx.commit("setWallets", res.data.wallets);
            });
        },

        showWallet(ctx, wallet) {
            ctx.dispatch("setWallet", wallet);
            router.push("/wallet/stat");
        },

        setWallet(ctx, wallet) {
            ctx.commit("setWallet", wallet);
            localStorage.setItem("wallet", JSON.stringify(wallet));
        },

        loadWallet(ctx) {
            let wallet = localStorage.getItem("wallet");
            if (wallet) {
                wallet = JSON.parse(wallet);
                ctx.dispatch("setWallet", wallet);
            } else {
                router.push("/wallet");
            }
        },

        findOrder(ctx, s) {
            if (!ctx.state.transactions || !ctx.state.deals) {
                return null;
            }

            let orderList = ctx.state.transactions;

            if (s.findme != "" && s.findme != undefined) {
                orderList = orderList.filter(
                    (item) => parseInt(item.id) == parseInt(s.findme.toLowerCase()) || parseInt(item.level) == parseInt(s.findme.toLowerCase())
                    // || parseInt(item.deal_id) == parseInt(s.findme.toLowerCase())
                );
            }

            if (s.type != "" && s.type != undefined) {
                orderList = orderList.filter((item) => parseInt(item.type) == parseInt(s.type));
            }

            if (s.start != "" && s.start != undefined) {
                orderList = orderList.filter((item) => item.done_at >= s.start + " 00:00:00");
            }

            if (s.end != "" && s.end != undefined) {
                orderList = orderList.filter((item) => item.done_at <= s.end + " 23:59:59");
            }

            if (s.status != "" && s.status != undefined) {
                orderList = orderList.filter((item) => parseInt(item.status) == parseInt(s.status));
            }

            let dealList = ctx.state.deals;

            if (s.findme != "" && s.findme != undefined) {
                dealList = dealList.filter(
                    (item) => parseInt(item.id) == parseInt(s.findme.toLowerCase()) || parseInt(item.level) == parseInt(s.findme.toLowerCase())
                );
            }

            if (s.start != "" && s.start != undefined) {
                dealList = dealList.filter((item) => {
                    let done = null;
                    let date = null;
                    if (item.status == 7) {
                        done = item.done_at >= s.start + " 00:00:00";
                    } else {
                        date = item.date >= s.start + " 00:00:00";
                    }
                    if (done || date) {
                        return true;
                    }
                    return false;
                });
            }

            if (s.end != "" && s.end != undefined) {
                dealList = dealList.filter((item) => {
                    let done = null;
                    let date = null;
                    if (item.status == 7) {
                        done = item.done_at <= s.end + " 23:59:59";
                    } else {
                        date = item.date <= s.end + " 23:59:59";
                    }
                    if (done || date) {
                        return true;
                    }
                    return false;
                });
            }

            if (s.status != "" && s.status != undefined) {
                dealList = dealList.filter((item) => {
                    if (parseInt(s.status) == 3) {
                        return parseInt(item.status) == 2;
                    }
                    return false;
                });
            }

            s.clear = true;

            // list = list.filter((item) => {
            //     console.log("id", item.id);

            //     let id = null;
            //     let level = null;
            //     let deal_id = null;

            //     id = item.id.indexOf(s.findme.toLowerCase()) !== -1;

            //     level = item.level.indexOf(s.findme.toLowerCase()) !== -1;

            //     deal_id = item.deal_id.indexOf(s.findme.toLowerCase()) !== -1;

            //     if (id || level || deal_id) {
            //         return true;
            //     }
            //     return false;
            // });

            ctx.commit("setTransactionsF", orderList);
            ctx.commit("setDealsF", dealList);
            ctx.dispatch("setSettings", s);
        },
    },

    getters: {
        account(state) {
            return state.account;
        },

        users(state) {
            return state.usersF;
        },
        user(state) {
            return state.user;
        },

        wallets(state) {
            return state.walletsF;
        },
        wallet(state) {
            return state.wallet;
        },

        transactions(state) {
            return state.transactionsF;
        },
        transaction(state) {
            return state.transaction;
        },
    },
};
