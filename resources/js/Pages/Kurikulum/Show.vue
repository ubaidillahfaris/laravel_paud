<template>
    <AdminAuthenticatedLayout>
        <div class="grid grid-cols-1 gap-6">

            <div class="w-full card p-4">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">    
                    <!-- card header -->
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Kurikulum Sekolah</h5>
                       
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
import AdminAuthenticatedLayout from '@/Layouts/Admin/Layout.vue';
import Toast from '@/Toast';
export default {
    components:{
        AdminAuthenticatedLayout
    },
    props:{
        kurikulum:Object
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.kurikulum.name,
                is_active: this.kurikulum.is_active
            })
        }
    },
    methods: {
        async post(){
            const request = await axios.put(route('kurikulum.update', this.kurikulum.id), this.form);
            if (request.status == 200) {
                Toast.fire('Berhasil mengubah data', '' , 'success')
                this.$inertia.visit(route('kurikulum.index'));
            }else{
                Toast.fire('Gagal mengubah data', '' , 'error')
            }

        }
    },
}
</script>