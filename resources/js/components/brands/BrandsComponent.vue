<template>
  <div class="row">
    <div class="col-md-4">
      <create-component @change="onAddNewBrand"></create-component>
    </div>
    <div class="col-md-7 offset-md-1">
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
        <div class="card qa-dt-inner">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table mb-0">
                <thead class="thead-light">
                  <tr>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Description</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center" v-if="brands.length == 0">
                    <td colspan="4">
                      <no-item-found></no-item-found>
                    </td>
                  </tr>
                  <tr v-for="(brand, key) in brands" :key="key" v-else>
                    <td>
                      <img
                        :src="imgPath + brand.icon"
                        :alt="brand.title"
                        width="30"
                      />
                    </td>
                    <td>
                      {{ brand.title }}
                      <div class="pt-1">
                        <button
                          class="btn text-primary pl-0"
                          @click="onEditHandler(brand)"
                        >
                          Edit
                        </button>
                        <button
                          class="btn text-primary pl-0"
                          @click="onDeleteHandler(brand)"
                        >
                          Delete
                        </button>
                      </div>
                    </td>
                    <td>{{ brand.description }}</td>
                    <td>{{ brand.created }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
      brands: [],
      links: [],
      imgPath: "../../../../storage/",
      link: "brands",
      isLoading: false,
    };
  },
  methods: {
    getBrands(getBrands) {
      this.isLoading = true;
      axios
        .post(getBrands, {
          item: this.items,
          search: this.search,
        })
        .then((res) => {
          this.brands = res.data.data;
          this.links = res.data.meta.links;
        })
        .catch((error) => {
          console.error(error);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },

    onChangeHandler(event) {
      this.items = event.target.value;
      this.getBrands(this.link);
    },

    onAddNewBrand() {
      this.getBrands(this.link);
    },

    getLink(link) {
      this.getBrands(link);
    },

    onEditHandler(brand) {
      window.location.href = `/brands/${brand.slug}/edit`;
    },

    onDeleteHandler(brand) {
      this.$swal({
        title: "Are you sure you want to delete the brand?",
        html: "<b>Brand: </b> " + brand.title,
        showCloseButton: true,
        confirmButtonText: "Delete",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post("brands/" + brand.slug + "/remove", {
              _method: "DELETE",
            })
            .then((res) => {
              this.$swal(res.data.message, "", "success");
              this.getBrands(this.link);
            })
            .catch((error) => {
              this.$swal("Something went wrong!", "", "error");
              console.error(error);
            });
        }
      });
    },
    searchByName: _.debounce((vm) => {
      vm.getBrands(vm.link);
    }, 500),
  },
  created() {
    this.getBrands(this.link);
  },
  watch: {
    search(newValue) {
      if (newValue.length > 2 || newValue.length == 0) {
        this.searchByName(this);
      }
    },
  },
};
</script>