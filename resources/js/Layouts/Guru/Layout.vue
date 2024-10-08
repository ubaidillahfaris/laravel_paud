<template>
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  
    data-layout="vertical" data-sidebartype="full" 
    data-sidebar-position="fixed" data-header-position="fixed">
       
       <Sidebar />

       <div :class="{
        'body-wrapper' : toggleSidebar,
        'p-4' : !toggleSidebar
       }">
         
         <!-- Nabar -->
         <Navbar></Navbar>
         <!-- end Nabar -->

         <div :class="{
            'container-fluid' : toggleSidebar
         }">
             <slot></slot>
       </div>
   </div>

    </div>
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Sidebar from '@/Layouts/Guru/Sidebar.vue';
import Navbar from '@/Layouts/Guru/Navbar.vue';
import { useMainStore } from '@/store';
import { computed } from 'vue';
export default{
    components:{
        ApplicationLogo, Sidebar,Navbar
    },
    setup() {
        const mainStore = useMainStore();
        const toggleSidebar = computed(() => mainStore.toggleSidebar);
        return { toggleSidebar };
    }
}
</script>