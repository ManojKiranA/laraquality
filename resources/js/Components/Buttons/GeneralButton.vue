<template>
    <div>
        <button :type="type" :class="buttonClass" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
            <component v-bind:is="icon" :class="iconClass" class="w-5 h-5 mr-2"></component>
            <span v-if="label">{{ label }}</span>
            <span v-else><slot></slot></span>
        </button>
    </div>
</template>

<script>
//Icons for button
import Plus from '@/Components/Icons/General/Plus'
import Reset from '@/Components/Icons/General/Reset'

export default {
    props: {
        type: {
            type: String,
            default: 'submit',
        },
        label:'',
        buttonClass:'',
        icon:'',
        iconClass:'',
    },
    components: {
        Plus,
        Reset
    }
}
</script>
