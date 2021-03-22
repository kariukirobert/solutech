<template>
    <div>
        <!-- show products components -->
         <div class="card mt-2 mb-4 card-outline card-info">
            <div class="card-header py-2">
                <h4 class="mb-0 float-left">
                    <span>Current Suppliers</span>
                </h4>
                <a class="btn btn-action float-right btn-sm mt-1" href="javascript:;"> Add Supplier</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th class="text-center" scope="col">Products</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in products" :key="product.id">
                            <th scope="row"> {{ index +1 }}</th>
                            <td>{{ product.name }}</td>
                            <td class="text-center">{{ product.products }}</td>
                            <td>
                                <button type="button" class="btn btn-info" @click="viewProduct(product.id)">View</button>
                                <button type="button" class="btn btn-success" @click="editProduct(product.id)">Edit</button>
                                <button type="button" class="btn btn-danger n-btn-sm btn-sm" @click="deleteProduct(product.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "suppliers",
        data() {
            return {
                suppliers: {}
            }
        },
        mounted() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                // return this.$store.getters.products;
            },
            deleteProduct(id) {
                this.$store.dispatch('deleteProduct', id)
            }
        },
        computed: {

        }
    }
</script>

<style lang="scss" scoped>

</style>
