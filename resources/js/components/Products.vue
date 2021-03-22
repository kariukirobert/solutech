<template>
    <div class="container">
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
        <!-- show products components -->
         <div class="card mt-2 mb-4 card-outline card-info">
            <div class="card-header py-2">
                <h4 class="mb-0 float-left">
                    <span>Current Products</span>
                </h4>
                <!-- <a class="btn btn-action float-right btn-sm mt-1" href="javascript:;"> Add Product</a> -->
                <button type="button" class="btn btn-primary float-right btn-sm mt-1" data-toggle="modal" data-target="#productModal">
                    Add Product
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th class="text-center" scope="col">Quantity</th>
                            <th class="text-center" scope="col">Description</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, index) in products" :key="product.id">
                            <th scope="row"> {{ index +1 }}</th>
                            <td>{{ product.name }}</td>
                            <td class="text-center">{{ product.quantity }}</td>
                            <td class="text-center">{{ product.description }}</td>
                            <td>
                                <!-- <button type="button" class="btn btn-info btn-sm" @click="viewProduct(product.id)">View</button> -->
                                <button type="button" class="btn btn-success btn-sm" @click="editProduct(product.id)">Edit</button>
                                <button type="button" class="btn btn-danger n-btn-sm btn-sm" @click="deleteProduct(product.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div class="card mt-1">
                        <div class="card-body">
                            <form enctype="multipart/form-data">

                                <!-- show the product form -->
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold" for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" v-model="form.name" :class="{'is-invalid':errors.name}"
                                            placeholder="Name of the product">
                                        <small class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold" for="price">Quantity</label>
                                        <input type="text" class="form-control" name="quantity" id="quantity" v-model="form.quantity" :class="{'is-invalid':errors.quantity}"
                                            placeholder="Quantities of the product">
                                        <small class="invalid-feedback" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold mb-0" for="price">Description</label>
                                        <p class="mb-2"><small class="text-danger" v-if="errors.description">{{ errors.description[0] }}</small></p>
                                        <textarea rows="5" class="form-control" name="description" v-model="form.description" :class="{'is-invalid':errors.description}"
                                            placeholder="Description of the product"></textarea>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12 mt-3 text-center">
                                        <button type="submit" class="btn btn-primary help-block col-4" @click.prevent="addProduct" v-if="add_product">Submit Product </button>
                                        <button type="submit" class="btn btn-primary help-block col-4" @click.prevent="updateProduct(form.product_id)" v-else>Update Product </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "products",
        data() {
            return {
                products: {},
                add_product: true,
                form: {
                    name: "",
                    quantity: "",
                    description: "",
                },
                errors: {}
            }
        },
        mounted() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                axios.get('/api/products').then(response => {
                    this.products = response.data.data
                }).catch(error => {
                    console.log(error)
                })
            },
            addProduct() {
                axios.post('/api/products', this.form).then(response => {
                    window.location.reload();
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            editProduct(id) {
                axios.get(`/api/products/${id}`).then(response => {
                    this.form.name = response.data.data.name
                    this.form.quantity = response.data.data.quantity
                    this.form.description = response.data.data.description
                    this.form.product_id = id
                    this.add_product = false
                    $('#productModal').modal('toggle')
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            updateProduct(id) {
                axios.put(`/api/products/${id}`, this.form).then(response => {
                    window.location.reload();
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            deleteProduct(id) {
                axios.delete(`/api/products/${id}`).then(response => {
                    window.location.reload();
                }).catch(error => {
                    console.log(error)
                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>
