<template>
	<div id="modal_wrapper">
		<div class="modal-body card">
			<div class="card-title">
				{{ title }}
				<button class="close" @click.prevent="hideModal">
					<span>&times;</span>
				</button>
			</div>
			<div class="card-text">
				<slot />
			</div>
		</div>

		<div class="modal-dark-overlay" @click="hideModal"></div>
	</div>
</template>

<script type="text/javascript">
	export default {
		props: ['title', 'showStatus'],
		methods: {
			hideModal()
			{
				this.$emit("hide");
				$('#modal_wrapper').css('display', 'none');
			},
			showModal()
			{
				$('#modal_wrapper').css('display', 'block');
			}
		},
		watch:{
			showStatus(newValue, oldValue)
			{
				if(newValue) this.showModal()
			}
		}
	};
</script>

<style scoped>
	.modal-dark-overlay
	{
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: #000;
		opacity: 0.4;
		width: 100%;
		height: 100%;
		z-index: 105;
		backdrop-filter: blur;
	}

	.modal-body
	{
		z-index: 107;
		position: fixed;
		width: 50%;
		left: 25%;
		right: 25%;
	}

	#modal_wrapper
	{
		display: none;
	}
</style>