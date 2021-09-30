<template>
	<div id="no_item_found">
		No {{ name ? name : "items" }} found!
	</div>
</template>

<script type="text/javascript">
	export default {
		props: ['name']
	};
</script>
<style type="text/css" scoped>
	#no_item_found
	{
		text-align: center;
	}
</style>