<template>
  <div class="min-w-full border border-collapse overflow-hidden rounded-md py-2 bg-gray-200">
    <table class="min-w-full leading-normal">
      <thead>
      <tr class="border-b-2 border-blue-400 bg-gray-200">
        <slot name="header"></slot>
      </tr>
      </thead>
      <tbody>
        <slot name="content"></slot>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  name: "Table",
  props:['content']
}
</script>

<style scoped>

</style>
