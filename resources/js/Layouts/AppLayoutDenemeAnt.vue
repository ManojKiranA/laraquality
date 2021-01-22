<template>
    <div class="h-screen">
        <jet-banner />
        <a-layout id="components-layout-demo-custom-trigger" class="h-screen">
            <a-layout-sider
                v-model="collapsed"
                width="250px"
                :trigger="null"
                collapsible>
                <!--Logo-->
                <div class="px-2 py-3 bg-blue-600 items-center flex justify-center">
                    <Logo class="h-10 w-10 text-white" />
                    <span v-if="!collapsed" class="ml-2 text-2xl text-white">LaraQuality</span>
                </div>
                <a-menu
                    :default-selected-keys="['1']"
                    :default-open-keys="['2']"
                    mode="inline"
                    theme="dark"
                    :inline-collapsed="collapsed">
                    <template v-for="item in leftMenu">
                        <a-menu-item v-if="!item.items" :key="item.key">
                            <a :href="item.linkType=='route' ? route(item.link):null">
                                <component v-bind:is="item.icon" class="w-5 h-5 mr-2 -ml-2"></component>
                                <span>{{ item.label }}</span>
                            </a>
                        </a-menu-item>
                        <sub-menu v-else :key="item.key" :menu-info="item" />
                    </template>
                </a-menu>
            </a-layout-sider>
            <a-layout>
                <a-layout-header style="background: #fff; padding: 0">
                    <a-icon
                        class="hover:text-blue-500 text-2xl ml-6 cursor-pointer"
                        :type="collapsed ? 'menu-unfold' : 'menu-fold'"
                        @click="toggleCollapsed"
                    />
                </a-layout-header>
                <a-layout-content
                    :style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '280px' }"
                >
                    <slot></slot>
                </a-layout-content>
            </a-layout>
        </a-layout>
        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>

import Logo from '@/Components/Icons/General/Logo'
import { Menu } from 'ant-design-vue'
import SectionIconAction from "@/Components/Icons/Sections/Action";
import SectionIconAudit from "@/Components/Icons/Sections/Audit";
import SectionIconAuditFirm from "@/Components/Icons/Sections/AuditFirm";
import SectionIconAuditor from "@/Components/Icons/Sections/Auditor";
import SectionIconAudits from "@/Components/Icons/Sections/Audits";
import SectionIconClaim from "@/Components/Icons/Sections/Claim";
import SectionIconClaimDecision from "@/Components/Icons/Sections/ClaimDecision";
import SectionIconClaims from "@/Components/Icons/Sections/Claims";
import SectionIconCustomer from "@/Components/Icons/Sections/Customer";
import SectionIconDepartment from "@/Components/Icons/Sections/Department";
import SectionIconDocument from "@/Components/Icons/Sections/Document";
import SectionIconDocuments from "@/Components/Icons/Sections/Documents";
import SectionIconJobDescription from "@/Components/Icons/Sections/JobDescription";
import SectionIconMachine from "@/Components/Icons/Sections/Machine";
import SectionIconMachines from "@/Components/Icons/Sections/Machines";
import SectionIconMachineType from "@/Components/Icons/Sections/MachineType";
import SectionIconMaintenance from "@/Components/Icons/Sections/Maintenance";
import SectionIconMeasurementTool from "@/Components/Icons/Sections/MeasurementTool";
import SectionIconMeasurementTools from "@/Components/Icons/Sections/MeasurementTools";
import SectionIconPlan from "@/Components/Icons/Sections/Plan";
import SectionIconProduct from "@/Components/Icons/Sections/Product";
import SectionIconProducts from "@/Components/Icons/Sections/Products";
import SectionIconProductType from "@/Components/Icons/Sections/ProductType";
import SectionIconProductVariations from "@/Components/Icons/Sections/ProductVariations";
import SectionIconRawMaterial from "@/Components/Icons/Sections/RawMaterial";
import SectionIconRawMaterials from "@/Components/Icons/Sections/RawMaterials";
import SectionIconRecipe from "@/Components/Icons/Sections/Recipe";
import SectionIconRegulation from "@/Components/Icons/Sections/Regulation";
import SectionIconStaff from "@/Components/Icons/Sections/Staff";
import SectionIconStaff2 from "@/Components/Icons/Sections/Staff2";
import SectionIconStandard from "@/Components/Icons/Sections/Standard";
import SectionIconType from "@/Components/Icons/Sections/Type";

// export default {
//   props: ['menuInfo'],
// };
const SubMenu = {
    template: `
        <template functional>
            <a-sub-menu :key="props.menuInfo.key">
     <span slot="title">
       <a-icon type="mail" /><span>{{ props.menuInfo.title }}</span>
     </span>
                <template v-for="item in props.menuInfo.children">
                    <a-menu-item v-if="!item.children" :key="item.key">
                        <a-icon type="pie-chart" />
                        <span>{{ item.title }}</span>
                    </a-menu-item>
                    <sub-menu v-else :key="item.key" :menu-info="item" />
                </template>
            </a-sub-menu>
        </template>
    `,
    name: 'SubMenu',
    // must add isSubMenu: true
    isSubMenu: true,
    components:{
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
    props: {
        ...Menu.SubMenu.props,
        // Cannot overlap with properties within Menu.SubMenu.props
        menuInfo: {
            type: Object,
            default: () => ({}),
        },
    },
};
export default {
    components:{
        Logo,
        'sub-menu': SubMenu,
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
    data(){
        return{
            collapsed:false,
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
                            icon:'SectionIconAudit',
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
        toggleCollapsed() {
            this.collapsed = !this.collapsed;
        },
    },
}
</script>
