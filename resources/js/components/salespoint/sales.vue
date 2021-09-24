<template>
  <div>
    <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sales Board</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                        <span>Since last month</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>

                </div>
                <div class="card-body">
                  <div class="chart-area">
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                    <form class="navbar-search mr-2">
                      <div class="input-group">
                          <input v-model="searchTerm" type="text" class="form-control bg-light border-1 small" placeholder="Search"
                          aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                          <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                              <i class="fas fa-search fa-sm"></i>
                          </button>
                          </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- Category Filter -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                  </li>
                  <li class="nav-item" v-for="category in categories" :key="category.id" role="presentation">
                    <a class="nav-link" @click="productFilter(category.id)" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{category.name }}</a>
                  </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearchTerm" :key="product.id">
                          <a href="#">
                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                              <img :src="product.image" class="card-img-top" id="prof" alt="">
                              <div class="card-body">
                                <h6 class="card-title">{{ product.name }}</h6>
                                  <span v-if="product.quantity >= 1 " class="badge badge-success">{{ product.quantity }} In-Stock</span>
                                  <span v-else class="badge badge-danger">Out-of-Stock</span>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="fproduct in filterCatSearchTerm" :key="fproduct.id">
                          <a href="#">
                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                              <img :src="fproduct.image" class="card-img-top" id="prof" alt="">
                              <div class="card-body">
                                <h6 class="card-title">{{ fproduct.name }}</h6>
                                  <span v-if="fproduct.quantity >= 1 " class="badge badge-success">{{ fproduct.quantity }} In-Stock</span>
                                  <span v-else class="badge badge-danger">Out-of-Stock</span>
                              </div>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Category Filter -->

                <!-- <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearchTerm" :key="product.id">
                      <a href="#">
                        <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                          <img :src="product.image" class="card-img-top" id="prof" alt="">
                          <div class="card-body">
                            <h6 class="card-title">{{ product.name }}</h6>
                              <span v-if="product.quantity >= 1 " class="badge badge-success">{{ product.quantity }} In-Stock</span>
                              <span v-else class="badge badge-danger">Out-of-Stock</span>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
  </div>
</template>

<script>
export default {
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: 'login'})
    }
  },
  created() {
    this.getProducts();
    this.getCategories();
    // this.productFilter();
  },
  data() {
    return {
      products: [],
      categories: '',
      filteredProds: [],
      searchTerm: '',
    }
  },

  computed: {
    filterSearchTerm(){
      return this.products.filter(product => {
        return product.name.toUpperCase().match(this.searchTerm.toUpperCase())
      })
    },
    filterCatSearchTerm(){
      return this.filteredProds.filter(fproduct => {
        return fproduct.name.toUpperCase().match(this.searchTerm.toUpperCase())
      })
    },
  },
  methods: {
    getProducts() {
      axios.get('api/v1/products')
        .then(({data}) => (this.products = data))
        .catch(error => this.errors = error.response.data.errors)
    },
    getCategories() {
      axios.get('api/v1/categories')
        .then(({data}) => (this.categories = data))
        .catch(error => this.errors = error.response.data.errors)
    },
    productFilter(id) {
      axios.get('api/v1/product-filter/'+id)
        .then(({data}) => (this.filteredProds = data))
        .catch(error => this.errors = error.response.data.errors)
    },
  },
}
</script>

<style scoped>
  #prof {
    height: 100px;
    width: 135px;
    border-radius: 5px;
  }
</style>