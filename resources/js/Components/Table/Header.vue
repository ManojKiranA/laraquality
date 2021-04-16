<template>
  <th
    class="px-4 py-3 text-gray-700 uppercase cursor-pointer"
    :class="textAlign"
    @click="sort(fieldKey)">
    <slot></slot>
    <span
      v-if="fieldKey"
      class=" hover:bg-gray-700 hover:text-white w-5 h-5 flex inline-flex justify-center items-center rounded-full">
      <font-awesome-icon v-if="sortVariables.direction === 'asc'" icon="caret-down"/>
      <font-awesome-icon v-if="sortVariables.direction === 'desc'" icon="caret-up"/>
    </span>
  </th>
</template>

<script>
export default {
  name: "Header",
  props : ['align','fieldKey'],
  data(){
    return{
      sortVariables : {
        key : null,
        direction : 'asc'
      }
    }
  },
  computed : {
    textAlign(){
      if(this.align){
        return 'text-'+this.align;
      }else{
        return 'text-left';
      }
    }
  },
  methods:{
    sort(event){
      this.sortVariables.direction = this.sortVariables.direction === 'asc' ? this.sortVariables.direction = 'desc' : this.sortVariables.direction = 'asc';
      this.sortVariables.key = event;
      this.$emit('sort', this.sortVariables);
    }
  }
}
</script>

<style scoped>

</style>
