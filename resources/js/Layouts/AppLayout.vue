<template>
    <div>
        <jet-banner />
        <div class="flex h-screen bg-gray-100 ">
            <!--Left Menu-->
            <left-menu :showingLeftMenu="showingLeftMenu" class="bg-gray-800">
                <div v-for="(item, index) in leftMenu">
                       <left-menu-item :label="item.label" :link="item.link" :linkType="item.linkType" :icon="item.icon" :type="item.type" :showingLeftMenu="showingLeftMenu" @show-menu="showLeftMenu">
                           <div v-for="subItem in item.items">
                               <left-menu-sub-item :label="subItem.label" :link="subItem.link" :linkType="subItem.linkType" :icon="subItem.icon" :type="subItem.type"/>
                           </div>
                       </left-menu-item>
                </div>
            </left-menu>
            <!--Content-->
            <div class="flex-grow text-gray-800 overflow-y-auto">
                <!--Top Menu-->
                <div class="flex items-center h-20 px-6 bg-white sm:px-10">
                    <!--Left Menu Trigger-->
                    <div class="mr-8 cursor-pointer" @click="showingLeftMenu = ! showingLeftMenu">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </div>
                    <!--Search Box-->
                    <div class="relative w-full max-w-md sm:-ml-2">
                        <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" class="absolute h-6 w-6 mt-2.5 ml-2 text-gray-400">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        <input type="text" role="search" placeholder="Search..." class="w-full py-2 pl-10 pr-4 placeholder-gray-400 border-4 border-transparent rounded-lg focus:bg-gray-50" />
                    </div>
                    <!--User Menu-->
                    <div class="flex items-center flex-shrink-0 ml-auto">
                        <!--Teams-->
                        <jet-dropdown align="right" width="60" v-if="$page.props.jetstream.hasTeamFeatures">
                            <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                            </template>

                            <template #content>
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-dropdown-link :href="route('teams.show', $page.props.user.current_team)">
                                            Team Settings
                                        </jet-dropdown-link>

                                        <jet-dropdown-link :href="route('teams.create')" v-if="$page.props.jetstream.canCreateTeams">
                                            Create New Team
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.props.user.all_teams">
                                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                                <jet-dropdown-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.props.user.current_team_id" class="w-5 h-5 mr-2 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-dropdown-link>
                                            </form>
                                        </template>
                                    </template>
                                </div>
                            </template>
                        </jet-dropdown>
                        <!--User's Info-->
                        <drop-down align="right" width="48">
                            <template #trigger>
                                <button class="relative inline-flex items-center p-2 rounded-lg hover:bg-gray-100 focus:bg-gray-100">
                                    <!--Staff info-->
                                    <div class="hidden md:flex md:flex-col md:items-end md:leading-tight" >
                                        <span class="font-semibold">{{ $page.props.user.name }}</span>
                                        <span class="text-sm text-gray-600">Quality Engineer</span>
                                    </div>
                                    <!--Staff picture-->
                                    <span class="w-12 h-12 ml-2 mr-2 overflow-hidden bg-gray-100 rounded-full sm:ml-3">
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                            <img class="object-cover w-full h-full rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                        </button>
                                    </span>
                                    <!--Right arrow-->
                                    <svg aria-hidden="true" viewBox="0 0 20 20" fill="currentColor" class="hidden w-6 h-6 text-gray-300 sm:block">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </template>

                            <template #content>
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Account
                                </div>

                                <jet-dropdown-link :href="route('profile.show')">
                                    Profile
                                </jet-dropdown-link>

                                <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                    API Tokens
                                </jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <jet-dropdown-link as="button">
                                        Logout
                                    </jet-dropdown-link>
                                </form>
                            </template>
                        </drop-down>
                        <!--Small User's Info-->
                        <div class="flex items-center -mr-2 sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <!-- Responsive Navigation Menu -->
                        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                            <div class="pt-2 pb-3 space-y-1">
                                <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </jet-responsive-nav-link>
                            </div>

                            <!-- Responsive Settings Options -->
                            <div class="pt-4 pb-1 border-t border-gray-200">
                                <div class="flex items-center px-4">
                                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3" >
                                        <img class="object-cover w-10 h-10 rounded-full" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                                    </div>

                                    <div>
                                        <div class="text-base font-medium text-gray-800">{{ $page.props.user.name }}</div>
                                        <div class="text-sm font-medium text-gray-500">{{ $page.props.user.email }}</div>
                                    </div>
                                </div>

                                <div class="mt-3 space-y-1">
                                    <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                                        Profile
                                    </jet-responsive-nav-link>

                                    <jet-responsive-nav-link :href="route('api-tokens.index')" :active="route().current('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures">
                                        API Tokens
                                    </jet-responsive-nav-link>

                                    <!-- Authentication -->
                                    <form method="POST" @submit.prevent="logout">
                                        <jet-responsive-nav-link as="button">
                                            Logout
                                        </jet-responsive-nav-link>
                                    </form>

                                    <!-- Team Management -->
                                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                                        <div class="border-t border-gray-200"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Manage Team
                                        </div>

                                        <!-- Team Settings -->
                                        <jet-responsive-nav-link :href="route('teams.show', $page.props.user.current_team)" :active="route().current('teams.show')">
                                            Team Settings
                                        </jet-responsive-nav-link>

                                        <jet-responsive-nav-link :href="route('teams.create')" :active="route().current('teams.create')">
                                            Create New Team
                                        </jet-responsive-nav-link>

                                        <div class="border-t border-gray-200"></div>

                                        <!-- Team Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            Switch Teams
                                        </div>

                                        <template v-for="team in $page.props.user.all_teams">
                                            <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                                <jet-responsive-nav-link as="button">
                                                    <div class="flex items-center">
                                                        <svg v-if="team.id == $page.props.user.current_team_id" class="w-5 h-5 mr-2 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <div>{{ team.name }}</div>
                                                    </div>
                                                </jet-responsive-nav-link>
                                            </form>
                                        </template>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <!--Notification and Logout Buttons-->
                        <div class="pl-3 ml-3 space-x-1 border-l flex -mr-4">
                            <!--Notifications-->
                            <drop-down align="right" width="48">
                                <template #trigger>
                                    <button class="relative p-2 text-gray-400 rounded-full hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600">
                                        <span class="sr-only">Notifications</span>
                                        <span class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-red-500 rounded-full"></span>
                                        <span class="absolute top-0 right-0 w-2 h-2 mt-1 mr-2 bg-red-500 rounded-full animate-ping"></span>
                                        <svg aria-hidden="true" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                    </button>
                                </template>
                                <template #content>
                                    <!--Pending Works-->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Pending works
                                    </div>
                                    <!--To-Do-->
                                    <jet-dropdown-link href="test">
                                        2 To-Do's
                                    </jet-dropdown-link>
                                    <!--Calibration-->
                                    <jet-dropdown-link href="test">
                                        5 Calibration Task's
                                    </jet-dropdown-link>
                                    <!--Messages-->
                                    <div class="border-t border-gray-100"></div>
                                    <jet-dropdown-link href="test">
                                        9 Messages
                                    </jet-dropdown-link>
                                </template>
                            </drop-down>
                            <!--Logout-->
                            <form @submit.prevent="logout">
                                <button class="relative flex-row flex p-2 text-white bg-red-500 rounded-full hover:bg-gray-100 hover:text-gray-600 focus:bg-gray-100 focus:text-gray-600">
                                    <svg aria-hidden="true" fill="none" viewBox="0 0 20 24" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Content-->
                <div class="p-6 space-y-6 sm:p-10">
                    <!--Content Header-->
                    <div class="flex flex-col justify-between space-y-6 md:space-y-0 md:flex-row">
                        <!--Page Header-->
                        <header class="mr-6">
                            <!--Page Heading-->
                            <h1 class="mb-2 text-4xl font-semibold">
                                <slot name="header"></slot>
                            </h1>
                            <!--Page subheading-->
                            <h2 class="text-gray-600 ml-0.5">
                                <slot name="sub-header"></slot>
                            </h2>
                        </header>
                        <!--Shortcuts-->
                        <div class="flex flex-wrap items-start justify-end -mb-3">
                            <slot name="action-buttons"></slot>
                        </div>
                    </div>
                    <!--Content-->
                    <main class="flex">
                        <slot></slot>
                    </main>
                    <section class="font-semibold text-right text-gray-500">
                        <a href="#" class="text-blue-600 hover:underline">Recreated on Codepen</a> with <a href="https://tailwindcss.com/" class="text-teal-400 hover:underline">Tailwind CSS</a> by Sinan AYDOĞAN, <a href="https://dribbble.com/shots/10711741-Free-UI-Kit-for-Figma-Online-Courses-Dashboard" class="text-blue-600 hover:underline">original design</a> made by Chili Labs and <a href="https://codepen.io/azrikahar/pen/abZzaga"  class="text-blue-600 hover:underline" target="_blank">abZzaga</a>
                    </section>
                </div>
            </div>
            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        </div>
    </div>
