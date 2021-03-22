<template>
    <div>
        <!-- show orders components -->
         <div class="card mt-2 mb-4 card-outline card-info">
            <div class="card-header py-2">
                <h4 class="mb-0 float-left">
                    <span>Current Orders</span>
                </h4>
                <button type="button" class="btn btn-primary float-right btn-sm mt-1" data-toggle="modal" data-target="#orderModal">
                    Add Order
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Number</th>
                            <th class="text-center" scope="col">Products</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order, index) in orders" :key="order.id">
                            <th scope="row"> {{ index +1 }}</th>
                            <td>{{ order.order_number }}</td>
                            <td class="text-center">{{ order.products }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" @click="editOrder(order.id)">Edit</button>
                                <button type="button" class="btn btn-danger n-btn-sm btn-sm" @click="deleteOrder(order.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div class="card mt-1">
                        <div class="card-body">
                            <form enctype="multipart/form-data">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold" for="name">Select Products</label>
                                        <select class="custom-select" v-model="form.products" :class="{'is-invalid':errors.products}" multiple>
                                            <!-- <option selected>Open this select menu</option> -->
                                            <option :value="product.id" v-for="(product, index) in products" :key="index">{{ product.name }}</option>
                                        </select>
                                        <small class="invalid-feedback" v-if="errors.products">{{ errors.products[0] }}</small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12 mt-3 text-center">
                                        <button type="submit" class="btn btn-primary help-block col-4" @click.prevent="addOrder" v-if="add_order">Submit Order </button>
                                        <button type="submit" class="btn btn-primary help-block col-4" @click.prevent="updateOrder(form.order_id)" v-else>Update Order </button>
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
        name: "orders",
        data() {
            return {
                orders: {},
                products: {},
                add_order: true,
                form: {
                    products: [],
                },
                errors: {}
            }
        },
        mounted() {
            this.getOrders();
            this.getProducts();
        },
        methods: {
            getOrders() {
                axios.get('/api/orders').then(response => {
                    this.orders = response.data.data.map(order => {
                        return {
                            id: order.id,
                            order_number: order.order_number,
                            // products: order.products.map(({name}) => ({name})),
                            products: order.products.map(product => product.name).join(", "),
                            created_at: order.created_at,
                            updated_at: order.updated_at,
                        }
                    })
                }).catch(error => {
                    console.log(error)
                })
            },
            getProducts() {
                axios.get('/api/products').then(response => {
                    this.products = response.data.data
                }).catch(error => {
                    console.log(error)
                })
            },
            addOrder() {
                axios.post('/api/orders', this.form).then(response => {
                    window.location.reload();
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            editOrder(id) {
                axios.get(`/api/orders/${id}`).then(response => {
                    this.form.products = response.data.data.products.map(product => product.id)
                    this.form.order_id = id
                    this.add_order = false
                    $('#orderModal').modal('toggle')
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            updateOrder(id) {
                axios.put(`/api/orders/${id}`, this.form).then(response => {
                    window.location.reload();
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            deleteOrder(id) {
                axios.delete(`/api/orders/${id}`).then(response => {
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
