<template>
    <div class="py-2 w-50">
        <div v-if="deleteSuccess" class="alert alert-success" role="alert">
            Successfully deleted role!
        </div>

        <button
            class="btn"
            :class="{
                'btn-success': !creatingRole,
                'btn-secondary': creatingRole,
            }"
            @click="creatingRole = !creatingRole"
        >
            {{ !creatingRole ? "Create new Role" : "Back" }}
        </button>
        <create-role
            v-if="creatingRole"
            @created-role="getRoles"
            :role="editingRole"
        ></create-role>
        <table v-if="!creatingRole" class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!roles.data.length && !fetchingData">
                    <td colspan="4">No data.</td>
                </tr>
                <tr v-if="fetchingData">
                    <td colspan="4">Fetching roles.....</td>
                </tr>
                <tr
                    v-if="roles.data.length && !fetchingData"
                    v-for="role in roles.data"
                >
                    <th scope="row">{{ role.name }}</th>
                    <td>{{ role.description }}</td>
                    <td>
                        <button
                            class="btn btn-primary btn-sm me-2"
                            @click="handleEdit(role)"
                        >
                            edit
                        </button>
                        <button
                            class="btn btn-danger btn-sm"
                            @click="handleDelete(role)"
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
            roles: {
                data: [],
            },
            creatingRole: false,
            fetchingData: false,
            editingRole: null,
            deleteSuccess: false,
        };
    },
    mounted() {
        this.getRoles();
    },
    methods: {
        handleEdit(role) {
            this.editingRole = role;
            this.creatingRole = true;
        },
        getRoles() {
            this.fetchingData = true;
            axios
                .get("/api/roles")
                .then((response) => {
                    this.roles = response.data;
                })
                .finally(() => {
                    this.fetchingData = false;
                });
        },
        handleDelete(role) {
            this.deleteSuccess = false;
            axios.delete(`/api/roles/${role.id}`).then((response) => {
                this.getRoles();
                this.deleteSuccess = true;
            });
        },
    },
    watch: {
        creatingRole(value) {
            if (!value) this.editingRole = null;
        },
    },
});
</script>
