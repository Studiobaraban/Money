<template>
    <div class="flex max-sm:flex-col h-screen min-h-screen bg-gradient-to-br from-green-300 to-teal-400">
        <div class="w-1/2 relative max-sm:w-full max-sm:h-80">
            <svg
                class="w-40 absolute top-1/2 left-1/2 -translate-x-20 -translate-y-64 fill-teal-700 max-sm:-translate-y-32"
                enable-background="new 0 0 480.056 480.056"
                viewBox="0 0 480.056 480.056"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="m396.903 379.896c-11.196-48.722-32.932-49.532-24.974-60.53 15.414-21.305 19.332-49.23 7.921-74.378-18.769 114.36-91.392 139.16-162.73 93.819-8.92-5.67-.351-19.182 8.582-13.504 55.857 35.502 108.612 22.582 131.379-52.382 22.008-72.468 10.516-168.184-53.726-205.97-75.075-44.156-193.402 6.036-197.952 112.446-.126 2.957-1.875 5.602-4.545 6.877-17.081 8.156-23.906 26.087-19.664 43.931 1.807 7.599-4.601 7.397-15.77 20.126-13.194 15.038-18.742 32.003-21.071 44.164 5.412 24.348 14.22 46.9 25.782 67.084 10.849 1.322 21.758.265 31.711-3.102 10.013-3.385 15.154 11.764 5.127 15.156-8.401 2.842-17.335 4.333-26.394 4.473 67.386 96.969 191.916 114.12 278.359 40.002-4.262-8.296-9.687-15.829-16.215-22.427-7.435-7.515 3.931-18.776 11.374-11.253 10.688 10.804 23.288 30.445 22.617 36.549-1.165 10.726-63.256 59.077-138.804 59.077-100.141 0-185.793-76.648-209.217-182.274-2.116-5.436 5.992-43.949 35.985-69.001-3.069-22.114 5.416-43.078 25.003-54.663 3.875-53.508 34.123-100.071 86.936-124.422 107.898-49.746 216.657 26.226 206.281 169.562 24.592 31.912 25.483 72.213 5.436 104.364 5.625 7.341 13.551 19.355 19.133 34.518 81.688-147.194-12.344-342.083-169.557-342.083-94.282 0-176.466 75.147-195.415 178.685-1.903 10.396-17.644 7.531-15.738-2.881 34.008-185.816 242.05-257.358 363.841-121.185 78.544 87.817 81.195 222.844 20.708 311.925-3.963 5.833-12.856 4.032-14.403-2.703zm-263.377-43.356c-2.878 2.498-3.643 6.768-1.614 10.148 78.26 130.393 173.284 113.681 183.616 54.074l1.619-9.341c1.806-10.414-13.958-13.162-15.765-2.732l-1.619 9.341c-8.012 46.222-84.408 52.114-151.146-54.706 3.64-4.711 7.035-9.948 10.232-16.081 23.558 36.159 66.578 80.812 107.521 80.812 10.186 0 10.778-15.263.552-15.981-32.922-2.31-71.27-34.071-100.642-83.137 5.398-17.986 6.082-37.533 1.788-56.822-11.916-53.526 7.66-129.017 43.637-168.281 7.141-7.794-4.647-18.612-11.797-10.81-19.335 21.102-34.839 51.835-43.655 86.539-23.158 91.157 16.665 110.126-12.903 162.718-1.368 2.433-4.497 7.992-9.824 14.259zm145.981-103.939c-8.224 3.204-5.889 15.457 2.906 15.457 11.894 0 34.88-20.197 25.56-45.618-3.659-9.946-6.984-19.104-7.577-28.868-.639-10.544-16.612-9.597-15.971.968 1.573 25.95 14.27 34.381 7.802 47.676-3.865 7.946-11.022 9.725-12.72 10.385zm-27.596-52.546v-8c0-10.57-16-10.585-16 0v8c0 10.57 16 10.586 16 0zm86.5 4v-8c0-10.57-16-10.585-16 0v8c0 10.57 16 10.586 16 0zm-70.386 88.501c-2.485-3.653-7.461-4.601-11.114-2.114-11.459 7.796 7.432 25.635 25.062 26.602 12.788.706 24.901-6.507 31.039-15.466 5.92-8.644-7.121-17.707-13.187-9.062-8.049 11.492-24.167 11.252-31.8.04z"
                ></path>
            </svg>

            <h1
                class="w-48 block absolute top-1/2 left-1/2 -translate-x-24 -translate-y-24 max-sm:translate-y-10 text-5xl text-center text-white font-bold"
            >
                MONEY
                <span class="block font-light text-2xl">Save & Grow</span>
            </h1>
            <p class="w-full absolute bottom-8 text-white text-xs text-center mt-24 max-sm:hidden">© 2023</p>
        </div>

        <div class="w-1/2 bg-white max-sm:w-full max-sm:bg-transparent">
            <div class="px-4 mt-8 mx-auto rounded-lg max-w-xl w-full">
                <div class="v-bbgray p-5 text-center">
                    <div class="flex justify-center text-lg uppercase font-bold">
                        <div class="text-gray-400 cursor-pointer mr-4" :class="{ '!text-teal-600': form == 'login' }" @click="form = 'login'">
                            Вход
                        </div>
                        <div class="text-gray-400 cursor-pointer" :class="{ '!text-teal-600': form == 'reg' }" @click="form = 'reg'">Регистрация</div>
                    </div>
                </div>
                <div class="p-5">
                    <form v-if="form == 'login'">
                        <div class="mb-4">
                            <input type="text" class="text-teal-600 w-full border px-5 h-9 text-sm rounded" v-model="username" placeholder="Логин" />
                        </div>
                        <div class="mb-4">
                            <input
                                type="password"
                                autocomplete="on"
                                class="text-teal-600 w-full border px-5 h-9 text-sm rounded"
                                v-model.trim="password"
                                placeholder="Пароль"
                                @keyup.enter="login({ username: username, password: password })"
                            />
                        </div>

                        <div
                            class="mx-auto block v-btn cursor-pointer group bg-teal-500 hover:bg-teal-400 rounded duration-300 transition-colors ease-out px-5 py-3 h-9"
                        >
                            <div
                                class="text-sm font-bold leading-none uppercase text-white flex items-center"
                                @click="login({ username: username, password: password })"
                            >
                                Войти
                            </div>
                        </div>
                    </form>

                    <a
                        v-if="form == 'reg'"
                        href="https://telegram.me/BotTeachMeBot?start=reg_author__web"
                        target="_blank"
                        class="mx-auto mt-20 block v-btn cursor-pointer group bg-teal-500 hover:bg-teal-400 rounded duration-300 transition-colors ease-out px-5 py-3 h-9"
                    >
                        <div class="text-sm font-bold leading-none uppercase text-white flex items-center">Регистрация TELEGRAM</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

export default {
    name: "LoginPage",

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
