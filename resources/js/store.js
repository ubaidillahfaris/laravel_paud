// src/store.js
import { defineStore } from 'pinia';

export const useMainStore = defineStore('main', {
  state: () => ({
    toggleSidebar: true,
  }),
  actions: {
    toggle() {
        this.toggleSidebar = !this.toggleSidebar;
    },
  },
});