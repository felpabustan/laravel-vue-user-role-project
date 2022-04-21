<template>
    <div class="d-flex justify-content-center">
        <router-view></router-view>
    </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";
import axios from "axios";
export default defineComponent({
    beforeRouteEnter(to, from, next) {
        axios
            .get("/api/user")
            .then((response) => {
                if (response.data) {
                    next();
                }
            })
            .catch((response) => {
                next({ name: "Login" });
            });
    },
});
</script>
