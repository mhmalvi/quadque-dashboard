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
              <input type="text" class="form-control" />
            </div>
          </div>
        </div>
      </form>

      <div class="card-box">
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
              <tr v-for="(category, key) in categories" :key="key">
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
export default {
  components: { CreateComponent },
  data() {
    return {
      items: 5,
      categories: [],
      links: [],
      getCategory: "categories/all",
    };
  },
  methods: {
    async getData(getCategoryies) {
      await axios
        .post(getCategoryies, { items: this.items })
        .then((res) => {
          this.categories = res.data.data;
          this.links = res.data.meta.links;
        })
        .catch((error) => {
          console.log(error);
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
      window.location.href = `categories/${slug}/edit`;
    },
  },
  created() {
    this.getData(this.getCategory);
  },
};
</script>