<script setup>
import Form from './Form.vue';
const props = defineProps({
    clientes:{type:Object},
    pedido:{type:Object},
    clientesOfPedido:{type:Object},
});
</script>

<template>
    <Form :clientes="clientes" :book="book" 
     :clientesOfPedido="clientesOfPedido"/>
</template>