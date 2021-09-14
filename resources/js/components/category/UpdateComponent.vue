<template>
  <div class="p-3">
    <form @submit.prevent="onUpdateHandler" id="CreateCategory">
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
        <select
          id="parent"
          class="form-control"
          v-model="parent"
          @change="onSelect"
        >
          <option
            v-for="(item, key) in categories"
            :key="key"
            :value="item.uuid"
          >
            {{ item.category }}
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
      </div>

      <button type="submit" class="btn btn-primary" :disabled="!isValid">
        {{ btnText }}
      </button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["category", "list"],
  data() {
    return {
      imageSrc: "https://via.placeholder.com/80",
      btnText: "Save changes",
      datas: JSON.parse(this.category),
      name: "",
      slug: "",
      description: "",
      parent: "",
      thumbnail: "",
      categories: JSON.parse(this.list),
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

    onUpdateHandler() {
      console.log("submited");
    },
  },

  mounted() {
    this.name = this.datas.category;
    this.slug = this.datas.slug;
    this.description = this.datas.description;

    if (this.datas.parent != null) {
      this.parent = this.datas.parent.uuid;
    }

    if (this.datas.icon != null) {
      this.imageSrc = `../../../public/storage/categories/${this.datas.icon}`;
    }
  },

  computed: {
    isValid() {
      return this.name && !this.isLoading;
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