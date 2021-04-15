<template>
  <app-layout>
    <!--Header-->
    <template #header>
      Products
    </template>
    <!--Sub Header-->
    <template #sub-header>
      All of products in your company
    </template>
    <!--Action Buttons-->
    <template #action-buttons>
      <action-button label="Create New Product" :link="route('product.create')" action="submit"/>
    </template>
    <template #content>
      <Table>
        <template #header>
          <table-header>Name</table-header>
          <table-header>Code</table-header>
          <table-header>Department</table-header>
          <table-header>Type</table-header>
          <table-header>Standard</table-header>
          <table-header align="center">Certification</table-header>
        </template>
        <template #content>
          <table-row v-for="(item,index) in products.data" :key="index" :id="index" :count="products.data.length">
            <table-cell>{{ item.name }}</table-cell>
            <table-cell>{{ item.code }}</table-cell>
            <table-cell>{{ item.department }}</table-cell>
            <table-cell>{{ item.productType }}</table-cell>
            <table-cell>{{ item.standard }}</table-cell>
            <table-cell align="center">
              <span v-if="item.is_certified" class="text-green-500">
                <font-awesome-icon icon="plus-circle"/>
              </span>
              <span v-else class="text-red-500">
                <font-awesome-icon icon="minus-circle"/>
              </span>
            </table-cell>
          </table-row>
        </template>
      </Table>
    </template>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import ActionButton from'@/Components/Buttons/ActionButton';
import Table from '@/Components/Table/Table'
import TableHeader from '@/Components/Table/Header'
import TableRow from '@/Components/Table/Row'
import TableCell from '@/Components/Table/Cell'
export default {
  name: "Index",
  props : ['products'],
  components : {
    AppLayout,
    ActionButton,
    Table,
    TableHeader,
    TableRow,
    TableCell
  },
  data(){
    return{

    }
  }
}
</script>

<style scoped>

</style>
