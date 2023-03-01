<template>
    <div class="flex min-h-full">
        <div class="w-96 my-4 rounded max-l:mx-auto">
            <div class="p-5 v-bbgray">
                <h2 class="uppercase text-center text-xl font-latobold">Профиль</h2>
            </div>

            <div class="p-5 v-bbgray">
                <div class="flex text-base text-zinc-800 font-latobold flex-col items-center">
                    <div class="w-48 h-48 my-5 mx-auto rounded-full bg-teal-500 overflow-hidden relative">
                        <span class="w-full h-full group">
                            <input
                                type="file"
                                id="avatar"
                                class="absolute invisible opacity-0"
                                multiple
                                @change="uploadImg({ e: $event, type: 'profile', id: profile.user_id })"
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
                                v-if="profile?.picture"
                                class="w-full h-full object-cover"
                                :src="'https://moneyapi.studiobaraban.ru/uploads/user/' + profile?.picture"
                            />
                            <img v-else class="w-full h-full object-cover" src="https://moneyapi.studiobaraban.ru/uploads/user/u0.png" />
                        </span>
                    </div>

                    {{ profile?.name }} {{ profile?.secondname }}
                </div>
                <div class="flex">
                    <!-- <a class="mx-auto mt-4 v-btn bg-teal-500 hover:bg-teal-400 transition-colors duration-150" @click="editProfile">
                        <svg class="fill-white w-16px h-16px mr-3">
                            <use xlink:href="@/assets/i.svg#ico-edit"></use>
                        </svg>
                        <span class="v-btn_text">РЕДАКТИРОВАТЬ</span>
                    </a> -->
                    <a
                        class="mx-auto mt-4 v-btn py-2 px-4 cursor-pointer rounded bg-rose-500 hover:bg-rose-400 transition-colors duration-150"
                        @click="logout()"
                    >
                        <span class="text-white">ВЫХОД</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "ProfilePage",

    computed: {
        ...mapGetters(["s", "profile"]),
    },

    methods: {
        ...mapActions(["changeRole", "logout", "uploadImg", "editProfile", "toggleDisallow"]),
    },

    mounted() {},
};
</script>