</template>

<script>
import Logo from '@/Components/Icons/General/Logo'
import LeftMenu from '@/Components/Menu/LeftMenu'
import LeftMenuItem from '@/Components/Menu/LeftMenuItem'
import LeftMenuSubItem from '@/Components/Menu/LeftMenuSubItem'
import DropDown from '@/Components/ViewItems/DropDown'
//Section Icons
import SectionIconAction from '@/Components/Icons/Sections/Action'
import SectionIconAudit from '@/Components/Icons/Sections/Audit'
import SectionIconAuditFirm from '@/Components/Icons/Sections/AuditFirm'
import SectionIconAuditor from '@/Components/Icons/Sections/Auditor'
import SectionIconAudits from '@/Components/Icons/Sections/Audits'
import SectionIconClaim from '@/Components/Icons/Sections/Claim'
import SectionIconClaimDecision from '@/Components/Icons/Sections/ClaimDecision'
import SectionIconClaims from '@/Components/Icons/Sections/Claims'
import SectionIconCustomer from '@/Components/Icons/Sections/Customer'
import SectionIconDepartment from '@/Components/Icons/Sections/Department'
import SectionIconDocument from '@/Components/Icons/Sections/Document'
import SectionIconDocuments from '@/Components/Icons/Sections/Documents'
import SectionIconJobDescription from '@/Components/Icons/Sections/JobDescription'
import SectionIconMachine from '@/Components/Icons/Sections/Machine'
import SectionIconMachines from '@/Components/Icons/Sections/Machines'
import SectionIconMachineType from '@/Components/Icons/Sections/MachineType'
import SectionIconMaintenance from '@/Components/Icons/Sections/Maintenance'
import SectionIconMeasurementTool from '@/Components/Icons/Sections/MeasurementTool'
import SectionIconMeasurementTools from '@/Components/Icons/Sections/MeasurementTools'
import SectionIconPlan from '@/Components/Icons/Sections/Plan'
import SectionIconProduct from '@/Components/Icons/Sections/Product'
import SectionIconProducts from '@/Components/Icons/Sections/Products'
import SectionIconProductType from '@/Components/Icons/Sections/ProductType'
import SectionIconProductVariations from '@/Components/Icons/Sections/ProductVariations'
import SectionIconRawMaterial from '@/Components/Icons/Sections/RawMaterial'
import SectionIconRawMaterials from '@/Components/Icons/Sections/RawMaterials'
import SectionIconRecipe from '@/Components/Icons/Sections/Recipe'
import SectionIconRegulation from '@/Components/Icons/Sections/Regulation'
import SectionIconStaff from '@/Components/Icons/Sections/Staff'
import SectionIconStaff2 from '@/Components/Icons/Sections/Staff2'
import SectionIconStandard from '@/Components/Icons/Sections/Standard'
import SectionIconType from '@/Components/Icons/Sections/Type'
//Others
import JetBanner from '@/Jetstream/Banner'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
import PanelMenu from 'primevue/panelmenu'


