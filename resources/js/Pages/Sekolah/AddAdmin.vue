<template>
    <AuthenticatedLayout>
        <div class="row">
            <div class="col-12">
            <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Tambah akun admin sekolah</h5>
                                    <p class="card-subtitle mb-0">Akun admin sekolah digunakan untuk mengakses prosess data setiap sekolah</p>
                                </div>
                            </div>

                            <div class="w-full row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="tb-fname"
                                        placeholder="Isi nama akun disini"
                                        />
                                        <label for="tb-fname">Nama akun</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="email"
                                        class="form-control"
                                        id="tb-fname"
                                        placeholder="Isi email akun disini"
                                        />
                                        <label for="tb-fname">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="password"
                                        class="form-control"
                                        id="tb-fname"
                                        placeholder="Isi password akun disini"
                                        />
                                        <label for="tb-fname">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="password"
                                        class="form-control"
                                        id="tb-fname"
                                        placeholder="Konfirmasi password akun disini"
                                        />
                                        <label for="tb-fname">Confirm password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="tb-fname"
                                        placeholder="Isi nomor disini"
                                        />
                                        <label for="tb-fname">Nomor telepon</label>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary w-fit"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c4.411 0 8 3.589 8 8s-3.589 8-8 8s-8-3.589-8-8s3.589-8 8-8m0-2C6.477 2 2 6.477 2 12s4.477 10 10 10s10-4.477 10-10S17.523 2 12 2m5 9h-4V7h-2v4H7v2h4v4h2v-4h4z"/></svg>
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
            <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Daftar akun admin sekolah</h5>
                                    <p class="card-subtitle mb-0">Akun yang telah ditambahkan</p>
                                </div>
                            </div>

                            <!-- table -->
                            
                                    <div class="d-sm-flex d-block align-items-center justify-content-end mb-7">
                                        <div>
                                            <div class="form-floating mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="tb-fname"
                                                    placeholder="search"
                                                    v-model="search"
                                                />
                                                <label for="tb-fname">Search</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table align-middle text-nowrap mb-0">
                                            <thead>
                                                <tr class="text-muted fw-semibold">
                                                    <th scope="col">Nama Akun</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Tanggal bergabung</th>
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
                                                                <h6 class="fw-semibold mb-1">{{ item?.user?.name}}</h6>
                                                            </div>
                                                        </div>
                                                        
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ item?.user?.email }}
                                                    </td>
                                                    <td class="ps-0">
                                                        {{ item.created_at }}
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
                                                                    <Link class="dropdown-item" :href="route('admin_sekolah.add_admin_page',{'sekolah_id':item.id})">Nonaktifkan</Link>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <Pagination @on-click="onClickPage" :links-data="data.links"></Pagination>
                        </div>
                    </div>
                <!-- end table -->
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/Superadmin/Layout.vue';
import moment from 'moment';
import Pagination from '@/Components/Pagination.vue';

export default {
    props:{
        sekolah_id:{
            type:Number,
            required: true
        }
    },
    components:{
        AuthenticatedLayout,Pagination
    },
    watch: {
        search(newVal){
            this.getDataAdmin()
        }
    },
    data() {
        return {
            data:{},
            search:null
        }
    },
    mounted() {
        this.getDataAdmin()
    },
    methods: {
        async getDataAdmin(url){
            if (url == null) {
                url = route('admin_sekolah.show',{sekolah_id:this.sekolah_id,_query:{
                    search:this.search
                }})
            }

            const request = await axios.get(url);
            const response = request.data;
            
            response.data = response?.data?.map((item) => {
                item.created_at = moment(item.created_at).format('lll');
                return item;
            })

            this.data = response
        },
        onClickPage(url){
            this.getDataAdmin(url)
        },
    },
}
</script>