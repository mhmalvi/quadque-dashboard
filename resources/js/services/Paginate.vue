<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
      <li class="page-item" v-for="(page, key) in pages" :key="key">
        <a class="page-link" href="#">{{ key }}</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>
</template>
<script>
export default {
  props: ["links"],
  data() {
    return {
      pages: this.links,
    };
  },
  mounted() {
    console.log(this.pages);
  },
};
</script>
<style>
</style>