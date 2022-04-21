<template>
    <div class="py-3">
        <div v-if="createSuccess" class="alert alert-success" role="alert">
            {{
                isEditing
                    ? "Successfully updated user!"
                    : "Successfully created new user!"
            }}
        </div>

        <form @submit.prevent="handleSubmit">
            <div class="mb-3">
                <form-input
                    label="Name"
                    name="name"
                    comp-id="name"
                    type="text"
                    :form="form"
                ></form-input>
            </div>
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
                    label="Role"
                    name="role_id"
                    comp-id="role"
                    type="role"
                    :roles="roles"
                    :form="form"
                ></form-input>
            </div>
            <div class="mb-3">
                <form-input
                    label="Password"
                    name="password"
                    comp-id="password"
                    type="password"
                    :form="form"
                ></form-input>
            </div>
            <div class="mb-3">
                <form-input
                    label="Confirm Password"
                    name="password_confirmation"
                    comp-id="password_confirm"
                    type="password"
                    :form="form"
                ></form-input>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
<script lang="ts">
import axios from "axios";
import { defineComponent } from "vue";
import Form from "../helpers/form.js";
export default defineComponent({
    props: ["user"],
    data() {
        return {
            form: new Form({
                name: null,
                email: null,
                password: null,
                password_confirmation: null,
                role_id: null,
            }),
            createSuccess: false,
            roles: [],
            selectedRole: null,
        };
    },
    mounted() {
        this.getRoles();

        if (this.user) {
            this.form.name = this.user.name;
            this.form.email = this.user.email;
            this.form.role_id = this.user.role_id;
            this.form.password = null;
            this.form.password_confirmation = null;
        }
    },
    computed: {
        isEditing() {
            return !!this.user;
        },
    },
    methods: {
        handleSubmit() {
            let url = this.isEditing
                ? `/api/users/${this.user.id}`
                : "/api/users";
            let method = this.isEditing ? "put" : "post";
            this.form.sendForm(url, method).then((response) => {
                this.createSuccess = true;

                if (!this.isEditing) {
                    this.form.clearForm();
                }

                this.$emit("createdUser");
            });
        },
        getRoles() {
            axios.get("/api/roles").then((response) => {
                this.roles = response.data.data;
            });
        },
    },
});
</script>
