<template>
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
           <!-- Sidebar scroll-->
           <div>
           <div class="brand-logo d-flex align-items-center justify-content-between">
                   <a href="./index.html" class="text-nowrap logo-img">
                       <ApplicationLogo></ApplicationLogo>
                   </a>
               <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
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
               <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded">
               <div class="d-flex">
                   <div class="unlimited-access-title">
                   <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Unlimited Access</h6>
                   <button class="btn btn-primary fs-2 fw-semibold lh-sm">Signup</button>
                   </div>
                   <div class="unlimited-access-img">
                   <!-- <img src="../../dist/images/backgrounds/rocket.png" alt="" class="img-fluid"> -->
                   </div>
               </div>
               </div>
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

export default {
   components:{
       ApplicationLogo, Link
   },
   data() {
        return {
            isExpanded: false,
            routeList:[ 
                {
                    label : 'Dashboard',
                    route : route('dashboard.admin'),
                    icon : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20.25 10a1.25 1.25 0 1 0-2.5 0zm-14 0a1.25 1.25 0 1 0-2.5 0zm13.866 2.884a1.25 1.25 0 0 0 1.768-1.768zM12 3l.884-.884a1.25 1.25 0 0 0-1.768 0zm-9.884 8.116a1.25 1.25 0 0 0 1.768 1.768zM7 22.25h10v-2.5H7zM20.25 19v-9h-2.5v9zm-14 0v-9h-2.5v9zm15.634-7.884l-9-9l-1.768 1.768l9 9zm-10.768-9l-9 9l1.768 1.768l9-9zM17 22.25A3.25 3.25 0 0 0 20.25 19h-2.5a.75.75 0 0 1-.75.75zm-10-2.5a.75.75 0 0 1-.75-.75h-2.5A3.25 3.25 0 0 0 7 22.25z"/></svg>',
                    status : route().current('dashboard.admin')
                    
                },
                {
                    label : 'Administrasi',
                    icon : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"><rect width="40" height="32" x="4" y="8" rx="2"/><path d="M32 25v7m-8-16v16m-8-12v12"/></g></svg>',
                    status : route().current('ppdb.*') || route().current('tahun_ajaran.*') || route().current('program_layanan.*'),
                    child : [ 
                        {
                            label : 'PPDB',
                            route : route('ppdb.index'),
                            status : route().current('ppdb.*'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>'
                        },
                        {
                            label : 'Tahun Ajaran',
                            route : route('tahun_ajaran.index'),
                            status : route().current('tahun_ajaran.*'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>'
                        },
                        {
                            label : 'Kurikulum',
                            route : route('kurikulum.index'),
                            status : route().current('kurikulum.*'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>'
                        },
                        {
                            label : 'Program/Layanan',
                            route : route('program_layanan.index'),
                            icon: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="M10 5a5 5 0 1 0 0 10a5 5 0 0 0 0-10m-6 5a6 6 0 1 1 12 0a6 6 0 0 1-12 0" clip-rule="evenodd"/></svg>',
                            status : route().current('program_layanan.*')
                            
                        },
                    ]
                },
                {
                    label : 'Kelas',
                    route : route('kelas.index'),
                    icon : '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M17.25 2A2.75 2.75 0 0 1 20 4.75v14.5A2.75 2.75 0 0 1 17.25 22H6.75A2.75 2.75 0 0 1 4 19.249V4.75c0-1.26.846-2.32 2-2.647V3.75c-.304.228-.5.59-.5 1v14.498c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25V4.75c0-.69-.56-1.25-1.25-1.25H15V2zM14 2v8.139c0 .747-.8 1.027-1.29.764l-.082-.052l-2.126-1.285l-2.078 1.251c-.5.36-1.33.14-1.417-.558L7 10.14V2zm-1.5 1.5h-4v5.523l1.573-.949a.92.92 0 0 1 .818-.024l1.61.974z"/></svg>',
                    status : route().current('kelas.*')
                    
                },
            ]
        };
    },
    mounted() {
        
    },
    methods: {
        toggle(event) {
            event.preventDefault();
            this.isExpanded = !this.isExpanded;
        }
    }
}
</script>