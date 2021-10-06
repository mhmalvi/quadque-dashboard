<template>
  <div class="text-secondary" id="no_item_found">
    <i class="far fa-frown"></i>
    <p>No {{ name ? name : "data" }} found!</p>
  </div>
</template>

<script type="text/javascript">
export default {
  props: ["name"],
};
</script>
<style type="text/css" scoped>
#no_item_found {
  font-size: 1rem;
  text-align: center;
}
</style>