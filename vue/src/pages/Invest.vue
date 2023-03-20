<template>
    <div class="min-h-full">
        <div class="p-2 pt-10">
            <div class="flex justify-center gap-2">
                <div
                    v-for="user in users"
                    :key="user.id"
                    @click="pickUser(user)"
                    class="flex items-center w-60 rounded-full border-2 border-white bg-white/50"
                    :class="{ '!border-teal-400 bg-teal-300/50': user.id == s.user_id }"
                >
                    <img
                        v-if="user?.picture"
                        class="w-14 h-14 rounded-full mr-4"
                        :src="'https://moneyapi.studiobaraban.ru/uploads/user/' + user?.picture"
                    />
                    <img v-else class="w-14 h-14 mr-4" src="https://moneyapi.studiobaraban.ru/uploads/user/u0.png" />
                    <span>{{ user.name }}<br />{{ user.secondname }}</span>
                </div>
            </div>
        </div>

        <div class="text-3xl text-center mt-4 font-bold text-teal-800/80">
            {{ parseInt(calcTotal / 75).toLocaleString() }} $
            <span class="block text-sm text-teal-800/80 text-center font-light">{{ calcTotal.toLocaleString() }} ₽</span>
        </div>

        <div class="p-2">
            <div class="flex justify-center items-center text-lg my-4 font-light text-teal-800/80">
                <div @click="openInvests()" class="mr-2 fill-teal-500" :class="{ '-rotate-90': !w_opened }"><IcoBig name="down" :size="6" /></div>
                ИНВЕСТИЦИИ
                <div @click="addInvest()" class="ml-2 text-teal-500"><IcoBig name="plus" :size="6" /></div>
            </div>
            <div v-if="w_opened" class="grid grid-cols-4 gap-4 max-sm:grid-cols-2">
                <div
                    v-for="invest in invests"
                    :key="invest.id"
                    @click="pickInvest(invest)"
                    class="flex items-center w-full h-15 rounded-full border-2 border-white bg-white/50"
                    :class="{ '!border-teal-400 bg-teal-300/50': invest.id == s.invest_id }"
                >
                    <img
                        v-if="invest?.picture"
                        class="w-14 h-14 object-cover rounded-full"
                        :src="'https://moneyapi.studiobaraban.ru/uploads/user/' + invest?.picture"
                    />
                    <div
                        v-else
                        class="flex mr-2 items-center justify-center text-left w-14 h-14 text-2xl font-bold rounded-full text-yellow-700/50 bg-yellow-300"
                    >
                        {{ invest.name.slice(0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold">{{ Number(invest.balance)?.toLocaleString() }} </span>
                        <span class="text-sm text-slate-500">{{ invest.name }} {{ invest.currency }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import moment from "moment";

export default {
    name: "InvestPage",

    data() {
        return {
            moment: moment,
            new_transaction: {},
            text_category: null,
            text_invest: null,
            popup: false,
            w_opened: true, // кошельки открыты
        };
    },

    computed: {
        ...mapGetters(["s", "select", "account", "users", "invests", "groups", "categories", "transactions"]),

        calcTotal() {
            let total = 0;
            this.invests?.forEach((item) => {
                if (item.currency == "₽") {
                    total += parseFloat(item.balance);
                }
                if (item.currency == "₹") {
                    total += parseFloat(item.balance) * 0.005;
                }
                if (item.currency == "$") {
                    total += parseFloat(item.balance) * 75;
                }
            });
            return parseInt(total);
        },
    },

    methods: {
        ...mapActions(["getInvest", "addInvest", "addGroup", "addCategory", "addTransaction", "pickUser", "pickInvest"]),

        findCategory() {
            if (this.text_category) {
                this.cats = this.categories.filter((item) => item.name.toLowerCase().indexOf(this.text_category.toLowerCase()) !== -1);
            } else {
                this.cats = this.categories.slice(0, 4);
            }
        },

        findInvest() {
            if (this.text_invest) {
                this.wals = this.invests.filter((item) => item.name.toLowerCase().indexOf(this.text_invest.toLowerCase()) !== -1);
            } else {
                this.wals = this.invests.slice(0, 4);
            }
        },

        selectInvest(invest) {
            this.new_transaction.invest = invest;
            this.text_invest = null;
            this.wals = null;
        },

        openInvests() {
            if (this.w_opened) {
                this.w_opened = false;
            } else {
                this.w_opened = true;
            }
        },
    },

    mounted() {
        this.getInvest();
    },
};
</script>
