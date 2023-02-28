<template>
    <!-- bg-slate-100 -->
    <!-- <div class="flex min-h-full bg-gradient-radial from-cyan-200 via-purple-200 to-sky-200 max-xl:flex-col"> -->
    <div class="flex min-h-full bg-gradient-to-tr from-cyan-200 via-purple-100/0 to-sky-200 max-xl:flex-col">
        <div class="w-96 my-4 rounded max-l:mx-auto">
            <div class="p-5 v-bbgray">
                <h2 class="uppercase text-center text-xl font-latobold">Профиль</h2>
            </div>

            <div class="p-5 v-bbgray">
                <div class="flex text-base text-zinc-800 font-latobold flex-col items-center">
                    <div class="w-48 h-48 my-5 mx-auto rounded-full bg-sky-500 overflow-hidden relative">
                        <span class="w-full h-full group">
                            <input
                                type="file"
                                id="avatar"
                                class="absolute invisible opacity-0"
                                multiple
                                @change="uploadImg({ e: $event, type: 'author', id: author.user_id })"
                            />
                            <label
                                for="avatar"
                                class="w-1/2 h-1/2 flex items-center justify-center rounded-full absolute -top-10 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-20 group-hover:bg-black group-hover:opacity-50 group-hover:top-1/2"
                            >
                                <svg class="fill-white w-5 h-5">
                                    <use xlink:href="@/assets/i.svg#ico-edit"></use>
                                </svg>
                            </label>
                            <img
                                v-if="author?.picture"
                                class="w-full h-full object-cover"
                                :src="'https://api.botteach.me/users/mini/' + author?.picture"
                            />
                            <img v-else class="w-full h-full object-cover" src="https://api.botteach.me/users/mini/u0.png" />
                        </span>
                    </div>

                    {{ author.name }} {{ author.secondname }}
                </div>
                <div class="flex">
                    <!-- <a class="mx-auto mt-4 v-btn bg-sky-500 hover:bg-sky-400 transition-colors duration-150" @click="editProfile">
                        <svg class="fill-white w-16px h-16px mr-3">
                            <use xlink:href="@/assets/i.svg#ico-edit"></use>
                        </svg>
                        <span class="v-btn_text">РЕДАКТИРОВАТЬ</span>
                    </a> -->
                    <a class="mx-auto mt-4 v-btn bg-rose-500 hover:bg-rose-400 transition-colors duration-150" @click="logout()">
                        <span class="v-btn_text">ВЫХОД</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- <div class="flex flex-col ml-4 mt-4 flex-1">
            <div class="bg-white rounded mb-4 flex flex-wrap">
                <div class="w-full p-5 v-bbgray">
                    <h2 class="uppercase text-lg font-latobold">Token</h2>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "ProfilePage",

    computed: {
        ...mapGetters(["s", "author", "messages"]),
    },

    methods: {
        ...mapActions(["changeRole", "logout", "uploadImg", "editProfile", "toggleDisallow"]),
    },

    mounted() {},
};
</script>
