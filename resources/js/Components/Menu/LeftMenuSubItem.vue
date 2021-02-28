<template>
    <inertia-link :href="
    link != null ?
    linkType == 'route' ? route(link) :
    linkType == 'internal' ? URL(link) :
    linkType == 'external' ? link : '#' : '#'"
                  :active="
                  link != null ?
                  linkType == 'route' ? route().current(link) :
                  linkType == 'internal' ? URL().current(link) : '' : ''
                  "
                  class="w-full"
                  :class="{
                      'inline-flex border-b border-gray-600 bg-yellow-400 bg-opacity-30 items-center pl-4 py-3 text-gray-800 hover:text-gray-700 hover:bg-gray-200 focus:text-gray-400 focus:bg-gray-700 justify-start transition duration-150 ease-in-out shadow-xl':route().current(link),
                      'inline-flex border-b border-gray-600 bg-gray-700 bg-opacity-30 items-center pl-4 py-3 text-gray-800 hover:text-gray-700 hover:bg-gray-200 focus:text-gray-400 focus:bg-gray-700 justify-start transition duration-150 ease-in-out shadow-xl':!route().current(link),
}">
        <div class="flex justify-between w-full pr-4">
            <div class="flex items-center justify-start space-x-2">
                <font-awesome-icon :icon="icon ? icon : ''"/>
                <span>{{ label }}</span>
            </div>
            <!-- <div class="flex justify-end">
                <MenuTriggerLeft v-if="type === dropdown" class="w-5 h-5"/>
                <MenuTriggerDown v-if="type === dropdown" class="w-5 h-5"/>
            </div> -->
        </div>
    </inertia-link>
</template>

<script>
//Menu Triger Icons
import MenuTriggerLeft from "@/Components/Icons/General/LeftArrow"
import MenuTriggerDown from "@/Components/Icons/General/DownArrow"

export default {
    props: ['label','link', 'linkType','icon','type','active'],
    components: {
        MenuTriggerLeft,
        MenuTriggerDown,
    },
}
</script>
