<template>
    <div class="text-center">
      <h1>Error {{ errorCode }}</h1>
      <p>{{ errorMessage }}</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      errorCode: {
        type: Number,
        required: true,
      },
      errorMessage: {
        type: String,
        default: 'Something went wrong!',
      },
    },
  };
  </script>
  