export default {
    components: {
        Logo,
        LeftMenu,
        LeftMenuItem,
        LeftMenuSubItem,
        DropDown,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        PanelMenu,
        SectionIconAction,
        SectionIconAudit,
        SectionIconAuditFirm,
        SectionIconAuditor,
        SectionIconAudits,
        SectionIconClaim,
        SectionIconClaimDecision,
        SectionIconClaims,
        SectionIconCustomer,
        SectionIconDepartment,
        SectionIconDocument,
        SectionIconDocuments,
        SectionIconJobDescription,
        SectionIconMachine,
        SectionIconMachines,
        SectionIconMachineType,
        SectionIconMaintenance,
        SectionIconMeasurementTool,
        SectionIconMeasurementTools,
        SectionIconPlan,
        SectionIconProduct,
        SectionIconProducts,
        SectionIconProductType,
        SectionIconProductVariations,
        SectionIconRawMaterial,
        SectionIconRawMaterials,
        SectionIconRecipe,
        SectionIconRegulation,
        SectionIconStaff,
        SectionIconStaff2,
        SectionIconStandard,
        SectionIconType,
    },

    data() {
        return {
            showingNavigationDropdown: false,
            showingLeftMenu: true,
            showingSubItem: 0,
            showingUserMenu: false,
            leftMenu: [
                {
                    label: 'Departments',
                    icon:'SectionIconDepartment',
                    link:'department.index',
                    linkType:'route',
                    type:'standard',
                },
                {
                    label: 'Staff',
                    icon:'SectionIconStaff2',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Staff',
                            icon:'SectionIconStaff',
                            link:'staff.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Job Description',
                            icon:'SectionIconJobDescription',
                            link:'job-description.index',
                            linkType:'route',
                            type:'standard',
                        }
                    ]
                },
                {
                    label: 'Machine',
                    icon:'SectionIconMachine',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Machines',
                            icon:'SectionIconMachines',
                            link:'machine.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Machine Types',
                            icon:'SectionIconType',
                            link:'machine-type.index',
                            linkType:'route',
                            type:'standard',
                        }
                    ]
                },
                {
                    label: 'Maintenance',
                    icon:'SectionIconMaintenance',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Maintenance Orders',
                            icon:'SectionIconAction',
                            link:'maintenance.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Maintenance Actions',
                            icon:'SectionIconAction',
                            link:'maintenance-action.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Maintenance Plans',
                            icon:'SectionIconPlan',
                            link:'maintenance-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Maintenance Types',
                            icon:'SectionIconType',
                            link:'maintenance-type.index',
                            linkType:'standard',
                            type:'dropdown',
                        }
                    ]
                },
                {
                    label: 'Product',
                    icon:'SectionIconProduct',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Products',
                            icon:'SectionIconProducts',
                            link:'product.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Products Types',
                            icon:'SectionIconType',
                            link:'product-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Products Variations',
                            icon:'SectionIconProductVariations',
                            link:'product-variation.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Products Quality Plans',
                            icon:'SectionIconPlan',
                            link:'product-quality-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Recipes',
                            icon:'SectionIconRecipe',
                            link:'recipe.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Raw Material',
                    icon:'SectionIconRawMaterial',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Raw Materials',
                            icon:'SectionIconRawMaterials',
                            link:'raw-material.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Raw Material Types',
                            icon:'SectionIconType',
                            link:'raw-material-types.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Raw Material Quality Plans',
                            icon:'SectionIconPlan',
                            link:'raw-material-quality-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Regulation',
                    icon:'SectionIconRegulation',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Audits',
                            icon:'SectionIconAudits',
                            link:'audit.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Audit Calendar',
                            icon:'SectionIconPlan',
                            link:'audit-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Audit Firms',
                            icon:'SectionIconAuditFirm',
                            link:'audit-firm.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Audit Types',
                            icon:'SectionIconType',
                            link:'audit-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Auditors',
                            icon:'SectionIconAuditor',
                            link:'auditor.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Standards',
                            icon:'SectionIconStandard',
                            link:'standard.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Document',
                    icon:'SectionIconDocument',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Documents',
                            icon:'SectionIconDocuments',
                            link:'document.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Document Types',
                            icon:'SectionIconType',
                            link:'document-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Measurement Tool',
                    icon:'SectionIconMeasurementTool',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Measurement Tools',
                            icon:'SectionIconMeasurementTools',
                            link:'measurement-tool.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Measurement Tool Actions',
                            icon:'SectionIconAction',
                            link:'measurement-tool-action.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Measurement Tool Types',
                            icon:'SectionIconType',
                            link:'measurement-tool-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Measurement Tool Properties',
                            icon:'SectionIconType',
                            link:'measurement-tool-property.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Claim',
                    icon:'SectionIconClaim',
                    link:'',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Claims',
                            icon:'SectionIconClaims',
                            link:'claim.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Claim Actions',
                            icon:'SectionIconAction',
                            link:'claim-action.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Claim Decisions',
                            icon:'SectionIconClaimDecision',
                            link:'claim-decision.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Claim Types',
                            icon:'SectionIconType',
                            link:'claim-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Claim Properties',
                            icon:'SectionIconType',
                            link:'claim-property.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Customer',
                    icon:'SectionIconCustomer',
                    link:'customer.index',
                    linkType:'route',
                    type:'dropdown',
                }
                ]
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {
            this.$inertia.post(route('logout'));
        },
        showLeftMenu(){
            this.showingLeftMenu = true
        }

    }
}
</script>
