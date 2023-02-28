<template>
    <div class="fixed z-50 w-full h-12 bg-cyan-500 block md:hidden">
        <a class="block w-10 h-10 my-1 mx-auto rounded-full overflow-hidden relative cursor-pointer" @click="$router.push('/profile')">
            <img
                v-if="profile?.picture"
                class="w-full h-full object-cover"
                :src="'https://tradingapi.studiobaraban.ru/uploads/users/mini/' + profile?.picture"
            />
        </a>
    </div>

    <div class="fixed flex-none w-32 h-screen bg-gradient-to-b from-cyan-400 via-cyan-200 to-sky-400 hidden md:block">
        <a
            class="block w-24 h-24 my-4 mx-auto rounded-lg border-2 border-slate-100 overflow-hidden relative cursor-pointer"
            @click="$router.push('/profile')"
        >
            <img
                v-if="profile?.picture"
                class="w-full h-full object-cover"
                :src="'https://tradingapi.studiobaraban.ru/uploads/users/mini/' + profile?.picture"
            />
        </a>
        <ul class="p-2 text-center text-sm">
            <li>
                <a @click="$router.push('/bot')" class="w-full block items-center py-5 text-xs text-white cursor-pointer">Боты</a>
            </li>
            <li>
                <a @click="$router.push('/simulation')" class="w-full block items-center py-5 text-xs text-white cursor-pointer">Симуляция</a>
            </li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    name: "BotMenu",

    data() {
        return {};
    },

    computed: {
        ...mapGetters(["profile"]),
    },
};
</script>
