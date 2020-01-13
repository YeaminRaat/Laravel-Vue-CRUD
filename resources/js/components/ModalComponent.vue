<template>
    <div>
        <!-- /.Add category modal -->
        <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalHeader">Add New {{title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form @submit.prevent="title=='Category'?createCategory():createBrand()">
                  <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input v-model="addForm.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': addForm.errors.has('name') }" >
                              <has-error :form="addForm" field="name"></has-error>
                                
                        </div>  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title'],
        data() {
            return{
                addForm: new Form({
                    name: ''
                })
            }
        },
        methods:{
            openModal(){
              this.addForm.reset()
              this.addForm.clear()
              $('#newModal').modal('show')
            },
            createCategory(){
                this.addForm.post('/add-category')
                    .then((response)=>{
                        //console.log(response.data)
                        this.$emit('getCat')
                        $('#newModal').modal('hide')
                        Toast.fire({
                          icon: 'success',
                          title: 'New Category Added Successfully'
                        })
                    })
            },
            createBrand(){
                this.addForm.post('/add-brand')
                    .then((response)=>{
                        //console.log()
                        this.$emit('getBrand')
                        $('#newModal').modal('hide')
                        Toast.fire({
                          icon: 'success',
                          title: 'New Brand Added Successfully'
                        })
                    })
            }
        }
    }
</script>
