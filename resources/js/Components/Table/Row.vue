<template>
  <tr
    class="bg-white hover:bg-blue-100 hover:shadow"
    :class="{
          'border-b border-gray-400' : id !== count-1,
          'rounded-t' : id === 0,
          'rounded-b' : id === count-1
        }"
  >
    <slot></slot>
  </tr>
</template>

<script>
export default {
  name: "Row",
  props : ['id','count']
}
</script>

<style scoped>

</style>
