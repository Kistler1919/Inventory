<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/products" class="btn btn-primary"> List all products</router-link>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">Add New Product</h1>
                  </div>
                  <form class="user" @submit.prevent="addProduct" enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                          <input
                            type="text"
                            class="form-control"
                            name="name"
                            id="name"
                            placeholder="Product Name"
                            v-model="form.name"
                          />
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                      </div>
                      
                    </div>
                    
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-4">
                          <input
                          type="text"
                          class="form-control"
                          name="purchase_price"
                          id="purchase_price"
                          placeholder="Purchase price"
                          v-model="form.purchase_price"
                        />
                        <small class="text-danger" v-if="errors.purchase_price">{{ errors.purchase_price[0] }}</small>
                      </div>
                      <div class="col-md-4">
                        <input
                          type="text"
                          class="form-control"
                          name="retail_price"
                          id="retail_price"
                          placeholder="Retail price"
                          v-model="form.retail_price"
                        />
                        <small class="text-danger" v-if="errors.retail_price">{{ errors.retail_price[0] }}</small>
                      </div>
                      <div class="col-md-4">
                        <input
                          type="text"
                          class="form-control"
                          name="wholesale_price"
                          id="wholesale_price"
                          placeholder="Wholesale price"
                          v-model="form.wholesale_price"
                        />
                        <small class="text-danger" v-if="errors.wholesale_price">{{ errors.wholesale_price[0] }}</small>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-4">
                          <input
                          type="text"
                          class="form-control"
                          name="quantity"
                          id="quantity"
                          placeholder="Quantity"
                          v-model="form.quantity"
                        />
                        <small class="text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
                      </div>
                      <div class="col-md-4">
                        <input
                            type="text"
                            class="form-control"
                            name="code"
                            id="code"
                            placeholder="Code"
                            v-model="form.code"
                          />
                          <small class="text-danger" v-if="errors.code">{{ errors.code[0] }}</small>
                      </div>
                      <div class="col-md-4">
                        <input
                          type="text"
                          class="form-control"
                          name="root"
                          id="root"
                          placeholder="Root"
                          v-model="form.root"
                        />
                        <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-4">
                          <label for="exampleFormControlSelect1">Category</label>
                          <select v-model="form.category_id" class="form-control" id="exampleFormControlSelect1">
                            <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
                          </select>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleFormControlSelect1">Supplier</label>
                        <select v-model="form.supplier_id" class="form-control" id="exampleFormControlSelect1">
                          <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id">{{ supplier.name }}</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="exampleFormControlSelect1">Purchase Date</label>
                         <input
                          type="date"
                          class="form-control"
                          name="purchase_date"
                          id="purchase_date"
                          placeholder="Date Joined"
                          v-model="form.purchase_date"
                        />
                        <small class="text-danger" v-if="errors.purchase_date">{{ errors.purchase_date[0] }}</small>
                      </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-10">
                          <div class="custom-file">
                            <input 
                              type="file" 
                              class="custom-file-input" 
                              id="customFile"
                              @change="onFileSelected"
                            >
                            <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <img :src="form.image" style="height: 40px; width: 40px;">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="row justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary ">
                          Save Product
                        </button>
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
  </div>
</template>

<script type="text/javascript">
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: 'home' })
    }
  },
  data() {
    return {
      form: {
        name: null,
        code: null,
        root: null,
        quantity: null,
        retail_price: null,
        purchase_price: null,
        purchase_date: null,
        wholesale_price: null,
        image: null,
        supplier_id: null,
        category_id: null,
      },
      errors: {},
      categories: {},
      suppliers: {},
    }
  },
  methods: {
    onFileSelected(event){
     let file = event.target.files[0];
     if (file.size > 1048770) {
      Notification.image_validation()
     }else{
      let reader = new FileReader();
      reader.onload = event =>{
        this.form.image = event.target.result
        // console.log(event.target.result);
      };
      reader.readAsDataURL(file);
     }
    },
    addProduct() {
      axios.post('/api/v1/products/', this.form)
        .then(() => {
          this.$router.push({ name: 'products'})
          Notification.success()
        })
        .catch(error => this.errors = error.response.data.errors)
    },
  },
  created() {
    axios.get('/api/v1/categories/')
        .then(({data}) => (this.categories = data))
        .catch(error => this.errors = error.response.data.errors)

    axios.get('/api/v1/suppliers/')
        .then(({data}) => (this.suppliers = data))
        .catch(error => this.errors = error.response.data.errors)
  }
}
</script>

<style type="text/css">
</style>