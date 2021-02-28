<template>
    <div>
        <!-- Dropdown, First Level Menu -->
        <div v-if="type === 'dropdown'" @click="showSubMenu = !showSubMenu;showLeftMenu()" :class="{'bg-blue-700 hover:bg-blue-800 hover:text-white font-bold':showSubMenu,'hover:text-gray-700':!showSubMenu}"
             class="items-center justify-start w-full py-3 text-gray-300 transition duration-150 ease-in-out bg-gray-700 border-b border-gray-600 shadow-xl cursor-pointer hover:bg-gray-200 focus:text-gray-400 focus:bg-gray-700">
            <div :class="{'flex justify-between w-full pr-4 pl-4':showingLeftMenu}">
                    <div :class="{'flex justify-start space-x-2 items-center':showingLeftMenu, 'flex justify-center items-center':!showingLeftMenu}">
                        <font-awesome-icon :icon="icon ? icon : ''"/>
                        <span v-if="showingLeftMenu ">{{ label }}</span>
                    </div>
                    <div v-if="showingLeftMenu " class="flex justify-end">
                        <MenuTriggerLeft v-if="type === 'dropdown' && showSubMenu" class="w-5 h-5"/>
                        <MenuTriggerDown v-if="type === 'dropdown' && !showSubMenu" class="w-5 h-5"/>
                    </div>
            </div>
        </div>
        <!-- General Menu Item -->
        <div v-if="type !== 'dropdown'">
            <inertia-link :href="
            link != null ?
            linkType == 'route' ? route(link) :
            linkType == 'internal' ? URL(link) :
            linkType == 'external' ? link : '' : ''"
                          :active="
                          link != null ?
                          linkType == 'route' ? route().current(link) :
                          linkType == 'internal' ? URL().current(link) : '' : ''
                          "
                          :class="[{'pl-4 justify-start':showingLeftMenu,'justify-center':!showingLeftMenu},classes]">
                <div :class="{'flex justify-between w-full pr-4':showingLeftMenu}">
                    <div :class="{'flex justify-start items-center space-x-2':showingLeftMenu, 'flex justify-center items-center':!showingLeftMenu}">
                        <font-awesome-icon :icon="icon ? icon : ''"/>
                        <span v-if="showingLeftMenu">{{ label }}</span>
                    </div>
                </div>

            </inertia-link>
        </div>
        <!-- Sub Menu -->
        <div v-if="showSubMenu && showingLeftMenu" :active="active" :class="{'bg-gray-200 min-w-max':showSubMenu}">
            <slot></slot>
        </div>
    </div>
</template>

<script>
//Menu Triger Icons
import MenuTriggerLeft from "@/Components/Icons/General/LeftArrow"
import MenuTriggerDown from "@/Components/Icons/General/DownArrow"

export default {
    props: ['label','link', 'linkType','icon','type','index','active','showingLeftMenu','children'],
    components: {
        MenuTriggerLeft,
        MenuTriggerDown,
    },
    computed: {
        classes() {
            return this.active
                ? 'flex items-center py-3 bg-blue-500 text-white hover:text-gray-100 hover:bg-gray-700 border-b-2 border-indigo-400 font-bold leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'flex border-b border-gray-600 bg-gray-700 items-center py-3 text-gray-300 hover:text-gray-700 hover:bg-gray-200 focus:text-gray-400 focus:bg-gray-700 transition duration-150 ease-in-out shadow-xl'
        }
    },
    data:(vm)=>({
        showSubMenu : vm.searchActive(),
    }),
    methods: {
        showLeftMenu(){
            this.$emit('show-menu')
        },
        searchActive(){
            if(this.children){
            for(let child of this.children){
                if(route().current(child.link)){
                    return true;
                }
            }
            }
            return false
        },
    }
}
</script>
