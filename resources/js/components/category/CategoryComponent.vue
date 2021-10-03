<template>
  <div class="row">
    <div class="col-md-4">
      <create-component @created="newCategory"></create-component>
    </div>
    <div class="col-md-7 offset-md-1 p-3">
      <form>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <select class="form-control" @change="onChangeHandler($event)">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 offset-md-6">
            <div class="form-group">
              <input type="text" class="form-control" v-model="search" />
            </div>
          </div>
        </div>
      </form>

      <div class="qa-dt">
        <div class="card-box qa-dt-inner">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="thead-light">
                <tr>
                  <th>Category</th>
                  <th>Parent Category</th>
                  <th>Description</th>
                  <th>Created At</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center" v-if="isLoading">
                  <td colspan="8">
                    <div class="sk-double-bounce">
                      <div class="sk-child sk-double-bounce1"></div>
                      <div class="sk-child sk-double-bounce2"></div>
                    </div>
                  </td>
                </tr>
                <tr v-else-if="categories.length == 0">
                  <no-item-found name="category" />
                </tr>
                <tr v-for="(category, key) in categories" :key="key" v-else>
                  <td>
                    {{ category.title }}
                    <div class="pt-1">
                      <button
                        class="btn text-primary pl-0"
                        @click="onEditHandler(category.slug)"
                      >
                        Edit
                      </button>
                      <button
                        class="btn text-primary pl-0"
                        @click="onDeleteHandler(category.slug)"
                      >
                        Delete
                      </button>
                    </div>
                  </td>
                  <td>{{ category.parent }}</td>
                  <td>{{ category.description }}</td>
                  <td>{{ category.created }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li
            class="page-item"
            v-for="(page, key) in links"
            :key="key"
            :class="page.url == null ? 'disabled' : ''"
          >
            <a
              class="page-link"
              href="javascript:void(0)"
              @click="getLink(page.url)"
              v-html="page.label"
            ></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import CreateComponent from "./CreateComponent.vue";
import NoItemFound from "../NoItemFound.vue";

export default {
  components: { CreateComponent, NoItemFound },
  data() {
    return {
      items: 5,
      search: "",
      categories: [],
      links: [],
      getCategory: "categories/all",
      isLoading: false,
    };
  },
  methods: {
    async getData(getCategoryies) {
      this.isLoading = true;
      await axios
        .post(getCategoryies, { items: this.items, search: this.search })
        .then((res) => {
          this.isLoading = false;
          this.categories = res.data.data;
          this.links = res.data.meta.links;
        })
        .catch((error) => {
          console.log(error);
          this.isLoading = false;
        });
    },

    newCategory() {
      this.getData(this.getCategory);
    },

    getLink(link) {
      this.getData(link);
    },

    onChangeHandler(event) {
      this.items = event.target.value;
      this.getData(this.getCategory);
    },

    async onDeleteHandler(slug) {
      await this.$swal
        .fire({
          title: "Are you sure to delete this category?",
          showCancelButton: true,
          confirmButtonText: "Delete",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios
              .delete(`categories/${slug}/remove`)
              .then((res) => {
                this.$swal.fire("Deleted!", "", "success");
                this.getData(this.getCategory);
              })
              .catch((error) => {
                console.error(error);
              });
          }
        });
    },
    onEditHandler(slug) {
      window.location.href = `/categories/${slug}/edit`;
    },
    searchByName: _.debounce((vm) => {
      vm.getData(vm.getCategory);
    }, 500),
  },
  created() {
    this.getData(this.getCategory);
  },
  watch: {
    search(newValue) {
      if (newValue.length > 3 || newValue.length == 0) {
        this.searchByName(this);
      }
    },
  },
};
</script>