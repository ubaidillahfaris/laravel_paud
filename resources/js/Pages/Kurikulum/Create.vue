<template>
     <AdminAuthenticatedLayout>
        <div class="grid grid-cols-1 gap-12">

            <div class="w-full card p-4">
                <div class="d-sm-flex d-block w-full align-items-center justify-content-between mb-9">    
                    <!-- card header -->
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-bold">Tambah kurikulum</h5>
                        <p class="card-subtitle mb-0">
                            Tambahkan kurikulum baru yang digunkanan pada sekolah
                        </p>
                    </div>


                </div>
                <!-- content -->

                <div class="row w-ful">
                    
                    <!-- nama kurikulum -->
                    <div class="col-md-6">
                        <span>Nama Kurikulum : </span>
                        <input
                            type="text"
                            class="form-control"
                            id="tb-fname"
                            placeholder="Isi nama Kurikulum"
                            v-model="form.name"
                        />
                        <label class="text-danger">{{ errors?.name[0] }}</label>
                    </div>

                    <!-- status kurikulum -->
                    <div class="col-md-6">
                        <span>Status Kurikulum : </span>
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="status_kurikulum"
                                v-model="form.is_active"
                            />
                            <label class="form-check-label" for="status_kurikulum">
                                Status kurikulum akan digunakan pada transaksional data pendidikan disekolah
                            </label>
                        </div>
                    </div>


                    <!-- submit button -->
                    <div class="col-md-12 mt-2">
                        <button @click="post" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <!-- content -->
            </div>
        </div>
    </AdminAuthenticatedLayout>
</template>

<script>
import AdminAuthenticatedLayout from '@/Layouts/Admin/Layout.vue'
import { useForm, usePage } from '@inertiajs/vue3';
export default {
   components:{
    AdminAuthenticatedLayout
   },
    data() {
        return {
            LayoutComponent:null,
            userRole:usePage().props.auth.user.role,
            form: useForm({
                name: '',
                is_active: false
            }),
            errors:null
        }
    },
    methods: {
        async post() {
            const request = await axios.post(route('kurikulum.store'), this.form)
            .then((result) => {
                return result;
            }).catch((err) => {
                if (err.response.status == 422) {
                    this.errors = err.response.data.errors
                }
                
            });
                
            if (request?.status == 200) {
                this.$inertia.visit(route('kurikulum.index'));
            }
        }
    },
}
</script>