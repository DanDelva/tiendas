<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import{Bar,Pie} from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale,
	LinearScale, ArcElement } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale
	,ArcElement);
	import {ref} from 'vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
const props = defineProps({
clientes:{type:Object},
pedidos:{type:Number},
countries:{type:Object},
});

const cli = ref([]);
const cou = ref([]);
const chartData1 = ref([]);
const charOptions1 = ref([]);
const chartData2 = ref([]);
const charOptions2 = ref([]);
const  cli2 = ref([]);
const pedi = ref([]);
const colors = ref([]);

const random = () =>{
	return Math.floor(Math.random() * 256);
}
//graphic 1
props.countries.map ((row) =>{
	cou.value.push(row.country),
	cli.value.push(row.clientes.length),
	colors.value.push('rgb('+random()+','+random()+','+random()+')')
})
charOptions1.value = {responsive:true};
chartData1.value = {
	labels:cou.value,
	datasets:[{
		label:'Clientes', data:cli.value,backgroundColor:colors
	}]
}
//graphic 2
props.clientes.map ((row) =>{
	pedi.value.push(row.pedidos.length),
	cli2.value.push(row.last_name+''+row.name),
	colors.value.push('rgb('+random()+','+random()+','+random()+')')
})
charOptions2.value = {responsive:true};
chartData2.value = {
	labels:cli2.value,
	datasets:[{
		label:'Clientes', data:pedi.value,backgroundColor:colors
	}]
}

</script>

<template>
	<Head title="Dashboard" />
	
	<AuthenticatedLayout>
		<template #header>
			Dashboard
		</template>
		
		<div class="p-4 bg-white rounded-lg shadow-xs">
			<div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
              <!-- Card -->
              <div class="flex border items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total clients
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ clientes.length }}
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex border items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                  </svg>
                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    Total Pedidos
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ pedidos }}
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div class="flex border items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-blue-100 dark:bg-blue-500">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM6.262 6.072a8.25 8.25 0 1 0 10.562-.766 4.5 4.5 0 0 1-1.318 1.357L14.25 7.5l.165.33a.809.809 0 0 1-1.086 1.085l-.604-.302a1.125 1.125 0 0 0-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 0 1-2.288 4.04l-.723.724a1.125 1.125 0 0 1-1.298.21l-.153-.076a1.125 1.125 0 0 1-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 0 1-.21-1.298L9.75 12l-1.64-1.64a6 6 0 0 1-1.676-3.257l-.172-1.03Z" clip-rule="evenodd" />
                    </svg>

                </div>
                <div>
                  <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    total countries
                  </p>
                  <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {{ countries.length }}
                  </p>
                </div>
              </div>
              <!-- Card -->
            </div>
			<div class="grid gap-6 bg-white mb-8 md:grid-cols-2 border rounded-lg">
			<div class="min-w-0 p-4 rounded-lg shadow-xs border">
            <span class="text-lg p-4">Clientes by Country</span>
			<div class="flex items-center">
            <Bar :data="chartData1" :options="charOptions1"></Bar>
			</div>
			</div>
			<div class="min-w-0 p-4 rounded-lg shadow-xs border">
				<span class="text-lg p-4">Pedidos by Cliente</span>
			<div class="flex items-center">
            <Pie :data="chartData2" :options="charOptions2"/>
			</div>
			</div>
			</div>
		</div>
	</AuthenticatedLayout>
</template>
