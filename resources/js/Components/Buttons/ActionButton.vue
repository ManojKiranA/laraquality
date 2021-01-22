<template>
    <div>
        <inertia-link :href="link">
        <button  type="button" :class="classes" class="inline-flex px-5 py-3 mb-3 border rounded-md">
            <back-icon v-if="action == 'back'" class="w-5 h-5 mr-2"/>
            <plus-icon v-if="action == 'submit'" class="w-5 h-5 mr-2"/>
            <span v-if="label">{{ label }}</span>
            <span v-else><slot></slot></span>
        </button>
        </inertia-link>
    </div>
</template>

<script>
//Icons for button
import BackIcon from '@/Components/Icons/General/BackArrow'
import PlusIcon from '@/Components/Icons/General/Plus'

export default {
    props: {
        action:'',
        label:'',
        buttonClass:'',
        icon:'',
        iconClass:'',
        link:''
    },
    components: {
        BackIcon,
        PlusIcon
    },
    computed: {
        classes() {
             if(this.action == 'submit'){
            return 'bg-green-500 text-white border-green-600 hover:text-green-700 focus:text-green-700 hover:bg-green-100 focus:bg-green-100';
             }
            if(this.action == 'back'){
                return 'bg-blue-500 text-white border-blue-600 hover:text-blue-700 focus:text-blue-700 hover:bg-blue-100 focus:bg-blue-100';
            }
        }
    },
}
</script>
