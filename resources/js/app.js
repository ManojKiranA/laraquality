require('./bootstrap');

// Import modules...
import Vue from 'vue';
import PrimeVue from 'primevue/config';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import PortalVue from 'portal-vue';
/* Font Awesome */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* Icons */
import { library } from '@fortawesome/fontawesome-svg-core'
import {
  faDotCircle, //Iconless Item
  faSitemap, // Departments
  faUserCog, //Staff
  faUserCircle, //Staff List
  faCogs, //Machines
  faSolarPanel, //Machine List
  faThList, //Types
  faTools, //Maintance
  faClipboardList, //Action
  faRandom, //Order
  faClipboardCheck, //Plan
  faBox, //Products
  faBoxes, //Product List
  faTags, //Product Variation
  faMortarPestle, //Product Recipe
  faSquareFull, //Raw Materials
  faShapes, //Raw Materials List
  faCertificate, //Regulations
  faUserSecret, //Audits
  faLandmark, //Audit Firms
  faCalendar, //Audit Calendar
  faUserShield, //Auditors
  faCheckSquare, //Standards
  faFileAlt, //Documents
  faFolderOpen, //Documents List
  faBalanceScale, //Measurement Tools
  faBezierCurve, //Properties
  faHeartBroken, //Customer Complaints
  faGavel, //Customer Complaint Decisions
  faHandsHelping, //Customers
  faStore,  //Manufacturers
  faPlusCircle, faMinusCircle
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faDotCircle,
    faSitemap,
    faUserCog,
    faUserCircle,
    faCogs,
    faSolarPanel,
    faThList,
    faTools,
    faClipboardList,
    faRandom,
    faClipboardCheck,
    faBox,
    faBoxes,
    faTags,
    faMortarPestle,
    faSquareFull,
    faShapes,
    faCertificate,
    faUserSecret,
    faLandmark,
    faCalendar,
    faUserShield,
    faCheckSquare,
    faFileAlt,
    faFolderOpen,
    faBalanceScale,
    faBezierCurve,
    faHeartBroken,
    faGavel,
    faHandsHelping,
    faStore,
    faPlusCircle,
    faMinusCircle
    )
/* Generate Font Awesome Component */
Vue.component('font-awesome-icon', FontAwesomeIcon)

Vue.config.productionTip = false

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
Vue.use(PrimeVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
