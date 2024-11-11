<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm} from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import WarningButton from '@/Components/WarningButton.vue';
import DarkButton from '@/Components/DarkButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputGroup from '@/Components/InputGroup.vue';
import SelectInput from '@/Components/SelectInput.vue';
import {ref} from 'vue';



const props = defineProps({
    clientes:{type:Object},
    countries:{type:Object}
});
const form = useForm({name:'',last_name:'',direction:'',country_id:''});
const v =ref({id:'',name:'',last_name:'',clientes:[]});
const showModalView = ref(false);
const showModalForm = ref(false);
const showModalDel = ref(false);
const title = ref('');
const operation = ref(1);
const msj = ref('');
const classMsj = ref('hidden');

const openModalView = (c) =>{
    v.value.name = c.last_name+' '+c.name;
    v.value.direction = c.direction;
    v.value.country = c.country.country;
    v.value.pedidos = c.pedidos;
    showModalView.value = true;
}
const openModalForm = (op,c) =>{
    showModalForm.value = true;
    operation.value = op;
    if(op ===1){
        title.value = 'Create cliente';
    }
    else{
    title.value = 'Edit cliente';
    form.name = c.name;
    form.last_name = c.last_name;
    form.direction = c.direction;
    form.country_id = c.country_id;
    v.value.id = c.id;
    }
}
const openModalDel = (c) =>{
    showModalDel.value = true;
    v.value.id = c.id;
    v.value.name = c.last_name+' '+c.name;
}
const closeModalView = () =>{
    showModalView.value = false;
}
const closeModalForm = () =>{
    showModalForm.value = false;
    form.reset();
}
const closeModalDel = () =>{
    showModalDel.value = false;
}
const save = () =>{
    if(operation.value == 1){
    form.post(route('clientes.store'),{
        onSuccess: () =>{ok('Cliente Created')}
    });
  }
  else{
    form.put(route('clientes.update',v.value.id),{
        onSuccess: () =>{ok('Cliente Update')}
    });
  }
}
const ok = (m) =>{
    if(operation.value == 2){
        closeModalForm();
    } 
    closeModalDel();
    form.reset();
    msj.value = m;
    classMsj.value = 'block';
    setTimeout(()=>{
        classMsj.value = 'hidden';
    },6000);
}
const deleteCliente = () =>{
    form.delete(route('clientes.destroy',v.value.id),{
    onSuccess: () => { ok('Cliente deleted')}
    })
}
</script>

<template>
    <Head title="Clientes" />
    <AuthenticatedLayout>
		<template #header>
			Clientes
            <DarkButton @click="openModalForm(1)">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>


</DarkButton>
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
                    <th class="px-4 py-3">Nombre</th>
                    <th class="px-4 py-3">Apellido</th>
                    <th class="px-4 py-3">Direccion</th>
                    <th class="px-4 py-3">Pais</th>
                    <th class="px-4 py-3">Detalle</th>
                    <th class="px-4 py-3">Editar</th>
                    <th class="px-4 py-3">Borrar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-900">
                    <tr v-for="c,i in clientes" :key="c.id" class="text-white">
                        <td class="px-4 py-3 text-sm">
                            {{ (i+1) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ (c.name) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ (c.last_name) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ (c.direction) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ (c.country.country) }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <SecondaryButton @click="openModalView(c)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>

                                View</SecondaryButton>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <WarningButton @click="openModalForm(2,c)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
</svg>
Ed</WarningButton>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <DangerButton @click="openModalDel(c)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
                                Eliminar</DangerButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
    <Modal :show="showModalView" @close="closeModalView">
        <div class="p-6">
        <p>Cliente: <span class="text-lg font-medium text-gray-900">{{ v.name }}</span></p>
        <p>Direccion: <span class="text-lg font-medium text-gray-900">{{ v.direction }}</span></p>
        <p>Country: <span class="text-lg font-medium text-gray-900">{{ v.country }}</span></p>
        Pedidos:
        <ol>
            <li class="text-lg font-medium text-gray-900" v-for="p,i in v.pedidos">
                {{ (i+1)+')'+p.title }}
            </li>
        </ol>
        </div>
        <div class="m-6 flex justify-end">
        <SecondaryButton @click="closeModalView">Cancel</SecondaryButton>
        </div>
    </Modal>
    <Modal :show="showModalForm" @close="closeModalForm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">{{ title }}</h2>
            <div class="mt-6 mb-6 space-y-6 max-w-xl">
                <InputGroup :text="'Name'" :required="'required'" v-model="form.name" :type="'text'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </InputGroup>
                <InputError class="mt-1" :message="form.errors.name"></InputError>
                <InputGroup :text="'last name'" :required="'required'" v-model="form.last_name" :type="'text'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                    </svg>
                </InputGroup>
                <InputError class="mt-1" :message="form.errors.last_name"></InputError>
                
                <InputGroup :text="'direction'" :required="'required'" v-model="form.direction" :type="'text'">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M8.161 2.58a1.875 1.875 0 0 1 1.678 0l4.993 2.498c.106.052.23.052.336 0l3.869-1.935A1.875 1.875 0 0 1 21.75 4.82v12.485c0 .71-.401 1.36-1.037 1.677l-4.875 2.437a1.875 1.875 0 0 1-1.676 0l-4.994-2.497a.375.375 0 0 0-.336 0l-3.868 1.935A1.875 1.875 0 0 1 2.25 19.18V6.695c0-.71.401-1.36 1.036-1.677l4.875-2.437ZM9 6a.75.75 0 0 1 .75.75V15a.75.75 0 0 1-1.5 0V6.75A.75.75 0 0 1 9 6Zm6.75 3a.75.75 0 0 0-1.5 0v8.25a.75.75 0 0 0 1.5 0V9Z" clip-rule="evenodd" />
                    </svg>
                </InputGroup>
                <InputError class="mt-1" :message="form.errors.direction"></InputError>
                
                <SelectInput :text="'Country'" :required="'required'" v-model="form.country_id" :options="countries">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM6.262 6.072a8.25 8.25 0 1 0 10.562-.766 4.5 4.5 0 0 1-1.318 1.357L14.25 7.5l.165.33a.809.809 0 0 1-1.086 1.085l-.604-.302a1.125 1.125 0 0 0-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 0 1-2.288 4.04l-.723.724a1.125 1.125 0 0 1-1.298.21l-.153-.076a1.125 1.125 0 0 1-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 0 1-.21-1.298L9.75 12l-1.64-1.64a6 6 0 0 1-1.676-3.257l-.172-1.03Z" clip-rule="evenodd" />
                    </svg>
                </SelectInput>
                <InputError class="mt-1" :message="form.errors.country_id"></InputError>
            <PrimaryButton @click="save">Save</PrimaryButton>
            </div>
        </div>
        <div class="m-6 flex justify-end">
        <SecondaryButton @click="closeModalForm">Cancel</SecondaryButton>
        </div>
    </Modal>
    <Modal :show="showModalDel" @close="closeModalDel">
        <div class="p-6">
            <p class="text-2xl  text-gray-500">
                Are you sure delete to
                <span class="text-2xl font-medium text-red-900">
                {{ v.name }}</span>?</p>
                <PrimaryButton @click="deleteCliente">Yes, delete</PrimaryButton>
        </div>
        <div class="m-6 flex justify-end">
        <SecondaryButton @click="closeModalDel">Cancel</SecondaryButton>
        </div>
    </Modal>
	</AuthenticatedLayout>
</template>