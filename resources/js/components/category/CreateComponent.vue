<template>
  <div>
    <span>
      Product categories for your store can be managed here. You can add, edit
      &amp; delete products categories. It is recommended that, keep you
      categories as simple as possible.
    </span>

    <h6 class="pt-3 text-primary">Add new category</h6>

    <form @submit.prevent="formSubmitHandler" id="CreateCategory">
      <div class="form-group">
        <label for="name">Name <small class="text-danger">*</small></label>
        <input type="text" id="name" class="form-control" v-model="name" />
        <small>The name is how it appears on your site.</small>
      </div>
      <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" id="slug" class="form-control" v-model="slug" />
        <small
          >The “slug” is the URL-friendly version of the name. It is usually all
          lowercase and contains only letters, numbers, and hyphens.</small
        >
      </div>
      <div class="form-group">
        <label for="parent">Parent Category</label>
        <select id="parent" class="form-control" v-model="parent">
          <option value selected disabled>None</option>
          <option
            v-for="(item, key) in getCategories"
            :key="key"
            :value="item.id"
          >
            {{ item.title }}
          </option>
        </select>
        <small>
          Assign a parent category to create a hierarchy. The category Jazz, for
          example, would be the parent of Bebop and Big Band.
        </small>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          id="description"
          rows="5"
          style="resize: none"
          class="form-control"
          v-model="description"
        ></textarea>
        <small
          >The description is not prominent by default; however, some themes may
          show it.</small
        >
      </div>
      <div class="form-group img-container">
        <label for="thumbnail">Click here to Upload Product Thumbnail</label>
        <div class="row w-100" v-if="thumbnail">
          <div class="col-md-2 col-sm-3 col-6 img-wrapper">
            <img :src="thumbnail" class="img-fluid avatar-lg" />
            <a
              href="javascript:void(0)"
              @click.prevent="imgDeleteHandler(index, 'thumbnail')"
              class="text-danger d-block img-remove"
            >
              <i class="bi bi-x-circle-fill"></i>
            </a>
          </div>
        </div>
        <input
          type="file"
          id="thumbnail"
          class="form-control d-none"
          @change="onThumbnailUpload"
        />
      </div>

      <button
        type="submit"
        class="btn btn-primary"
        :disabled="!isValid || isLoading"
      >
        <span
          class="spinner-border spinner-border-sm"
          role="status"
          aria-hidden="true"
          v-if="isLoading"
        ></span>
        {{ btnText }}
      </button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
import FileValidation from "../../services/FileValidation";
export default {
  data() {
    return {
      imageSrc: "https://via.placeholder.com/80",
      thumbnail: "",
      name: "",
      slug: "",
      parent: "",
      description: "",
      btnText: "Add new category",
      isLoading: false,
      list: [],
    };
  },
  methods: {
    /**
     * upload thumbnail image
     */
    onThumbnailUpload(event) {
      let file = event.target.files[0];

      if (FileValidation(file.name)) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.thumbnail = e.target.result;
        };
        reader.readAsDataURL(file);
      } else {
        this.errors.push(`${file.name} is not a valid file type!`);
      }
    },
    formSubmitHandler() {
      this.btnText = "Adding new category ...";
      this.isLoading = true;

      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("slug", this.slug);
      formData.append("parent", this.parent);
      formData.append("description", this.description);
      formData.append("thumbnail", this.thumbnail);

      axios
        .post("categories/store", formData)
        .then((res) => {
          this.resetForm();
          this.$emit("created");
          this.$store.dispatch("loadCategories");
        })
        .catch((error) => {
          this.btnText = "Add new category";
          this.isLoading = false;

          this.$swal.fire({
            title: "Server Error!",
            text: error.response.data.message,
            icon: "warning",
          });
        });
    },

    resetForm() {
      this.name = "";
      this.slug = "";
      this.parent = "";
      this.description = "";
      this.thumbnail = "";
      this.btnText = "Add new category";
      this.isLoading = false;
      this.imageSrc = "https://via.placeholder.com/80";
    },
  },
  created() {
    this.$store.dispatch("loadCategories");
  },
  computed: {
    isValid() {
      return this.name && !this.isLoading;
    },
    getCategories() {
      return this.$store.getters.getCategories;
    },
  },
};
</script>
<style scoped>
.text-bold {
  font-weight: 500;
}
#thumbnail {
  display: none;
}
.thumbnail-lbl {
  margin: 0px 25px;
  border: 1px dashed #ddd;
  padding: 10px 20px;
  cursor: pointer;
  transition: 0.3s all;
}
.thumbnail-lbl:hover {
  background: rgba(255, 255, 255, 0.8);
}
</style>