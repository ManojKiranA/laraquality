<template>
    <div class="flex flex-col">
        <!--Label-->
        <label for="for" class="block font-medium text-sm text-gray-700">
            <span v-if="label">{{ label }}</span>
            <span v-else><slot #label></slot></span>
        </label>
        <!--Input Content-->
        <slot></slot>
        <!--Error-->
        <div v-show="error">
            <p class="text-sm text-red-600 mt-2">
                {{ error }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['label','for','error']
}
</script>
