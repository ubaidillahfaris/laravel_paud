<template>
     <AuthenticatedLayout>
           <div class="row">
               <div class="col-lg-12 d-flex align-items-strech">
               <div class="card w-100">
                   <div class="card-body">
                   <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                       <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">PPDB Online</h5>
                        <p class="card-subtitle mb-0">
                            Lorem ipsum dolor sit amet.
                        </p>
                       </div>
                   </div>
                   <div class="row align-items-center">
                    <!-- Overview Card -->
                       <div class="col-4">
                            <div class="d-flex align-items-center mb-4 pb-1">
                                <div class="p-8 bg-light-primary rounded-1 me-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-primary fs-6"></i>
                                </div>
                                <div>
                                <h4 class="mb-0 fs-7 fw-semibold">200 Pendaftar</h4>
                                <p class="fs-3 mb-0">PPDB Aktif semua gelombang</p>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-baseline mb-4">
                                <span class="round-8 bg-primary rounded-circle me-6"></span>
                                <div>
                                    <p class="fs-3 mb-1">Earnings this month</p>
                                    <h6 class="fs-5 fw-semibold mb-0">$48,820</h6>
                                </div>
                                </div>
                                <div class="d-flex align-items-baseline mb-4 pb-1">
                                <span class="round-8 bg-secondary rounded-circle me-6"></span>
                                <div>
                                    <p class="fs-3 mb-1">Expense this month</p>
                                    <h6 class="fs-5 fw-semibold mb-0">$26,498</h6>
                                </div>
                                </div>
                                <div>
                                <button class="btn btn-primary w-100">View Full Report</button>
                                </div>
                            </div>
                       </div> 
                    <!-- end Overview Card -->

                    <!-- Overview Card -->
                       <div class="col-4">
                            <div class="d-flex align-items-center mb-4 pb-1">
                                <div class="p-8 bg-light-primary rounded-1 me-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-primary fs-6"></i>
                                </div>
                                <div>
                                <h4 class="mb-0 fs-7 fw-semibold">130 Lolos Seleksi</h4>
                                <p class="fs-3 mb-0">PPDB Aktif semua gelombang</p>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-baseline mb-4">
                                <span class="round-8 bg-primary rounded-circle me-6"></span>
                                <div>
                                    <p class="fs-3 mb-1">Earnings this month</p>
                                    <h6 class="fs-5 fw-semibold mb-0">$48,820</h6>
                                </div>
                                </div>
                                <div class="d-flex align-items-baseline mb-4 pb-1">
                                <span class="round-8 bg-secondary rounded-circle me-6"></span>
                                <div>
                                    <p class="fs-3 mb-1">Expense this month</p>
                                    <h6 class="fs-5 fw-semibold mb-0">$26,498</h6>
                                </div>
                                </div>
                                <div>
                                <button class="btn btn-primary w-100">View Full Report</button>
                                </div>
                            </div>
                       </div>
                    <!-- end Overview Card -->

                    <!-- Overview Card -->
                    <div class="col-4">
                            <div class="d-flex align-items-center mb-4 pb-1">
                                <div class="p-8 bg-light-primary rounded-1 me-3 d-flex align-items-center justify-content-center">
                                <i class="ti ti-grid-dots text-primary fs-6"></i>
                                </div>
                                <div>
                                <h4 class="mb-0 fs-7 fw-semibold">40 Gagal Seleksi</h4>
                                <p class="fs-3 mb-0">PPDB Aktif semua gelombang</p>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-baseline mb-4">
                                <span class="round-8 bg-primary rounded-circle me-6"></span>
                                <div>
                                    <p class="fs-3 mb-1">Earnings this month</p>
                                    <h6 class="fs-5 fw-semibold mb-0">$48,820</h6>
                                </div>
                                </div>
                                <div class="d-flex align-items-baseline mb-4 pb-1">
                                <span class="round-8 bg-secondary rounded-circle me-6"></span>
                                <div>
                                    <p class="fs-3 mb-1">Expense this month</p>
                                    <h6 class="fs-5 fw-semibold mb-0">$26,498</h6>
                                </div>
                                </div>
                                <div>
                                <button class="btn btn-primary w-100">View Full Report</button>
                                </div>
                            </div>
                    </div>
                    <!-- end Overview Card -->

                   </div>
                   </div>
               </div>
               </div>
               <div class="col-lg-4">
               <div class="row">
                   <div class="col-lg-12 col-md-6 col-sm-12">
                   <!-- Monthly Earnings -->
                   <div class="card">
                       <div class="card-body">
                       <div class="row alig n-items-start">
                           <div class="col-8">
                           <h5 class="card-title mb-9 fw-semibold"> Buat PPDB Baru </h5>
                           <div class="d-flex align-items-center pb-1">
                               <Link :href="route('ppdb.create')" class="btn btn-primary">Create</Link>
                           </div>
                           </div>
                           <div class="col-4">
                           <div class="d-flex justify-content-end">
                               <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                               <i class="ti ti-currency-dollar fs-6"></i>
                               </div>
                           </div>
                           </div>
                       </div>
                       </div>
                       <div id="earning"></div>
                   </div>
                   </div>
               </div>
               </div>
           </div>
           <!--  Row 3 -->
           <div class="row">
             
               <!-- Top Performers -->
               <div class="col-lg-12 d-flex align-items-strech">
               <div class="card w-100">
                   <div class="card-body">
                   <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                       <div class="mb-3 mb-sm-0">
                       <h5 class="card-title fw-semibold">Top Performers</h5>
                       <p class="card-subtitle mb-0">Best Employees</p>
                       </div>
                       <div>
                       <select class="form-select">
                           <option value="1">March 2023</option>
                           <option value="2">April 2023</option>
                           <option value="3">May 2023</option>
                           <option value="4">June 2023</option>
                       </select>
                       </div>
                   </div>
                   <div class="table-responsive">
                       <table class="table align-middle text-nowrap mb-0">
                       <thead>
                           <tr class="text-muted fw-semibold">
                           <th scope="col" class="ps-0">Assigned</th>
                           <th scope="col">Project</th>
                           <th scope="col">Priority</th>
                           <th scope="col">Budget</th>
                           </tr>
                       </thead>
                       <tbody class="border-top">
                           <tr>
                           <td class="ps-0">
                               <div class="d-flex align-items-center">
                               <div class="me-2 pe-1">
                                   
                               </div>
                               <div>
                                   <h6 class="fw-semibold mb-1">Sunil Joshi</h6>
                                   <p class="fs-2 mb-0 text-muted">Web Designer</p>
                               </div>
                               </div>
                           </td>
                           <td>
                               <p class="mb-0 fs-3">Elite Admin</p>
                           </td>
                           <td>
                               <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary">Low</span>
                           </td>
                           <td>
                               <p class="fs-3 text-dark mb-0">$3.9K</p>
                           </td>
                           </tr>
                           <tr>
                           <td class="ps-0">
                               <div class="d-flex align-items-center">
                               <div class="me-2 pe-1">
                                   
                               </div>
                               <div>
                                   <h6 class="fw-semibold mb-1">John Deo</h6>
                                   <p class="fs-2 mb-0 text-muted"> Web Developer </p>
                               </div>
                               </div>
                           </td>
                           <td>
                               <p class="mb-0 fs-3">Flexy Admin</p>
                           </td>
                           <td>
                               <span class="badge fw-semibold py-1 w-85 bg-light-warning text-warning">Medium</span>
                           </td>
                           <td>
                               <p class="fs-3 text-dark mb-0">$24.5K</p>
                           </td>
                           </tr>
                           <tr>
                           <td class="ps-0">
                               <div class="d-flex align-items-center">
                               <div class="me-2 pe-1">
                                   
                               </div>
                               <div>
                                   <h6 class="fw-semibold mb-1">Nirav Joshi</h6>
                                   <p class="fs-2 mb-0 text-muted">Web Manager</p>
                               </div>
                               </div>
                           </td>
                           <td>
                               <p class="mb-0 fs-3">Material Pro</p>
                           </td>
                           <td>
                               <span class="badge fw-semibold py-1 w-85 bg-light-info text-info">High</span>
                           </td>
                           <td>
                               <p class="fs-3 text-dark mb-0">$12.8K</p>
                           </td>
                           </tr>
                           <tr>
                           <td class="ps-0">
                               <div class="d-flex align-items-center">
                               <div class="me-2 pe-1">
                                   
                               </div>
                               <div>
                                   <h6 class="fw-semibold mb-1">Yuvraj Sheth</h6>
                                   <p class="fs-2 mb-0 text-muted"> Project Manager </p>
                               </div>
                               </div>
                           </td>
                           <td>
                               <p class="mb-0 fs-3">Xtreme Admin</p>
                           </td>
                           <td>
                               <span class="badge fw-semibold py-1 w-85 bg-light-success text-success">Low</span>
                           </td>
                           <td>
                               <p class="fs-3 text-dark mb-0">$4.8K</p>
                           </td>
                           </tr>
                           <tr>
                           <td class="border-0 ps-0">
                               <div class="d-flex align-items-center">
                               <div class="me-2 pe-1">
                                   
                               </div>
                               <div>
                                   <h6 class="fw-semibold mb-1">Micheal Doe</h6>
                                   <p class="fs-2 mb-0 text-muted"> Content Writer </p>
                               </div>
                               </div>
                           </td>
                           <td class="border-0">
                               <p class="mb-0 fs-3">Helping Hands WP Theme</p>
                           </td>
                           <td class="border-0">
                               <span class="badge fw-semibold py-1 w-85 bg-light-danger text-danger">High</span>
                           </td>
                           <td class="border-0">
                               <p class="fs-3 text-dark mb-0">$9.3K</p>
                           </td>
                           </tr>
                       </tbody>
                       </table>
                   </div>
                   </div>
               </div>
               </div>
           </div>
   </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import {Link} from '@inertiajs/vue3';
export default {
    components:{
        AuthenticatedLayout,Link
    }    
}
</script>