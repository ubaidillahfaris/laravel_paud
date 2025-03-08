<template>
    <!--  Header Start -->
    <header class="app-header"> 
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <ul class="navbar-nav">
        <li class="nav-item">
            <button @click="toggleState" class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse">
                <i class="ti ti-menu-2"></i>
            </button>
        </li>
        </ul>
        
        <div class="d-block d-lg-none">
        
        
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="p-2">
            <i class="ti ti-dots fs-7"></i>
        </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="d-flex align-items-center justify-content-between">
            <button @click="()=>{console.log('aaa')}" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
                <i class="ti ti-align-justified fs-7"></i>aa
            </button>

            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="message-body" data-simplebar>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                    <div class="position-relative">
                        
                    </div>
                    <p class="mb-0 fs-3">English (UK)</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                    <div class="position-relative">
                        
                    </div>
                    <p class="mb-0 fs-3">中国人 (Chinese)</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                    <div class="position-relative">
                        
                    </div>
                    <p class="mb-0 fs-3">français (French)</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
                    <div class="position-relative">
                        
                    </div>
                    <p class="mb-0 fs-3">عربي (Arabic)</p>
                    </a>
                </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link notify-badge nav-icon-hover" href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-basket"></i>
                    <span class="badge rounded-pill bg-danger fs-2">2</span>                   
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
                </a>
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                <div class="d-flex align-items-center justify-content-between py-3 px-7">
                    <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
                    <span class="badge bg-primary rounded-4 px-3 py-1 lh-sm">5 new</span>
                </div>
                <div class="message-body" data-simplebar>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                    <span class="me-3">
                        
                    </span>
                    <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                        <span class="d-block">Congratulate him</span>
                    </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                    <span class="me-3">
                        
                    </span>
                    <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">New message</h6>
                        <span class="d-block">Salma sent you new message</span>
                    </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                    <span class="me-3">
                        
                    </span>
                    <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Bianca sent payment</h6>
                        <span class="d-block">Check your earnings</span>
                    </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                    <span class="me-3">
                        
                    </span>
                    <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Jolly completed tasks</h6>
                        <span class="d-block">Assign her new tasks</span>
                    </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                    <span class="me-3">
                        
                    </span>
                    <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">John received payment</h6>
                        <span class="d-block">$230 deducted from account</span>
                    </div>
                    </a>
                    <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item">
                    <span class="me-3">
                        
                    </span>
                    <div class="w-75 d-inline-block v-middle">
                        <h6 class="mb-1 fw-semibold">Roman Joined the Team!</h6>
                        <span class="d-block">Congratulate him</span>
                    </div>
                    </a>
                </div>
                <div class="py-6 px-7 mb-1">
                    <button class="btn btn-outline-primary w-100"> See All Notifications </button>
                </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown" >
                <div class="d-flex align-items-center">
                    <div class="user-profile-img">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10s10-4.48 10-10S17.52 2 12 2m0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6m0 14c-2.03 0-4.43-.82-6.14-2.88a9.947 9.947 0 0 1 12.28 0C16.43 19.18 14.03 20 12 20"/></svg>
                    </div>
                </div>
                </a>
                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                <div class="profile-dropdown position-relative" data-simplebar>
                    <div class="py-3 px-7 pb-0">
                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                    </div>
                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                    
                    <div class="ms-3">
                        <h5 class="mb-1 fs-3">Mathew Anderson</h5>
                        <span class="mb-1 d-block text-dark">Designer</span>
                        <p class="mb-0 d-flex text-dark align-items-center gap-2">
                        <i class="ti ti-mail fs-4"></i> info@modernize.com
                        </p>
                    </div>
                    </div>
                    <div class="message-body">
                    <a href="./page-user-profile.html" class="py-8 px-7 mt-8 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                        
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                        <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                        <span class="d-block text-dark">Account Settings</span>
                        </div>
                    </a>
                    <a href="./app-email.html" class="py-8 px-7 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                        
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                        <h6 class="mb-1 bg-hover-primary fw-semibold">My Inbox</h6>
                        <span class="d-block text-dark">Messages & Emails</span>
                        </div>
                    </a>
                    <a href="./app-notes.html" class="py-8 px-7 d-flex align-items-center">
                        <span class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                        
                        </span>
                        <div class="w-75 d-inline-block v-middle ps-3">
                        <h6 class="mb-1 bg-hover-primary fw-semibold">My Task</h6>
                        <span class="d-block text-dark">To-do and Daily Tasks</span>
                        </div>
                    </a>
                    <div class="py-8 px-7 d-flex align-items-center">

                        <button class="btn" @click="logout">Logout</button>
                    </div>
                    </div>
                    
                </div>
                </div>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    </header>
    <!--  Header End -->
</template>

<script>
import { useMainStore } from '@/store';

export default {
    setup(props) {
        const mainStore = useMainStore();
        const toggleState = () => {
            mainStore.toggle();
            console.log(mainStore.toggleSidebar)
        };
        return { toggleState };
    },
    methods: {
        async logout(){
            await axios.post(route('logout'))
            .then((result) => {
               window.location.href = route('login');
            }).catch((err) => {
                
            });
        }
    },
}
</script>