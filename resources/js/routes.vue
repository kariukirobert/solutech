<script>

import Products from "./components/products.vue";
import Suppliers from "./components/suppliers.vue";
import Orders from "./components/orders.vue";

export default [
	{
		path: "/",
		name: "home",
		component: Products
	},
	{
		path: "/products",
		name: "products",
		component: Products
	},
	{
		path: "/suppliers",
		name: "suppliers",
		component: Suppliers
	},
	{
		path: "/orders",
		name: "orders",
		component: Orders
	},
]

</script>
