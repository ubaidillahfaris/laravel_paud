<template>
    <div>
        <AuthenticatedLayout>
           
                <!--  Owl carousel -->
                <!--  Row 1 -->
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                    <!-- Monthly Earnings -->0
                        <div class="card">
                            <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold"> Total Mitra </h5>
                                <h4 class="fw-semibold mb-3">{{ data.total }} <small>mitra</small> </h4>
                                <div class="d-flex align-items-center pb-1">
                                    <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-down-right text-danger"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                    <p class="fs-3 mb-0">last year</p>
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
                        </div>
                    <!-- end Monthly Earnings -->

                    </div>
                    <div class="col-lg-4 col-sm-12">
                    <!-- Monthly Earnings -->
                        <div class="card">
                            <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-12 mb-4">
                                    <h5 class="card-title fw-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-primary" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M16 14a5 5 0 0 1 5 5v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5zm4-6a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1V9a1 1 0 0 1 1-1m-8-6a5 5 0 1 1 0 10a5 5 0 0 1 0-10"/></g></svg>
                                        <span> Tambah mitra</span>
                                     </h5>
                                    <span class="text-sm mb-3">
                                        Isi formulir mitra dan pastikan data yang disimpan adalah data valid    
                                    </span>
                                    
                                </div>
                                <Link :href="route('sekolah.add')"class="btn btn-sm btn-success">Tambahkan mitra baru</Link>
                            </div>
                            </div>
                        </div>
                    <!-- end Monthly Earnings -->

                    </div>
                    
                </div>
               
                <!--  Row 3 -->
                <div class="row">
                    <!-- Top Performers -->
                    <div class="col-lg-12 col-md-8 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Mitra Sekolah</h5>
                                <p class="card-subtitle mb-0">Daftar mitra sekolah</p>
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
                                        <th scope="col">Nama Sekolah</th>
                                        <th scope="col">Provinsi</th>
                                        <th scope="col">Kota</th>
                                        <th scope="col">Total Siswa</th>
                                        <th scope="col">Habis langganan</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    <tr v-for="(item, index) in data.data" :key="index">
                                        <td class="ps-0">
                                            <div class="d-flex align-items-center">
                                                <div class="me-2 pe-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 0 0-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 0 1 5.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 0 1 9.288 0M15 7a3 3 0 1 1-6 0a3 3 0 0 1 6 0m6 3a2 2 0 1 1-4 0a2 2 0 0 1 4 0M7 10a2 2 0 1 1-4 0a2 2 0 0 1 4 0"/></svg>
                                                </div>
                                                <div>
                                                    <h6 class="fw-semibold mb-1">{{ item.name }}</h6>
                                                    <!-- <p class="fs-2 mb-0 text-muted">Web Designer</p> -->
                                                </div>
                                            </div>
                                            
                                        </td>
                                        <td class="ps-0">
                                            {{ item?.provinsi?.name??'' }}
                                        </td>
                                        <td class="ps-0">
                                            {{ item?.kota?.name??'' }}
                                        </td>
                                        <td class="ps-0">
                                            0 Siswa
                                        </td>
                                        <td class="ps-0">
                                            {{ item?.created_at??'' }}
                                        </td>
                                        <td class="ps-0">
                                            <div class="btn-group">
                                                <button
                                                        class="btn btn-light mb-1 waves-effect waves-light dropdown-toggle"
                                                        type="button"
                                                        data-bs-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="true"
                                                    >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><circle cx="8" cy="2.5" r=".75"/><circle cx="8" cy="8" r=".75"/><circle cx="8" cy="13.5" r=".75"/></g></svg>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <Link class="dropdown-item" :href="route('admin_sekolah.add_admin_page',{'sekolah_id':item.id})">Tambah admin</Link>
                                                    </li>
                                                    <li>
                                                    <hr class="dropdown-divider" />
                                                    </li>
                                                    <li>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                        <Pagination @on-click="onClickPage" :links-data="data.links"></Pagination>
                    </div>
                    </div>
                </div>
        </AuthenticatedLayout>
    </div>
</template>


<script>
import AuthenticatedLayout from '@/Layouts/Superadmin/Layout.vue';
import Pagination from '@/Components/Pagination.vue';
import {Link} from '@inertiajs/vue3';
import moment from 'moment';

export default {
    components:{
        AuthenticatedLayout, Pagination, Link
    },
    data() {
        return {
            data:{}
        }
    },
    mounted() {
        this.getSekolahData()
    },
    methods: {
        async getSekolahData(url){

            if (url == null) {
                url = route('sekolah.show');
            }

            const request = await axios.get(url)
            .then((result) => {
                return result.data
            }).catch((err) => {
                console.log(err)
            });

            
            const tempData = request.data.map((item) => {
                item.created_at = moment(item.created_at).format('lll')
                return item;
            })
            request.data = tempData;
            this.data = request;
        },
        onClickPage(url){
            this.getSekolahData(url)
        },
        getProvince(){
            
        }  
    },
    
}
</script>