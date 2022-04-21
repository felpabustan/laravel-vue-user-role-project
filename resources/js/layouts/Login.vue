<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <form class="w-25" @submit.prevent="handleLogin">
                <div class="mb-3">
                    <form-input
                        label="Email Address"
                        name="email"
                        comp-id="email"
                        type="email"
                        :form="form"
                    ></form-input>
                </div>
                <div class="mb-3">
                    <form-input
                        label="password"
                        name="password"
                        comp-id="password"
                        type="password"
                        :form="form"
                    ></form-input>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
import Form from "../helpers/form.js";
export default defineComponent({
    beforeRouteEnter(to, from, next) {
        axios
            .get("/api/user")
            .then((response) => {
                if (response.data) {
                    next({ name: "Home" });
                } else {
                    next();
                }
            })
            .catch((response) => {
                next();
            });
    },
    data() {
        return {
            form: new Form({
                email: null,
                password: null,
            }),
        };
    },
    methods: {
        handleLogin() {
            axios.get("/sanctum/csrf-cookie").then((response) => {
                this.form.sendForm("/login", "post").then((response) => {
                    location.reload();
                });
            });
        },
    },
});
</script>
