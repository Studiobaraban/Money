<template>
    <div class="justify-around items-center w-full h-10 hidden max-sm:flex">
        <a class="block w-8 h-8 my-1 rounded-full overflow-hidden relative cursor-pointer" @click="$router.push('/profile')">
            <img
                v-if="profile?.picture"
                class="w-full h-full object-cover"
                :src="'https://moneyapi.studiobaraban.ru/uploads/user/mini/' + profile?.picture"
            />
        </a>
        <ul class="flex items-center text-white p-2 text-sm gap-x-8">
            <li>
                <a @click="$router.push('/wallet')" class="cursor-pointer">Деньги</a>
            </li>
            <li>
                <a @click="$router.push('/wallet')" class="cursor-pointer">Бизнес</a>
            </li>
            <li>
                <a @click="$router.push('/wallet')" class="cursor-pointer">Инвестиции</a>
            </li>
        </ul>
    </div>

    <div class="fixed flex-none w-32 h-screen max-sm:hidden">
        <a
            class="block w-24 h-24 my-4 mx-auto rounded-lg border-2 border-slate-100 overflow-hidden relative cursor-pointer"
            @click="$router.push('/profile')"
        >
            <img
                v-if="profile?.picture"
                class="w-full h-full object-cover"
                :src="'https://moneyapi.studiobaraban.ru/uploads/user/mini/' + profile?.picture"
            />
        </a>
        <ul class="p-2 text-center text-sm">
            <li>
                <a @click="$router.push('/wallet')" class="w-full block py-5 cursor-pointer">Деньги</a>
            </li>
            <li>
                <a @click="$router.push('/wallet')" class="w-full block py-5 cursor-pointer">Бизнес</a>
            </li>
            <li>
                <a @click="$router.push('/wallet')" class="w-full block py-5 cursor-pointer">Инвестиции</a>
            </li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "NavMenu",

    data() {
        return {};
    },

    computed: {
        ...mapGetters(["profile"]),
    },
};
</script>
