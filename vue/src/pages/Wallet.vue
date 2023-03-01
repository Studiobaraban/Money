<template>
    <div class="min-h-full">
        <div class="absolute top-4 left-4">
            <div @click="popup = 'categories'" class="text-teal-400 text-xs font-bold">+ КАТЕГОРИИ</div>
        </div>

        <!-- <div class="absolute top-4 right-4">
            <div class="flex text-xs gap-4">
                <div @click="outcome(1)" class="text-teal-400 font-bold">+ ДОХОД</div>
                <div @click="outcome(2)" class="text-pink-400 font-bold">- РАСХОД</div>
            </div>
        </div> -->

        <div class="p-2 pt-10">
            <div class="flex justify-center gap-2">
                <div v-for="user in users" :key="user.id" class="flex items-center w-60 rounded-full border-2 border-white bg-white/50">
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

        <div class="text-3xl text-center mt-4 font-bold text-teal-600">
            {{ parseInt(total).toLocaleString() }}
            <span class="block text-sm text-slate-500 text-center font-light">ИТОГО</span>
        </div>

        <div class="p-2">
            <div class="flex justify-center items-center text-lg my-4 font-light text-slate-500">
                КОШЕЛЬКИ
                <div class="flex justify-center items-center w-5 h-5 ml-2 text-white bg-teal-400 rounded-full" @click="addWallet()">+</div>
            </div>
            <div class="grid grid-cols-4 gap-4 max-sm:grid-cols-2">
                <div v-for="wallet in wallets" :key="wallet.id" class="flex items-center w-full h-15 rounded-full border-2 border-white bg-white/50">
                    <img
                        v-if="wallet?.picture"
                        class="w-14 h-14 object-cover rounded-full"
                        :src="'https://moneyapi.studiobaraban.ru/uploads/user/' + wallet?.picture"
                    />
                    <div
                        v-else
                        class="flex mr-2 items-center justify-center text-left w-14 h-14 text-2xl font-bold rounded-full text-yellow-700/50 bg-yellow-300"
                    >
                        {{ wallet.name.slice(0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold">{{ Number(wallet.balance)?.toLocaleString() }} </span>
                        <span class="text-sm text-slate-500">{{ wallet.name }} {{ wallet.currency }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2 max-sm:hidden"><InOutGraf /></div>

        <div class="p-2">
            <div class="flex items-center justify-center text-lg text-center my-4 font-light text-slate-500">
                <div class="flex justify-center items-center w-5 h-5 mr-2 text-white bg-teal-400 rounded-full" @click="outcome(1)">+</div>
                ТРАНЗАКЦИИ
                <div class="flex justify-center items-center w-5 h-5 ml-2 text-white bg-red-400 rounded-full" @click="outcome(2)">-</div>
            </div>
            <!-- <div class="grid grid-cols-5 text-xs text-slate-400 px-1">
                <span>ДАТА</span>
                <span>КАТЕГОРИЯ</span>
                <span class="col-span-2">ОПИСАНИЕ</span>
                <span class="text-right">СУММА</span>
            </div> -->

            <div
                v-for="transaction in transactions"
                :key="transaction.id"
                class="grid grid-cols-8 items-center text-sm p-1 mb-px bg-white/30 hover:bg-white/50"
            >
                <span class="text-slate-400">{{ moment(transaction.create_at).format("DD.MM") }}</span>
                <img class="w-6 h-6 rounded-full" :src="'https://moneyapi.studiobaraban.ru/uploads/user/u' + transaction.wallet_user + '.jpg'" />
                <div class="col-span-4 leading-4">
                    <span class="block text-slate-400 lowercase text-xs">{{ select.category[transaction.category_id] }}</span>
                    <span>{{ transaction.description }}</span>
                </div>
                <span class="col-span-2 text-right" :class="{ 'text-pink-500': transaction.sum < 0, 'text-teal-500': transaction.sum > 0 }">
                    {{ Number(transaction.sum).toLocaleString() }}
                    <span class="text-slate-400">{{ transaction.currency }}</span>
                </span>
            </div>
        </div>
    </div>

    <template v-if="popup == 'outcome'">
        <div
            class="w-1/2 p-4 min-h-min h-4/5 fixed left-1/2 -translate-x-1/2 top-10 max-h-screen overflow-auto rounded z-50 bg-white shadow-lg max-sm:w-full"
        >
            <h3 v-if="new_transaction.type == 1" class="text-center text-xl m-2">ДОХОД</h3>
            <h3 v-else class="text-center text-xl m-2">РАСХОД</h3>

            <div class="flex flex-col rounded-md items-center border border-white">
                <div class="grid items-center w-full p-4 gap-1">
                    <div v-if="new_transaction.category" @click="deleteSelectedCategory()" class="h-9">
                        <span>{{ new_transaction.category.name }}</span> <span class="text-xs text-pink-500 ml-2">удалить</span>
                    </div>
                    <input
                        v-else
                        class="h-9 p-2 rounded-sm border border-slate-200"
                        type="text"
                        v-model="text_category"
                        @input="findCategory()"
                        placeholder="Категория"
                    />
                    <div v-if="cats">
                        <div v-for="cat in cats.slice(0, 4)" :key="cat.id" class="text-sm py-1 px-2 cursor-pointer hover:bg-teal-100">
                            <span @click="selectCat(cat)">{{ cat.name }}</span>
                        </div>
                    </div>

                    <div v-if="new_transaction.wallet" @click="deleteSelectedWallet()" class="h-9">
                        <span>{{ new_transaction.wallet.name }}</span> <span class="text-xs text-pink-500 ml-2">удалить</span>
                    </div>
                    <input
                        v-else
                        class="h-9 p-2 rounded-sm border border-slate-200 mb-px"
                        type="text"
                        v-model="text_wallet"
                        @input="findWallet()"
                        placeholder="Кошелек"
                    />
                    <div v-if="wals">
                        <div v-for="wal in wals.slice(0, 4)" :key="wal.id" class="flex text-sm py-1 px-2 cursor-pointer hover:bg-teal-100">
                            <span @click="selectWallet(wal)">{{ wal.name }} {{ wal.balance }}</span>
                        </div>
                    </div>

                    <input
                        class="h-9 p-2 rounded-sm border border-slate-200 mb-1"
                        type="text"
                        v-model="new_transaction.name"
                        placeholder="Описание"
                    />

                    <input class="h-9 p-2 rounded-sm border border-slate-200 mb-1" type="text" v-model="new_transaction.sum" placeholder="Сумма" />

                    <div
                        class="h-9 flex justify-center items-center bg-teal-400 text-white text-center rounded-sm cursor-pointer"
                        @click="addTransaction(new_transaction), (popup = false)"
                    >
                        Сохранить
                    </div>
                </div>
            </div>
        </div>
    </template>

    <template v-if="popup == 'categories'">
        <div
            class="w-1/2 p-4 min-h-min h-4/5 fixed left-1/2 -translate-x-1/2 top-10 max-h-screen overflow-auto rounded z-50 bg-white shadow-lg max-sm:w-full"
        >
            <h3 class="text-center text-xl m-2">КАТЕГОРИИ расходов/доходов</h3>

            <div class="grid grid-cols-2 gap-4 max-sm:grid-cols-1">
                <div v-for="group in groups" :key="group.id" class="flex flex-col rounded-md items-center border border-teal-300">
                    <span class="w-full text-center text-lg mb-2 bg-teal-100/50 py-1">{{ group.name }}</span>
                    <div v-for="category in group.categories" :key="category.id">
                        <div class="flex">
                            <span class="text-sm mr-2">{{ category.name }}</span>
                            <span class="text-xs text-pink-400">del</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-5 items-center w-full p-4">
                        <input class="col-span-4 border border-slate-200 rounded-sm" type="text" v-model="category_name" />
                        <div
                            class="bg-teal-400 text-white text-center text-sm rounded-sm cursor-pointer"
                            @click="addCategory({ group_id: group.id, name: category_name })"
                        >
                            +
                        </div>
                    </div>
                </div>

                <div class="flex flex-col rounded-md items-center border border-white">
                    <div class="grid grid-cols-5 items-center w-full p-4">
                        <input class="col-span-4 border border-slate-200 rounded-sm" type="text" v-model="group_name" />
                        <div class="bg-teal-400 text-white text-center text-sm rounded-sm cursor-pointer" @click="addGroup(group_name)">+</div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <div v-if="popup" @click="closePopup()" class="fixed bg-teal-900 z-10 w-screen h-screen top-0 left-0 opacity-50" id="overlay"></div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import moment from "moment";
import InOutGraf from "../components/InOutGraf.vue";

export default {
    name: "WalletPage",

    components: { InOutGraf },

    data() {
        return {
            moment: moment,
            group_id: null,
            group_name: null,
            category_name: null,
            new_transaction: {},
            text_category: null,
            text_wallet: null,
            cats: [],
            wals: [],
            popup: false,
        };
    },

    computed: {
        ...mapGetters(["s", "select", "account", "users", "wallets", "groups", "categories", "transactions", "total"]),
    },

    methods: {
        ...mapActions(["getAccount", "addWallet", "addGroup", "addCategory", "addTransaction"]),

        findCategory() {
            this.cats = this.categories.filter((item) => item.name.toLowerCase().indexOf(this.text_category.toLowerCase()) !== -1);
        },

        findWallet() {
            this.wals = this.wallets.filter((item) => item.name.toLowerCase().indexOf(this.text_wallet.toLowerCase()) !== -1);
        },

        deleteSelectedCategory() {
            this.new_transaction.category = null;
        },

        deleteSelectedWallet() {
            this.new_transaction.wallet = null;
        },

        selectCat(cat) {
            this.new_transaction.category = cat;
            this.text_category = null;
            this.cats = null;
        },

        selectWallet(wallet) {
            this.new_transaction.wallet = wallet;
            this.text_wallet = null;
            this.wals = null;
        },

        outcome(type) {
            this.new_transaction.type = type;
            this.popup = "outcome";
        },

        closePopup() {
            this.popup = false;
        },
    },

    // parseInt(item.id) == parseInt(this.findme.toLowerCase()) ||

    mounted() {
        this.getAccount();
    },
};
</script>
