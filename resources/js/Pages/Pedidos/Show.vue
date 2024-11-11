<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue'
import DarkButton from '@/Components/DarkButton.vue';

const props = defineProps({
    pedido:{type:Object},
    clientes:{type:Object}
});

</script>
<template>
    <Head title="Pedido" />
    <AuthenticatedLayout>
		<template #header>
			<div class="inline-flex overflow-hidden mb-4 w-full">
            {{ pedido.title }}
            <NavLink :href="route('pedidos.index')">
            <DarkButton>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                </svg>

            </DarkButton>
            </NavLink>
            </div>
		</template>
        <div class="grid gap-6 bg-white mb-8 md:grid-cols-2 border rounded-lg">
        <div class="min-w-0 p-4 rounded-lg shadow-xs">
        <p>Description:<span class="text-gray-900 font-semibold">{{ pedido.description }}</span></p>
        <p>Isbn:<span class="text-gray-900 font-semibold">{{ pedido.isbn }}</span></p>
        <p>Cliente:<span  v-for="c,i in clientes" class="text-gray-900 font-semibold">
            <a v-if="i == (clientes.lenght-1)">{{ c.last_name+' '+c.name}}</a>
            <a v-else>{{ c.last_name+' '+c.name+','}}</a>
        </span>
        </p>
        <p>Fecha Pedido:<span class="text-gray-900 font-semibold">{{ pedido.Fecha_Pedido}}</span></p>
        <p>Fecha Envio:<span class="text-gray-900 font-semibold">{{ pedido.Fecha_Envio}}</span></p>
        <p>Metodo Pago:<span class="text-gray-900 font-semibold">{{ pedido.Metodo_Pago}}</span></p>
        <p>Total:<span class="text-gray-900 font-semibold">{{ pedido.total}}</span></p>
    </div>
        <div class="min-w-0 p-4 rounded-lg shadow-xs">
            <img :src="`/storage/${pedido.image}`" :alt="pedido.model" width="500">


</div>
        </div>
    </AuthenticatedLayout>
    </template>