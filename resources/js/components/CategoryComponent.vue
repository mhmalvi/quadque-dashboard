<template>
  <div class="row">
    <div class="col-md-4 p-3">
      <span>
        Product categories for your store can be managed here. You can add, edit
        &amp; delete products categories. It is recommended that, keep you
        categories as simple as possible.
      </span>

      <h6 class="pt-3 text-primary">Add new category</h6>

      <form @submit.prevent="formSubmitHandler">
        <div class="form-group">
          <label for="name">Name <small class="text-danger">*</small></label>
          <input type="text" id="name" class="form-control" v-model="name" />
          <small>The name is how it appears on your site.</small>
        </div>
        <div class="form-group">
          <label for="slug">Slug</label>
          <input type="text" id="slug" class="form-control" v-model="slug" />
          <small
            >The “slug” is the URL-friendly version of the name. It is usually
            all lowercase and contains only letters, numbers, and
            hyphens.</small
          >
        </div>
        <div class="form-group">
          <label for="parent">Parent Category</label>
          <select id="parent" class="form-control" v-model="parent">
            <option value selected>None</option>
          </select>
          <small>
            Assign a parent category to create a hierarchy. The category Jazz,
            for example, would be the parent of Bebop and Big Band.
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
            >The description is not prominent by default; however, some themes
            may show it.</small
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

        <button
          type="submit"
          class="btn btn-sm btn-primary"
          :disabled="!isValid"
        >
          {{ btnText }}
        </button>
      </form>
    </div>
    <div class="col-md-7 offset-md-1 p-3">
      <category-lists></category-lists>
    </div>
  </div>
</template>
<script>
import CategoryLists from "./childs/CategoryLists.vue";
export default {
  components: { CategoryLists },
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
    };
  },

  methods: {
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
    },
  },

  computed: {
    isValid() {
      return this.name && !this.isLoading;
    },
  },
};
</script>
<style>
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