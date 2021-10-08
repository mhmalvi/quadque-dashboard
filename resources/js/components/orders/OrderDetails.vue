<template>
	<div class="row">
		<div class="col-md-12">
			<div class="card-box">
				<div class="clearfix">
					<div class="float-left mb-2">
						<img src="assets/images/logo-dark.png" alt="" height="28">
						<label>Order Status:</label>
						<br>
						<select class="form-control" @change="updateOrderStatus" v-model="order_status">
							<option value="pending">Pending</option>
							<option value="approved">Approved</option>
							<option value="canceled">Canceled</option>
						</select>
					</div>
					<div class="float-right">
						<h3 class="m-0 d-print-none">Invoice</h3>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="mt-3">
							<p><b>Hello, Stanley Jones</b></p>
							<p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
								promises to provide high quality products for you as well as outstanding
							customer service for every transaction. </p>
						</div>

					</div><!-- end col -->
					<div class="col-md-6">
						<div class="mt-3 text-md-right">
							<p><strong>Order Date: </strong> {{ order_info.order_date }}</p>
							<p>
								<strong>Payment Status: </strong>
								<span class="badge badge-success" v-if="order_info.payment_status == 'paid'">Paid</span>
								<span class="badge badge-danger" v-else>Unpaid</span>
							</p>
							<p><strong>Order ID: </strong> #{{ order_info.order_no }}</p>
						</div>
					</div><!-- end col -->
				</div>
				<!-- end row -->

				<div class="row mt-3">
					<div class="col-md-6">
						<h5>Billing Address</h5>

						<address class="line-h-24">
							{{ shipment.user.name }} <br>
							{{ shipment.shipping_address }}<br>
							<abbr title="Phone">P:</abbr> TODO
						</address>

					</div>

					<div class="col-md-6">
						<div class="text-md-right">
							<h5>Shipping Address</h5>

							<address class="line-h-24">
								{{ shipment.user.name }} <br>
								{{ shipment.shipping_address }}<br>
								<abbr title="Phone">P:</abbr> TODO
							</address>
						</div>

					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table mt-4 table-centered">
								<thead>
									<tr><th>#</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Unit Cost</th>
										<th class="text-right">Total</th>
									</tr></thead>
									<tbody>
										<tr v-for="item in cart.items">
											<td>1</td>
											<td>
												<b>category TODO</b> <br/>
												{{ item.product.product }}
											</td>
											<td>{{ item.qty }}</td>
											<td>$ {{ item.regular_price }}</td>
											<td class="text-right">$ {{ item.price }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="clearfix pt-4">
								<h6 class="text-muted">Notes:</h6>

								<small>
									All accounts are to be paid within 7 days from receipt of
									invoice. To be paid by cheque or credit card or direct payment
									online. If account is not paid within 7 days the credits details
									supplied as confirmation of work undertaken will be charged the
									agreed quoted fee noted above.
								</small>
							</div>

						</div>
						<div class="col-md-6">
							<div class="text-md-right">
								<p><b>Sub-total:</b> $ {{ cart.totalPrice }}</p>
								<p><b>VAT (TODO):</b> $ 0</p>
								<h3>$ {{ cart.totalPrice }} USD</h3>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>

					<div class="hidden-print mt-4">
						<div class="text-right d-print-none">
							<a href="javascript:window.print()" class="btn btn-blue waves-effect waves-light"><i class="fa fa-print mr-1"></i> Print</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</template>

<script>
	import axios from 'axios';

	export default {
		props: ['order'],
		data(){
			return {
				order_info: {},
				shipment: {},
				cart: {},
				total: 0,
				order_status: ''
			}
		},
		created()
		{
			this.order_info = JSON.parse(this.order);
			this.shipment = this.order_info.shipment;
			this.cart = JSON.parse(this.order_info.cart);
			this.order_status = this.order_info.order_status
		},
		methods:
		{
			updateOrderStatus()
			{
				axios.post('orders/update/' + this.order_info.order_no + '/order_status', {
					status: this.order_status
				})
					.then(res => {
						this.$swal(res.data.message, '', 'success');
					})
					.catch(err => {
						this.$swal('Something went wrong!', '', 'error');
					})
			}
		}
	};
</script>