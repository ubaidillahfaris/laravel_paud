<template>
    <!--  Header Start -->
    <header class="app-header"> 
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
            </a>
        </li>
        <li class="nav-item d-none d-lg-block">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-search"></i>
            </a>
        </li>
        </ul>
        <ul class="navbar-nav quick-links d-none d-lg-flex">
        <li class="nav-item dropdown hover-dd d-none d-lg-block">
            <a class="nav-link" href="javascript:void(0)" data-bs-toggle="dropdown">Apps<span class="mt-1"><i class="ti ti-chevron-down"></i></span></a>
            <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up py-0">
            <div class="row">
                <div class="col-8">
                <div class=" ps-7 pt-7">
                    <div class="border-bottom">
                    <div class="row">
                        <div class="col-6">
                        <div class="position-relative">
                            <a href="./app-chat.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Chat Application</h6>
                                <span class="fs-2 d-block text-dark">New messages arrived</span>
                            </div>
                            </a>
                            <a href="./app-invoice.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Invoice App</h6>
                                <span class="fs-2 d-block text-dark">Get latest invoice</span>
                            </div>
                            </a>
                            <a href="./app-contact2.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Contact Application</h6>
                                <span class="fs-2 d-block text-dark">2 Unsaved Contacts</span>
                            </div>
                            </a>
                            <a href="./app-email.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Email App</h6>
                                <span class="fs-2 d-block text-dark">Get new emails</span>
                            </div>
                            </a>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="position-relative">
                            <a href="./page-user-profile.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">User Profile</h6>
                                <span class="fs-2 d-block text-dark">learn more information</span>
                            </div>
                            </a>
                            <a href="./app-calendar.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Calendar App</h6>
                                <span class="fs-2 d-block text-dark">Get dates</span>
                            </div>
                            </a>
                            <a href="./app-contact.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Contact List Table</h6>
                                <span class="fs-2 d-block text-dark">Add new contact</span>
                            </div>
                            </a>
                            <a href="./app-notes.html" class="d-flex align-items-center pb-9 position-relative text-decoration-none text-decoration-none text-decoration-none text-decoration-none">
                            <div class="bg-light rounded-1 me-3 p-6 d-flex align-items-center justify-content-center">
                                
                            </div>
                            <div class="d-inline-block">
                                <h6 class="mb-1 fw-semibold bg-hover-primary">Notes Application</h6>
                                <span class="fs-2 d-block text-dark">To-do and Daily tasks</span>
                            </div>
                            </a>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="row align-items-center py-3">
                    <div class="col-8">
                        <a class="fw-semibold text-dark d-flex align-items-center lh-1 text-decoration-none" href="#"><i class="ti ti-help fs-6 me-2"></i>Frequently Asked Questions</a>
                    </div>
                    <div class="col-4">
                        <div class="d-flex justify-content-end pe-4">
                        <button class="btn btn-primary">Check</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-4 ms-n4">
                <div class="position-relative p-7 border-start h-100">
                    <h5 class="fs-5 mb-9 fw-semibold">Quick Links</h5>
                    <ul class="">
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="./page-pricing.html">Pricing Page</a>
                    </li>
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="./authentication-login.html">Authentication Design</a>
                    </li>
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="./authentication-register.html">Register Now</a>
                    </li>
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="authentication-error.html">404 Error Page</a>
                    </li>
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="./app-notes.html">Notes App</a>
                    </li>
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="./page-user-profile.html">User Application</a>
                    </li>   
                    <li class="mb-3">
                        <a class="fw-semibold text-dark bg-hover-primary text-decoration-none text-decoration-none text-decoration-none text-decoration-none" href="./page-account-settings.html">Account Settings</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </li>
        <li class="nav-item dropdown-hover d-none d-lg-block">
            <a class="nav-link" href="app-chat.html">Chat</a>
        </li>
        <li class="nav-item dropdown-hover d-none d-lg-block">
            <a class="nav-link" href="app-calendar.html">Calendar</a>
        </li>
        <li class="nav-item dropdown-hover d-none d-lg-block">
            <a class="nav-link" href="app-email.html">Email</a>
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
            <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar" aria-controls="offcanvasWithBothOptions">
            <i class="ti ti-align-justified fs-7"></i>
            </a>
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

export default {
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