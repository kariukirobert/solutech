<template>
    <div>
        <ul class="nav nav-pills nav-justified nav-fill mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <router-link class="nav-link active" to="/products">Products</router-link>
            </li>
            <li class="nav-item" role="presentation">
                <router-link class="nav-link" to="/orders">Orders</router-link>
            </li>
            <li class="nav-item" role="presentation">
                <router-link class="nav-link" to="/suppliers">Suppliers</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "mainpage"
    }
</script>

<style lang="scss" scoped>

</style>
