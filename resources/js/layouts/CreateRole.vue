<template>
    <div class="py-3">
        <div v-if="createSuccess" class="alert alert-success" role="alert">
            {{
                isEditing
                    ? "Successfully updated role!"
                    : "Successfully created new role!"
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
                    label="Description"
                    name="description"
                    comp-id="description"
                    type="textarea"
                    :form="form"
                ></form-input>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import Form from "../helpers/form";
export default defineComponent({
    props: ["role"],
    data() {
        return {
            form: new Form({
                name: null,
                description: null,
            }),
            createSuccess: false,
        };
    },
    mounted() {
        if (this.role) {
            this.form.name = this.role.name;
            this.form.description = this.role.description;
        }
    },
    computed: {
        isEditing() {
            return !!this.role;
        },
    },
    methods: {
        handleSubmit() {
            let url = this.isEditing
                ? `/api/roles/${this.role.id}`
                : "/api/roles";
            let method = this.isEditing ? "put" : "post";

            this.form.sendForm(url, method).then((response) => {
                this.createSuccess = true;

                if (!this.isEditing) {
                    this.form.clearForm();
                }

                this.$emit("createdRole");
            });
        },
    },
});
</script>
