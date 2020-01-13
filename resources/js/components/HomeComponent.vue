<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mt-3">
                    <div class="card-header">
                        <span class="h4">Product List</span>
                        <button class="btn btn-primary float-right" @click.prevent="newProductModal">
                            <i class="fa fa-plus"><b> Add New</b></i>
                        </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in products.data">
                                    <td>{{product.title}}</td>
                                    <td>{{product.brand ? product.brand.name : 'Not Found'}}</td>
                                    <td>{{product.category ? product.category.name : 'Not Found'}}</td>
                                    <td>{{product.price}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a @click.prevent="editProductModal(product)" class="dropdown-item" href="#">Edit</a>
                                                <a @click.prevent="deleteProduct(product.id)" class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!-- pagination parts -->
                    <div class="card-footer">
                        <pagination :data="products" @pagination-change-page="getResults">
                            <span slot="prev-nav">&lt; Previous</span>
                            <span slot="next-nav">Next &gt;</span>
                        </pagination>
                    </div>
                </div>
            </div>
        </div>

        <!-- add/edit product modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="!editMode" class="modal-title" id="productModalLabel">Add New Product</h5>
                        <h5 v-else class="modal-title" id="productModalLabel">Update Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateProduct() : createProduct()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.title" type="text" name="title"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" required>
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="category">Category</label>
                                    <div class="input-group">
                                        <select class="form-control" v-model="form.category_id" name="category_id" aria-describedby="inputGroupPrepend" id="category" required>
                                            <option value="">Choose one</option>
                                            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                                        </select>
                                        <div class="input-group-prepend">
                                            <button @click.prevent="openCatModal" class="input-group-text" id="inputGroupPrepend" >+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="brand">Brand</label>
                                    <div class="input-group">
                                        <select class="form-control" v-model="form.brand_id" name="brand_id" aria-describedby="inputGroupPrepend2" id="brand" :class="{ 'is-invalid': form.errors.has('brand_id') }" required>
                                            <option value="">Choose one</option>
                                            <option v-for="brand in brands" :value="brand.id">{{brand.name}}</option>
                                        </select>

                                        <div class="input-group-prepend">
                                            <button @click.prevent="openBrandModal" type="button" class="input-group-text" id="inputGroupPrepend2">+</button>
                                        </div>
                                        <has-error :form="form" field="brand_id"></has-error>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend3">৳</span>
                                    </div>
                                    <input v-model="form.price" type="text" name="price"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('price') }" aria-describedby="inputGroupPrepend3">
                                    <has-error :form="form" field="price"></has-error>
                                </div>
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Submit</button>
                            <button v-show="editMode" type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <new-modal @getCat="getCategories" @getBrand="getBrands" ref="homeComponent" :title="modalType"></new-modal>

    </div>
</template>

<script>
    import modal from './ModalComponent.vue'
    export default {
        components: {
            'new-modal': modal
        },
        data(){
            return {
                editMode: false,
                products: {},
                categories: {},
                brands: {},
                modalType: '',
                form: new Form({
                    id: '',
                    title: '',
                    category_id: '',
                    brand_id: '',
                    price: '',
                }),
            }
        },
        methods:{
            openCatModal() {
                this.modalType = 'Category'
                this.$refs.homeComponent.openModal()
            },
            openBrandModal() {
                this.modalType = 'Brand'
                this.$refs.homeComponent.openModal()
            },
            newProductModal() {
                this.editMode = false
                this.form.reset()
                this.form.clear()
                this.getCategories()
                this.getBrands()
                $('#productModal').modal('show')
            },
            editProductModal(data) {
                this.editMode = true
                this.getCategories()
                this.getBrands()
                $('#productModal').modal('show')
                this.form.reset()
                this.form.clear()
                this.form.fill(data)
            },
            getProducts() {
                axios.get('/get-product')
                    .then((response)=>{
                        //console.log(response.data)
                        this.products = response.data
                })
            },
            //for pagination
            getResults(page = 1) {
                axios.get('get-product?page=' + page)
                    .then(response => {
                        //console.log(response.data)
                        this.products = response.data;
                    });
            },
            createProduct() {
                this.form.post('/add-product')
                    .then((response) => { 
                        //console.log(response.data)
                        Toast.fire({
                          icon: 'success',
                          title: 'Product added successfully'
                        })
                        $('#productModal').modal('hide')
                        this.getProducts()
                })
            },
            updateProduct() {
                this.form.post('update-product')
                    .then((response) => {
                        console.log(response.data)
                        Toast.fire({
                          icon: 'success',
                          title: 'Product Updated successfully'
                        })
                        $('#productModal').modal('hide')
                        this.getProducts()
                    })
            },
            deleteProduct(id) {
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.post('/delete-product',{
                            id: id
                        })
                            .then((response)=>{
                                //console.log(response.data)
                                this.getProducts();
                            })
                    Swal.fire(
                      'Deleted!',
                      'Product has been deleted.',
                      'success'
                    )
                  }
                })
            },
            getCategories(){
                axios.get('/get-category')
                    .then((response) => {
                        this.categories = response.data
                })
            },
            getBrands(){
                axios.get('/get-brand')
                    .then((response) => {
                        //console.log(response.data)
                        this.brands = response.data
                })
            },
            
        },
        mounted() {
            this.getProducts();
        }
    }
</script>
