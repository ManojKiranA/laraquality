<template>
  <td
    class="px-4 py-2"
    :class="textAlign">
    <slot></slot>
  </td>
</template>

<script>
export default {
  name: "Cell",
  props: ['align'],
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
