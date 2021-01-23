<template>
    <div>
        <div class="w-full flex items-center border p-2 rounded-md">
            <input type="text" name="name" class="rounded-l border-r-0 border-gray-300 p-2 w-1/2" placeholder="Name" :value="name" />
            <input type="text" name="phone" class="rounded-r border border-gray-300 p-2 w-1/2" placeholder="Phone" />
            <div class="bg-green-500 rounded-sm ml-2" @click="cloneField">
                <add-icon class="w-6 h-5 text-white"/>
            </div>
        </div>
        <div class="w-full flex items-center border p-2 rounded-md mt-2">
            1. Hamdi KAYA - +90(554)-973-9646
        </div>
    </div>
</template>

<script>
import AddIcon from '@/Components/Icons/General/Plus'
export default {
    components: {
        AddIcon,
    },
    data(){
      return{
          contact: [],
      }
    },
    methods: {
        cloneField: function(){
            this.name = 'Kedi';
        }
    }
}
</script>
