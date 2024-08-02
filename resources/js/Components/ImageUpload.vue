<template>
   <div>
    <div class="form-group">
        <label for="imageUpload">Pilih Gambar</label>
        <input type="file" class="form-control" id="imageUpload" @change="onImageChange">
        </div>
        <div v-if="imageUrl" class="mt-3">
        <h5>Pratinjau Gambar:</h5>
        <img :src="imageUrl" alt="Image Preview" class="img-fluid">
    </div>
   </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        imageUrl: null,
      };
    },
    methods: {
      onImageChange(event) {
        const file = event.target.files[0];
        if (file) {
          this.imageUrl = URL.createObjectURL(file);
          this.$emit('image-uploaded', file); // Emit file ke parent
        }
      },
    },
  };
  </script>

  