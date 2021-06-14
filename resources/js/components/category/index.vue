<template>
  <div>
    <div class="row justify-content-center">
      <router-link to="/add-category" class="btn btn-primary">Add New Category</router-link>
    </div>
        <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-8 col-md-4">
        <div class="card shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-700 mb-4">List of all Categories</h1>
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
                        <th>Category Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filterSearchTerm" :key="category.id">
                        <td>{{ category.name }}</td>
                        <td>
                          <div >
                            <router-link :to="{ name: 'edit-category', params:{ id: category.id } }" class="btn btn-sm btn-primary"><i class="fas fa-edit text-gray-100"></i></router-link>
                            <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger"><i class="fas fa-trash text-gray-100"></i></a>
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
      categories: [],
      searchTerm: '',
    }
  },

  computed: {
    filterSearchTerm(){
      return this.categories.filter(category => {
        return category.name.match(this.searchTerm)
      })
    }
  },
  methods: {
    getCategories() {
      axios.get('/api/v1/categories/')
        .then(({data}) => (this.categories = data))
        .catch(error => this.errors = error.response.data.errors)
    },
    deleteCategory(id) {
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
          axios.delete('/api/v1/categories/'+id)
            .then(() => {
              this.categories = this.categories.filter(category => {
                return category.id != id
              })
            })
            .catch(() => {
              this.$router.push({ name: 'categories'})
            })
          Swal.fire(
            'Deleted!',
            'Category record has been deleted.',
            'success'
          )
        }
      })
    }
  },
  created() {
    this.getCategories();
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