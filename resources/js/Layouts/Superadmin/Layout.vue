<template>
     <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme"  
     data-layout="vertical" data-sidebartype="full" 
     data-sidebar-position="fixed" data-header-position="fixed">
        
        <Sidebar></Sidebar>

        <div class="body-wrapper">
          
          <!-- Nabar -->
          <Navbar></Navbar>
          <!-- end Nabar -->

          <div class="container-fluid">
              <slot></slot>
        </div>
    </div>

     </div>
</template>

<script>
    import ApplicationLogo from '@/Components/ApplicationLogo.vue';
    import Sidebar from '@/Layouts/Superadmin/Sidebar.vue';
    import Navbar from '@/Layouts/Navbar.vue';
export default{
    components:{
        ApplicationLogo, Sidebar,Navbar
    }
}
</script>