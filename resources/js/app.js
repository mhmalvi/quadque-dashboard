import { createApp } from "vue";
import axios from "axios";
import store from "./store";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

//product
import ProductComponent from "./components/products/ProductComponent.vue";
import ProductList from "./components/products/ProductList.vue";

//Category
import CategoryComponent from "./components/category/CategoryComponent.vue";
import UpdateCategory from "./components/category/UpdateComponent.vue";

//Brand
import BrandsComponent from "./components/brands/BrandsComponent.vue";
import UpdateBrand from "./components/brands/UpdateComponent.vue";

// Attribute
import AttributeList from "./components/attributes/AttributeList.vue";

axios.defaults.baseURL = document.head.querySelector(
    'meta[name="api-base-url"]'
).content;

const app = createApp({});
app.use(store).use(VueSweetalert2);

/**
 * mount your components here
 */
app.component("product-component", ProductComponent);
app.component("product-list", ProductList);
app.component("category-component", CategoryComponent);
app.component("update-category", UpdateCategory);
app.component("brands-component", BrandsComponent);
app.component("update-brand", UpdateBrand);
app.component("attribute-list", AttributeList);

app.mount("#wrapper");

require("./bootstrap");

require("alpinejs");
