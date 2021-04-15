<template>
  <th
    class="px-4 py-3 text-gray-700 uppercase"
    :class="textAlign">
    <slot></slot>
  </th>
</template>

<script>
export default {
  name: "Header",
  props : ['align'],
  computed : {
    textAlign(){
      if(this.align){
        return 'text-'+this.align;
      }else{
        return 'text-left';
      }
    }
  }
}
</script>

<style scoped>

</style>
