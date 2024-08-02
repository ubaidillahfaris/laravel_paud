export default {
    data() {
      return {
        LayoutComponent: null,
      };
    },
    async created() {
      await this.loadLayout();
    },
    methods: {
      async loadLayout() {
        if (this.user_role == 'admin') {
          this.LayoutComponent = (await import('@/Layouts/Admin/Layout.vue')).default;
        } else {
          this.LayoutComponent = (await import('@/Layouts/Guru/Layout.vue')).default;
        }
        this.$root.layoutComponent = this.LayoutComponent;
      },
    },
  };
  