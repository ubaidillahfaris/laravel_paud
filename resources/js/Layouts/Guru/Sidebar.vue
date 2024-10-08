<template>
    <!-- Sidebar Start -->
    <aside class="left-sidebar" v-show="isToggle">
           <!-- Sidebar scroll-->
           <div>
           <div class="brand-logo d-flex align-items-center justify-content-between">
                   <a href="./index.html" class="text-nowrap logo-img">
                       <ApplicationLogo></ApplicationLogo>
                   </a>
               <div @click="toggleState" class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
               <i class="ti ti-x fs-8"></i>
               </div>
           </div>
           <!-- Sidebar navigation-->
           <nav class="sidebar-nav scroll-sidebar" data-simplebar>
               <ul id="sidebarnav">
               <!-- ============================= -->
               <!-- Home -->
               <!-- ============================= -->
               <li class="nav-small-cap">
                   <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                   <span class="hide-menu">Home</span>
               </li>
               <!-- =================== -->
               <!-- Dashboard -->
               <!-- =================== -->

               <li class="sidebar-item" v-for="(item, index) in routeList" :key="index">
                    <template v-if="(item.child != null)">
                            <!-- menu parent -->
                            <div class="sidebar-link has-arrow"
                            @click="()=>{
                                    item.status = !item.status
                                }"
                            :class="{
                                'active' : item.status == true
                            }">
                                    <span v-html="item.icon"></span>
                                    <span class="hide-menu">{{ item.label }}</span>
                            </div>
                            <!-- end menu parent -->


                            <ul :class="{ 
                                'collapse': item.status == false, 
                                'in' : item.status == true, 
                                'first-level': true 
                            }" :aria-expanded="item.expanded == true">
                                <li class="sidebar-item" v-for="(itemChild, index) in item.child">
                                    <Link class="sidebar-link" :class="{
                                        'active' : itemChild.status == true
                                    }" :href="itemChild.route" aria-expanded="false">
                                        <span v-html="itemChild.icon"></span>
                                        <span class="hide-menu">{{itemChild.label}}</span>
                                    </Link>
                                </li>
                            </ul>
                    </template>
                    <template v-else>
                        <Link class="sidebar-link" :class="{
                            'active' : item.status == true
                        }" :href="item.route" aria-expanded="false">
                            <span v-html="item.icon"></span>
                            <span class="hide-menu">{{item.label}}</span>
                        </Link>
                    </template>
               </li>


               
              
               </ul>
              
           </nav>
           <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
               <div class="hstack gap-3">
               <div class="john-img">
                   <!-- <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40" alt=""> -->
               </div>
               <div class="john-title">
                   <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                   <span class="fs-2 text-dark">Designer</span>
               </div>
                   <form :action="route('logout')" method="POST">
                       <button type="submit" class="border-0 bg-transparent text-primary ms-auto" tabindex="0" aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                           <i class="ti ti-power fs-6"></i>
                       </button>
                   </form>
               </div>
           </div>  
           <!-- End Sidebar navigation -->
           </div>
           <!-- End Sidebar scroll-->
       </aside>
       <!--  Sidebar End -->
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { useMainStore } from '@/store';
import { computed } from 'vue';


export default {
   components:{
       ApplicationLogo, Link
   },
   props:{
    showSidebar: Boolean  
   },
   setup() {
        const mainStore = useMainStore();

        const isToggle = computed(() => mainStore.toggleSidebar);
        
        return { 
            isToggle
        };
    },
   data() {
        return {
            isExpanded: false,
            routeList:[ 
                {
                    label : 'Dashboard',
                    route : route('dashboard.guru'),
                    icon : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20.25 10a1.25 1.25 0 1 0-2.5 0zm-14 0a1.25 1.25 0 1 0-2.5 0zm13.866 2.884a1.25 1.25 0 0 0 1.768-1.768zM12 3l.884-.884a1.25 1.25 0 0 0-1.768 0zm-9.884 8.116a1.25 1.25 0 0 0 1.768 1.768zM7 22.25h10v-2.5H7zM20.25 19v-9h-2.5v9zm-14 0v-9h-2.5v9zm15.634-7.884l-9-9l-1.768 1.768l9 9zm-10.768-9l-9 9l1.768 1.768l9-9zM17 22.25A3.25 3.25 0 0 0 20.25 19h-2.5a.75.75 0 0 1-.75.75zm-10-2.5a.75.75 0 0 1-.75-.75h-2.5A3.25 3.25 0 0 0 7 22.25z"/></svg>',
                    status : route().current('dashboard.admin')
                    
                },
                {
                    label : 'RPPH',
                    icon : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><rect width="40" height="32" x="4" y="8" rx="2"/><path d="M32 25v7m-8-16v16m-8-12v12"/></g></svg>',
                    status : route().current('rpph.*'),
                    child : [ 
                        {
                            label : 'Daftar',
                            route : route('rpph.index'),
                            status : route().current('rpph.index'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>'
                        },
                        {
                            label : 'Buat data',
                            route : route('rpph.create'),
                            status : route().current('rpph.create'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>'
                        },
                        
                    ]
                },
                {
                    label : 'Keuangan',
                    icon : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M10 6a2 2 0 0 1 2-2h24a2 2 0 0 1 2 2v38l-7-5l-7 5l-7-5l-7 5zm8 16h12m-12 8h12M18 14h12"/></svg>',
                    status : route().current('tagihan.*') || route().current('tabungan.*'),
                    child : [ 
                        {
                            label : 'Tagihan',
                            route : route('tagihan.index'),
                            status : route().current('tagihan.*'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>'
                        },
                    ]
                },
                
            ]
        };
    },
    mounted() {
        
    },
    methods: {
        toggle(event) {
            console.log(event.target)
            event.preventDefault();
            this.isExpanded = !this.isExpanded;
        }
    }
}
</script>