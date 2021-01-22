<template>
    <div>
        <form @submit.prevent="$emit('submitted')">
            <!--Form Body-->
            <div class="mt-5 md:mt-0 md:col-span-2 bg-white shadow sm:rounded-md">
                    <slot></slot>
                <!--Submit Button-->
                <div class="flex col-span-12 justify-end space-x-2 mr-6 pb-5">
                    <general-button @click.native="reset" type="button" label="Reset" icon="reset"  buttonClass="justify-center bg-yellow-500"/>
                    <general-button type="submit" label="Save" icon="plus"  buttonClass="justify-center bg-green-500"/>
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6" v-if="hasActions">
                    <slot name="actions"></slot>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import GeneralButton from '@/Components/Buttons/GeneralButton'

export default {
    components: {
        GeneralButton,
    },

    computed: {
        hasActions() {
            return !! this.$slots.actions
        }
    },

    methods: {
        reset() {
            this.$emit('reset')
        },
    }
}
</script>
