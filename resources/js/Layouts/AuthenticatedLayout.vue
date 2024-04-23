<template>
     <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  
     data-layout="vertical" data-sidebartype="full" 
     data-sidebar-position="fixed" data-header-position="fixed">
        
        <Sidebar></Sidebar>

        <slot></slot>

     </div>
</template>

<script>
    import { ref } from 'vue';
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import NavLink from '@/Components/NavLink.vue';
    import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
    import { Link } from '@inertiajs/vue3';
    import Sidebar from '@/Layouts/Sidebar.vue';

export default{
    components:{
        ApplicationLogo, Sidebar
    }
}
</script>