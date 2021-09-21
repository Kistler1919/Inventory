<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/add-supplier" class="btn btn-primary">Add New Supplier</router-link>
    </div>
        <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-10 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">List of all Suppliers</h1>
                  </div>
                  <hr>
                  <div class="container-fluid" id="container-wrapper">

          <!-- Row -->
          <div class="row">
            <!-- Datatables -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="py-3 d-flex flex-row align-items-end justify-content-end">
                  <form class="navbar-search mr-3">
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
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>E-mail</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filterSearchTerm" :key="supplier.id">
                        <td>{{ supplier.name }}</td>
                        <td><img :src="supplier.logo" id="profile"/></td>
                        <td>{{ supplier.email }}</td>
                        <td>{{ supplier.phone }}</td>
                        <td>{{ supplier.country }}</td>
                        <td>
                          <div >
                            <router-link :to="{ name: 'edit-supplier', params:{ id: supplier.id } }" class="btn btn-sm btn-primary"><i class="fas fa-edit text-gray-100"></i></router-link>
                            <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash text-gray-100"></i></a>
                          </div>
                        </td>
                        
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->

        </div>
                </div>
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
  created() {
    if (!User.loggedIn()) {
      this.$router.push({ name: 'login'})
    }
  },
  data() {
    return {
      suppliers: [],
      searchTerm: '',
    }
  },

  computed: {
    filterSearchTerm(){
      return this.suppliers.filter(supplier => {
        return supplier.name.toUpperCase().match(this.searchTerm.toUpperCase())
      })
    }
  },
  methods: {
    getSuppliers() {
      axios.get('/api/v1/suppliers/')
        .then(({data}) => (this.suppliers = data))
        .catch(error => this.errors = error.response.data.errors)
    },
    deleteSupplier(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "This action is irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/v1/suppliers/'+id)
            .then(() => {
              this.suppliers = this.suppliers.filter(supplier => {
                return supplier.id != id
              })
            })
            .catch(() => {
              this.$router.push({ name: 'suppliers'})
            })
          Swal.fire(
            'Deleted!',
            'Employee record has been deleted.',
            'success'
          )
        }
      })
    }
  },
  created() {
    this.getSuppliers();
  }
}
</script>

<style>
  #profile {
    height: 40px;
    width: 40px;
    border-radius: 20px;
  }
</style>