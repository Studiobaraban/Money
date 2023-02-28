<template>
    <div class="flex h-screen min-h-screen">
        <div class="w-1/2 bg-gradient-radial from-cyan-300 to-sky-600 relative">
            <h1 class="block absolute top-1/2 left-1/2 -translate-x-28 -translate-y-24 text-9xl text-center text-white font-latobold">
                Bot <span class="block text-4xl">teach me</span>
            </h1>
            <p class="w-full absolute bottom-8 text-white text-xs text-center mt-24 max-l:hidden">© 2019 - 2022</p>
        </div>

        <div class="w-1/2 bg-white">
            <!-- <div class="flex flex-col justify-center items-center mt-20">
                <div class="w-fit py-2 px-4 rounded bg-sky-500 hover:bg-sky-400 cursor-pointer text-white font-latobold text-base">Создать бота</div>
            </div> -->

            <div class="px-4 mt-8 mx-auto bg-white rounded-lg max-w-xl w-full">
                <div class="v-bbgray p-5 text-center">
                    <span class="mx-auto flex-cc profile_img w-16 h-16 bg-[#42b6f8] font-white before:w-16 before:h-16">
                        <svg class="w-7 h-7 fill-white"><use xlink:href="@/assets/i.svg#nav-masters"></use></svg>
                    </span>

                    <div class="flex justify-center text-lg uppercase font-latobold">
                        <div class="text-gray-400 cursor-pointer mr-4" :class="{ '!text-sky-600': form == 'login' }" @click="form = 'login'">
                            Вход
                        </div>
                        <div class="text-gray-400 cursor-pointer" :class="{ '!text-sky-600': form == 'reg' }" @click="form = 'reg'">Регистрация</div>
                    </div>
                </div>
                <div class="p-5">
                    <form v-if="form == 'login'">
                        <div class="mb-4">
                            <input type="text" class="text-sky-600 w-full border px-5 h-9 text-sm rounded" v-model="username" placeholder="Логин" />
                        </div>
                        <div class="mb-4">
                            <input
                                type="password"
                                autocomplete="on"
                                class="text-sky-600 w-full border px-5 h-9 text-sm rounded"
                                v-model.trim="password"
                                placeholder="Пароль"
                                @keyup.enter="login({ username: username, password: password })"
                            />
                        </div>

                        <div
                            class="mx-auto block v-btn group bg-sky-500 hover:bg-sky-400 rounded duration-300 transition-colors ease-out px-5 py-3 h-9"
                        >
                            <div
                                class="text-sm font-latobold leading-none uppercase text-white flex items-center"
                                @click="login({ username: username, password: password })"
                            >
                                Войти
                            </div>
                        </div>
                    </form>

                    <form v-if="form == 'reg'">
                        <div class="mb-4">
                            <input type="text" class="text-sky-600 w-full border px-5 h-9 text-sm rounded" v-model="name" placeholder="Имя" />
                        </div>
                        <div class="mb-4">
                            <input type="text" class="text-sky-600 w-full border px-5 h-9 text-sm rounded" v-model="username" placeholder="Email" />
                        </div>
                        <div class="mb-4">
                            <input
                                type="password"
                                autocomplete="on"
                                class="text-sky-600 w-full border px-5 h-9 text-sm rounded"
                                v-model.trim="password"
                                placeholder="Пароль"
                                @keyup.enter="reg({ name: name, username: username, password: password })"
                            />
                        </div>

                        <div
                            class="mx-auto block v-btn group bg-sky-500 hover:bg-sky-400 rounded duration-300 transition-colors ease-out px-5 py-3 h-9"
                        >
                            <div
                                class="text-sm font-latobold leading-none uppercase text-white flex items-center"
                                @click="reg({ name: name, username: username, password: password })"
                            >
                                Регистрация
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "MainPage",

    data() {
        return {
            form: "login",
            name: null,
            email: null,
            username: null,
            password: null,
        };
    },

    computed: {
        ...mapGetters(["alerts"]),
    },

    methods: {
        ...mapActions(["login", "reg"]),
    },
};
</script>
