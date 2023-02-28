<template>
    <div class="min-h-full bg-gradient-to-tr from-cyan-200 via-cyan-100/50 to-sky-200 max-xl:flex-col">
        <!-- <div class="p-5 v-bbgray">
            <h2 class="uppercase text-center text-xl font-latobold">Аккаунт</h2>
            <div class="flex text-base text-zinc-800 font-latobold flex-col items-center">
                {{ account?.name }}
            </div>
        </div> -->

        <div class="p-5 v-bbgray">
            <div class="flex justify-center text-lg font-latobold mb-4">ПОЛЬЗОВАТЕЛИ</div>
            <div class="flex justify-center gap-4">
                <div v-for="user in users" :key="user.id" class="flex items-center w-60 rounded-full border-2 border-white bg-white/50">
                    <img v-if="user?.picture" class="w-20 h-20 rounded-full mr-4" :src="'http://localhost/uploads/user/' + user?.picture" />
                    <img v-else class="w-20 h-20 mr-4" src="http://localhost/uploads/user/u0.png" />
                    <span>{{ user.name }}<br />{{ user.secondname }}</span>
                </div>
            </div>
        </div>

        <div class="p-5 v-bbgray">
            <div class="flex justify-center text-lg font-latobold mb-4">КОШЕЛЬКИ</div>
            <div class="flex justify-center gap-4">
                <div v-for="wallet in wallets" :key="wallet.id" class="flex items-center w-60 rounded-full border-2 border-white bg-white/50">
                    <img
                        v-if="wallet?.picture"
                        class="w-20 h-20 object-cover rounded-full"
                        :src="'http://localhost/uploads/user/' + wallet?.picture"
                    />
                    <div v-else class="flex mr-4 items-center justify-center text-left w-20 h-20 text-4xl rounded-full bg-yellow-300">
                        {{ wallet.name.slice(0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-latobold">{{ wallet.balance?.toLocaleString() }} {{ wallet.currency }}</span>
                        <span class="text-sm">{{ wallet.name }}</span>
                    </div>
                </div>

                <div class="flex items-center w-60 rounded-full border-2 border-white bg-white/50" @click="addWallet()">
                    <div class="flex mr-4 items-center justify-center text-left w-20 h-20 text-4xl rounded-full bg-yellow-300">+</div>
                    <div class="flex flex-col">
                        <span class="text-sm">Добавить</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "WalletPage",

    computed: {
        ...mapGetters(["s", "account", "users", "wallets"]),
    },

    methods: {
        ...mapActions(["getAccount", "addWallet"]),
    },

    mounted() {
        this.getAccount();
    },
};
</script>
