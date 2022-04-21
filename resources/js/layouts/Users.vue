<template>
    <div class="py-5 w-50">
        <div v-if="deleteSuccess" class="alert alert-success" role="alert">
            Successfully deleted user!
        </div>

        <button
            class="btn"
            :class="{
                'btn-success': !creatingUser,
                'btn-secondary': creatingUser,
            }"
            @click="creatingUser = !creatingUser"
        >
            {{ !creatingUser ? "Create new User" : "Back" }}
        </button>
        <create-user
            v-if="creatingUser"
            @created-user="getUsers"
            :user="editingUser"
        ></create-user>
        <table v-if="!creatingUser" class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!users.data.length && !fetchingData">
                    <td colspan="4">No data.</td>
                </tr>
                <tr v-if="fetchingData">
                    <td colspan="4">Fetching Users.....</td>
                </tr>
                <tr
                    v-if="users.data.length && !fetchingData"
                    v-for="user in users.data"
                >
                    <th scope="row">{{ user.name }}</th>
                    <td>{{ user.email }}</td>
                    <td>{{ user.role?.name }}</td>
                    <td>
                        <button
                            class="btn btn-primary btn-sm me-2"
                            @click="handleEdit(user)"
                        >
                            edit
                        </button>
                        <button
                            class="btn btn-danger btn-sm"
                            @click="handleDelete(user)"
                        >
                            delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
export default defineComponent({
    data() {
        return {
            fetchingData: false,
            creatingUser: false,
            users: {
                data: [],
            },
            editingUser: null,
            deleteSuccess: false,
        };
    },
    mounted() {
        this.getUsers();
    },
    methods: {
        handleEdit(user) {
            this.editingUser = user;
            this.creatingUser = true;
        },
        getUsers() {
            this.fetchingData = true;
            axios
                .get("/api/users")
                .then((response) => {
                    this.users = response.data;
                })
                .finally(() => {
                    this.fetchingData = false;
                });
        },
        handleDelete(user) {
            this.deleteSuccess = false;
            axios.delete(`/api/users/${user.id}`).then((response) => {
                this.getUsers();
                this.deleteSuccess = true;
            });
        },
    },
    watch: {
        creatingUser(value) {
            if (!value) this.editingUser = null;
        },
    },
});
</script>
