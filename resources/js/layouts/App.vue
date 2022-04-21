<template>
    <div class="container">
        <h1 class="text-center font-bold">Coding Exam</h1>
        <button
            v-if="user"
            class="position-absolute top-0 end-0 btn btn-secondary m-3"
            @click="logout"
        >
            Logout
        </button>
        <div
            v-if="user"
            class="d-flex justify-content-center flex-column align-items-center"
        >
            <h3 class="text-center">Welcome {{ user.name }}</h3>
            <ul class="nav nav-pills nav-fill w-25">
                <li class="nav-item">
                    <router-link
                        to="/home/users"
                        :class="{ active: $route.name == 'Home-Users' }"
                        class="nav-link"
                        >Users</router-link
                    >
                </li>
                <li class="nav-item">
                    <router-link
                        to="/home/roles"
                        :class="{ active: $route.name == 'Home-Roles' }"
                        class="nav-link"
                        >Roles</router-link
                    >
                </li>
            </ul>
        </div>

        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { defineComponent } from "vue";
export default defineComponent({
    data() {
        return {
            user: null,
        };
    },
    mounted() {
        axios.get("/api/user").then((response) => {
            this.user = response.data;
        });
    },
    methods: {
        logout() {
            axios.post("logout").then((response) => {
                location.reload();
            });
        },
    },
});
</script>
