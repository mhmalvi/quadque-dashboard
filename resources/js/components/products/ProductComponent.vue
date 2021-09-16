<template>
  <form @submit.prevent="formSubmitHnadler">
    <div class="card card-body">
      <div class="row">
        <div class="col-md-4">
          <h5>Basic Information</h5>
          <small>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum vero
            illo optio consectetur corrupti, laudantium
          </small>
        </div>
        <div class="col-md-7 offset-md-1">
          <div class="form-group">
            <label for="sku">Product SKU</label>
            <input type="text" id="sku" class="form-control" v-model="sku" />
          </div>
          <div class="form-group">
            <label for="title"
              >Product Title <span class="text-danger">*</span></label
            >
            <input
              type="text"
              id="title"
              class="form-control"
              v-model="title"
            />
          </div>
          <div class="form-group">
            <label for="slug">Product Slug</label>
            <input
              type="text"
              id="slug"
              class="form-control"
              v-model="slug"
              placeholder="sample-product"
            />
            <small
              >The “slug” is the URL-friendly version of the name. It is usually
              all lowercase and contains only letters, numbers, and
              hyphens.</small
            >
          </div>
          <div class="form-group">
            <label for="category">Product Category</label>
            <select id="category" class="form-control" v-model="category">
              <option
                v-for="item in categories"
                :key="item.id"
                :value="item.slug"
              >
                {{ item.title }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="brand">Product Brand</label>
            <select id="brand" class="form-control" v-model="brand">
              <option v-for="item in brands" :key="item.id" :value="item.slug">
                {{ item.title }}
              </option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-body">
      <div class="row">
        <div class="col-md-4">
          <h5>Price Informations</h5>
          <small>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa
            molestiae ea tenetur suscipit repudiandae illum.
          </small>
        </div>
        <div class="col-md-7 offset-md-1">
          <div class="form-group">
            <label for="r_price"
              >Regular Price <span class="text-danger">*</span></label
            >
            <input
              type="number"
              id="r_price"
              class="form-control"
              v-model="price"
            />
          </div>
          <div class="row form-group">
            <div class="col-md-8">
              <label for="d_price">Discount</label>
              <input
                type="number"
                id="d_price"
                class="form-control"
                v-model="discount"
              />
            </div>
            <div class="col-md-4">
              <label for="d_type">Discount Type</label>
              <select id="d_type" class="form-control" v-model="discount_type">
                <option value="" selected disabled>Choose Discount Type</option>
                <option value="flat">Flat</option>
                <option value="percent">Percent</option>
              </select>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-8">
              <label for="unit"
                >Minimum Sale Unit <span class="text-danger">*</span></label
              >
              <input
                type="number"
                id="unit"
                class="form-control"
                v-model="sale_unit"
              />
            </div>
            <div class="col-md-4">
              <label for="u_type"
                >Unit Type <span class="text-danger">*</span></label
              >
              <select id="u_type" class="form-control" v-model="unit_type">
                <option value="" selected disabled>Choose unit type</option>
                <option
                  v-for="(unit, index) in unitTypes"
                  :key="index"
                  :value="unit.title"
                >
                  {{ unit.title }}
                </option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-body">
      <h5>Product Details</h5>
      <small>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa molestiae
        ea tenetur suscipit repudiandae illum. neque?
      </small>
      <div class="form-group pt-4">
        <quill-editor
          theme="snow"
          v-model:content="descriptions"
          contentType="html"
          ref="myEditor"
        ></quill-editor>
      </div>
    </div>

    <div class="card card-body">
      <div class="row">
        <div class="col-md-4">
          <h5>Product SEO Informations</h5>
          <small>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis,
            inventore explicabo.
          </small>
        </div>
        <div class="col-md-7 offset-md-1">
          <div class="form-group">
            <label for="keywords">Meta Keywords</label>
            <input
              type="text"
              id="keywords"
              class="form-control"
              v-model="keywords"
            />
            <small>
              seo keywords should be comma seperated and not more than five
              keywords. EX: shirt, jeans ...
            </small>
          </div>
          <div class="form-group">
            <label for="tags">Meta Tags</label>
            <input type="text" id="tags" class="form-control" v-model="tags" />
            <small>
              seo tags should be comma seperated and not more than five tags.
              EX: shirt, jeans ...
            </small>
          </div>
          <div class="form-group">
            <label for="metaDescription">Meta Description</label>
            <textarea
              id="metaDescription"
              cols="3"
              style="resize: none"
              class="form-control"
              v-model="meta_des"
            ></textarea>
            <small> meta description should not exceed 50 words </small>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-body">
      <div class="row">
        <div class="col-md-4">
          <h5>Product Images</h5>

          <div v-if="errors.length > 0" class="text-danger">
            <error-alerts :alerts="errors"></error-alerts>
          </div>

          <small v-else
            >Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil
            accusantium consequuntur ullam voluptatum praesentium vero.</small
          >
        </div>
        <div class="col-md-7 offset-md-1">
          <div class="form-group img-container">
            <label for="thumbnail"
              >Click here to Upload Product Thumbnail</label
            >
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
          <div class="form-group img-container">
            <label for="gallary">Click here to Upload Gallary Images</label>
            <div class="row w-100" v-if="imgSrc">
              <div
                class="col-md-2 col-sm-3 col-6 img-wrapper"
                v-for="(img, index) in imgSrc"
                :key="index"
              >
                <img :src="img" class="img-fluid avatar-lg" />
                <a
                  href="javascript:void(0)"
                  @click.prevent="imgDeleteHandler(index, 'gallary')"
                  class="text-danger d-block img-remove"
                >
                  <i class="bi bi-x-circle-fill"></i>
                </a>
              </div>
            </div>
            <input
              type="file"
              id="gallary"
              class="form-control d-none"
              @change="onGallaryImageUpload"
              multiple
              ref="images"
            />
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between pb-3">
      <div class="custom-control custom-checkbox">
        <input
          type="checkbox"
          class="custom-control-input"
          id="draft"
          v-model="isDraft"
        />
        <label class="custom-control-label" for="draft">Save as draft</label>
      </div>

      <button type="submit" class="btn btn-primary" :disabled="isLoading">
        Add new product
      </button>
    </div>
  </form>
</template>
<script>
import axios from "axios";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import ErrorAlerts from "../../services/ErrorAlerts.vue";
import FileValidation from "../../services/FileValidation";
export default {
  components: { QuillEditor, ErrorAlerts },
  data() {
    return {
      categories: [],
      brands: [],
      unitTypes: [],
      sku: "",
      title: "",
      slug: "",
      category: "",
      brand: "",
      price: 0,
      discount: 0,
      discount_type: "flat",
      sale_unit: 1,
      unit_type: "pcs",
      descriptions: "",
      keywords: "",
      tags: "",
      meta_des: "",
      thumbnail: "",
      imgSrc: [],
      isDraft: "",
      isLoading: false,
      errors: [],
    };
  },
  methods: {
    /**
     * fetch all categories
     */
    fetchCategories() {
      axios
        .get("categories/all")
        .then((res) => {
          this.categories = res.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    /**
     * fetch all brands
     */
    fetchBrands() {
      axios
        .get("brands/all")
        .then((res) => {
          this.brands = res.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

    fetchUnitTypes() {
      axios
        .get("unit-types/all")
        .then((res) => {
          this.unitTypes = res.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },

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

    /**
     * upload gallary images
     */
    onGallaryImageUpload(event) {
      let files = event.target.files;

      for (let file of files) {
        if (FileValidation(file.name)) {
          let reader = new FileReader();

          reader.onload = (e) => {
            this.imgSrc.push(e.target.result);
          };
          reader.readAsDataURL(file);
        } else {
          this.errors.push(`${file.name} is not a valid file type!`);
        }
      }
    },

    /**
     * delete an image from collection
     */
    imgDeleteHandler(index, image) {
      if (image == "thumbnail") {
        this.thumbnail = "";
      } else if (image == "gallary") {
        this.imgSrc.splice(index, 1);
      }
    },

    /**
     * Form submit handler
     */
    formSubmitHnadler() {
      let formData = new FormData();
      formData.append("sku", this.sku);
      formData.append("title", this.title);
      formData.append("slug", this.slug);
      formData.append("category", this.category);
      formData.append("brand", this.brand);
      formData.append("price", this.price);
      formData.append("discount", this.discount);
      formData.append("discount_type", this.discount_type);
      formData.append("sale_unit", this.sale_unit);
      formData.append("unit_type", this.unit_type);
      formData.append("description", this.descriptions);
      formData.append("keywords", this.keywords);
      formData.append("tags", this.tags);
      formData.append("meta_des", this.meta_des);
      formData.append("isDraft", this.isDraft);
      formData.append("thumbnail", this.thumbnail);
      for (let image of this.imgSrc) {
        formData.append("images[]", image);
      }
      axios
        .post("products/store", formData, {
          onUploadProgress: () => {
            this.isLoading = !this.isLoading;
          },
        })
        .then((res) => {
          this.resetForm();
        })
        .catch((error) => {
          this.isLoading = !this.isLoading;
          console.error(error);
        });
    },

    resetForm() {
      this.sku = "";
      this.title = "";
      this.slug = "";
      this.price = 0;
      this.discount = 0;
      this.discount_type = "flat";
      this.sale_unit = 1;
      this.unit_type = "pcs";
      this.category = "";
      this.brand = "";
      this.descriptions = "";
      this.keywords = "";
      this.tags = "";
      this.meta_des = "";
      this.thumbnail = "";
      this.imgSrc = [];
      this.isDraft = "";
      this.isLoading = false;
      this.errors = [];
      this.$refs.myEditor.setHTML("");
    },
  },

  mounted() {
    this.fetchCategories();
    this.fetchBrands();
    this.fetchUnitTypes();
  },
};
</script>
<style>
.ql-container {
  height: 450px !important;
}
.is-Loading {
  margin-right: 5px;
  animation: isLoading 0.8s linear infinite;
}
@keyframes isLoading {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>