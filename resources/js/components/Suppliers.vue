<template>
    <div>
        <!-- show suppliers components -->
         <div class="card mt-2 mb-4 card-outline card-info">
            <div class="card-header py-2">
                <h4 class="mb-0 float-left">
                    <span>Current Suppliers</span>
                </h4>
                <!-- <a class="btn btn-action float-right btn-sm mt-1" href="javascript:;"> Add Product</a> -->
                <button type="button" class="btn btn-primary float-right btn-sm mt-1" data-toggle="modal" data-target="#supplierModal">
                    Add Supplier
                </button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover table-stripped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(supplier, index) in suppliers" :key="supplier.id">
                            <th scope="row"> {{ index +1 }}</th>
                            <td>{{ supplier.name }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" @click="editSupplier(supplier.id)">Edit</button>
                                <button type="button" class="btn btn-danger n-btn-sm btn-sm" @click="deleteSupplier(supplier.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div class="card mt-1">
                        <div class="card-body">
                            <form enctype="multipart/form-data">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold" for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" v-model="form.name" :class="{'is-invalid':errors.name}"
                                            placeholder="Name of the supplier">
                                        <small class="invalid-feedback" v-if="errors.name">{{ errors.name[0] }}</small>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12 mt-3 text-center">
                                        <button type="submit" class="btn btn-primary help-block col-4" @click.prevent="addSupplier" v-if="add_supplier">Submit Supplier </button>
                                        <button type="submit" class="btn btn-primary help-block col-4" @click.prevent="updateSupplier(form.supplier_id)" v-else>Update Supplier </button>
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
        name: "suppliers",
        data() {
            return {
                suppliers: {},
                add_supplier: true,
                form: {
                    name: "",
                },
                errors: {}
            }
        },
        mounted() {
            this.getSuppliers();
        },
        methods: {
            getSuppliers() {
                axios.get('/api/suppliers').then(response => {
                    this.suppliers = response.data.data
                }).catch(error => {
                    console.log(error)
                })
            },
            addSupplier() {
                axios.post('/api/suppliers', this.form).then(response => {
                    window.location.reload();
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            editSupplier(id) {
                axios.get(`/api/suppliers/${id}`).then(response => {
                    this.form.name = response.data.data.name
                    this.form.quantity = response.data.data.quantity
                    this.form.description = response.data.data.description
                    this.form.supplier_id = id
                    this.add_supplier = false
                    $('#supplierModal').modal('toggle')
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            updateSupplier(id) {
                axios.put(`/api/suppliers/${id}`, this.form).then(response => {
                    window.location.reload();
                }).catch(error => {
                    this.errors = error.response.data.errors
                    console.log(error)
                })
            },
            deleteSupplier(id) {
                axios.delete(`/api/suppliers/${id}`).then(response => {
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
