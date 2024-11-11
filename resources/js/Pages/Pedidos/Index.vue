<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm} from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Pagination from '@/Components/Pagination.vue';
import Modal from '@/Components/Modal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {ref} from 'vue';

const props = defineProps({
    pedidos:{type:Object},flash:{type:Object}
});
const form = useForm({id:'',title:''});
const showModalDel = ref(false);
const msj = ref( (props.flash.success != null) ? props.flash.success: '');
const classMsj = ref( (props.flash.success != null) ? '' : 'hidden' );

const openModalDel = (p) =>{
  form.id = p.id;
  form.title = p.title;
  showModalDel.value = true;
}
const closeModalDel = () =>{
  showModalDel.value = false;
}
const deletePedido = () =>{
    form.delete(route('pedidos.destroy',form.id),{
        onSuccess: () => {
            ok('Pedido deleted')}
    });
}
const ok = (m) =>{
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
    setTimeout(()=>{
        classMsj.value = 'hidden';
    },6000);
}

</script>

<template>
    <Head title="Pedidos" />
    <AuthenticatedLayout>
		<template #header>
			Pedidos
		</template>
		<div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md" :class="classMsj">
				<div class="flex justify-center items-center w-12 bg-green-500">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                    </svg>
				</div>
				<div class="px-4 py-2 -mx-3">
					<div class="mx-3">
						<span class="font-semibold text-green-900">Success</span>
						<p class="text-sm text-gray-600">{{ msj }}</p>
					</div>
				</div>
			</div>
		<div class="w-full overflow-hidden rounded-lg border shadow-md">
		<div class="w-full overflow-x-auto bg-white">
            <table class="w-ful whitespace-no-wrap ">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b  dark:border-gray-700 dark:text-gray-900 sm:text-sm md:text-base">
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Isbn</th>
                    <th class="px-4 py-3">Producto</th>
                    <th class="px-4 py-3">Fecha_Envio</th>
                    <th class="px-4 py-3">Fecha_Llegada</th>
                    <th class="px-4 py-3">Metodo_Pago</th>
                    <th class="px-4 py-3">description</th>
                    <th class="px-4 py-3">total</th>
                    <th class="px-4 py-3">image</th>
                    <th class="px-4 py-3">Detail</th>
                    <th class="px-4 py-3">Edit</th>
                    <th class="px-4 py-3">Delete</th>
                    </tr>
                </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-900">
  <tr v-for="p, i in pedidos.data" :key="p.id" class="text-white">
    <td class="px-4 py-3 text-sm">{{ (i + 1) }}</td>
    <td class="px-4 py-3 text-sm">{{ p.isbn }}</td>
    <td class="px-4 py-3 text-sm">{{ p.title }}</td>
    <td class="px-4 py-3 text-sm">{{ p.Fecha_Pedido }}</td>
    <td class="px-4 py-3 text-sm">{{ p.Fecha_Envio }}</td>
    <td class="px-4 py-3 text-sm">{{ p.Metodo_Pago }}</td>
    <td class="px-4 py-3 text-sm">{{ p.description }}</td>
    <td class="px-4 py-3 text-sm">{{ p.total }}</td>
    <td class="px-4 py-3 text-sm">
      <img :src="`/storage/img/${p.image}`" :alt="p.model" width="50">
  </td>
    <!-- Botón Detail -->
    <td class="px-4 py-3 text-center">
        <NavLink :href="route('pedidos.show',p.id)">
      <SecondaryButton>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
      </SecondaryButton>
    </NavLink>
    </td>
    <!-- Botón Edit -->
    <td class="px-4 py-3 text-center">
        <NavLink :href="route('pedidos.edit',p.id)">
      <WarningButton>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
        </svg>
      </WarningButton>
    </NavLink>
    </td>
    <!-- Botón Delete -->
    <td class="px-4 py-3 text-center">
      <DangerButton @click="openModalDel(p)">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
          <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
        </svg>
      </DangerButton>
    </td>
  </tr>
</tbody>
            </table>
        </div>
        <div
	    class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
	    <pagination :links="pedidos.links" />
	</div>
        </div>
    <Modal :show="showModalDel" @close="closeModalDel">
        <div class="p-6">
            <p class="text-2xl  text-gray-500">
                Are you sure delete to
                <span class="text-2xl font-medium text-red-900">
                {{ form.title }}</span>?</p>
                <PrimaryButton @click="deletePedido">Yes, delete</PrimaryButton>
        </div>
        <div class="m-6 flex justify-end">
        <SecondaryButton @click="closeModalDel">Cancel</SecondaryButton>
        </div>
    </Modal>
	</AuthenticatedLayout>
</template>