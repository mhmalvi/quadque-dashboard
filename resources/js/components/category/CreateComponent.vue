<template>
  <div class="p-3">
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
          <option v-for="(item, key) in list" :key="key" :value="item.id">
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
      <div class="form-group">
        <p class="text-bold">Thumbnail</p>
        <img :src="imageSrc" alt="image" class="img-fluid avatar-lg" />

        <label for="thumbnail" class="thumbnail-lbl"
          >Upload/Add thumbnail</label
        >
        <input type="file" id="thumbnail" @change="onImageUpload" />
        <input type="hidden" v-model="thumbnail" />
      </div>

      <button type="submit" class="btn btn-sm btn-primary" :disabled="!isValid">
        {{ btnText }}
      </button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
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
    getList() {
      axios
        .get("categories/all")
        .then((res) => {
          this.list = res.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    onImageUpload(event) {
      this.thumbnail = event.target.files[0];

      let reader = new FileReader();

      reader.onload = (e) => {
        this.imageSrc = e.target.result;
      };

      reader.readAsDataURL(this.thumbnail);
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

  computed: {
    isValid() {
      return this.name && !this.isLoading;
    },
  },

  mounted() {
    this.getList();
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