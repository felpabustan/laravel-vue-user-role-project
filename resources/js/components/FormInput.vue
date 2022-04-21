<template>
    <div>
        <label :for="compId" class="form-label">{{ label }}</label>
        <input
            v-if="allowedInputType"
            :type="type"
            class="form-control"
            :class="{ 'is-invalid': form.getErrors(name).length }"
            :id="compId"
            v-model="form[name]"
        />
        <select
            v-if="type === 'role' && roles"
            class="form-select"
            v-model="form[name]"
            :class="{ 'is-invalid': form.getErrors(name).length }"
            :id="compId"
        >
            <option disabled value="">Select Role</option>
            <option v-for="role in roles" :value="role.id">
                {{ role.name }}
            </option>
        </select>
        <div v-for="error in form.getErrors(name)" class="invalid-feedback">
            {{ error }}
        </div>
    </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
export default defineComponent({
    props: ["errors", "label", "form", "name", "compId", "type", "roles"],
    data() {
        return {
            inputTypes: ["text", "textarea", "password", "email"],
        };
    },
    computed: {
        allowedInputType() {
            return this.inputTypes.includes(this.type);
        },
    },
});
</script>
