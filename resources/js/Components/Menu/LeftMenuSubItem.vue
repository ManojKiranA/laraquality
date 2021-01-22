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
                  class="w-full" :class="classes">
        <div class="flex justify-between w-full pr-4">
            <div class="flex justify-start space-x-2">
                <component v-bind:is="icon" class="w-5 h-5"></component>
                <span>{{ label }}</span>
            </div>
            <div class="flex justify-end">
                <MenuTriggerLeft v-if="type == dropdown" class="w-5 h-5"/>
                <MenuTriggerDown v-if="type == dropdown" class="w-5 h-5"/>
            </div>
        </div>
    </inertia-link>
</template>

<script>
//Sections
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
//Menu Triger Icons
import MenuTriggerLeft from "@/Components/Icons/General/LeftArrow"
import MenuTriggerDown from "@/Components/Icons/General/DownArrow"

export default {
    props: ['label','link', 'linkType','icon','type','active'],
    components: {
        MenuTriggerLeft,
        MenuTriggerDown,
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
    computed: {
        classes() {
            return this.active
                ? 'inline-flex items-center pl-4 py-3 bg-blue-500 text-white hover:text-gray-100 hover:bg-gray-700 border-b-2 border-indigo-400 font-bold leading-5 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
                : 'inline-flex border-b border-gray-600 bg-gray-700 bg-opacity-30 items-center pl-4 py-3 text-gray-800 hover:text-gray-700 hover:bg-gray-200 focus:text-gray-400 focus:bg-gray-700 justify-start transition duration-150 ease-in-out shadow-xl'
        }
    }
}
</script>
