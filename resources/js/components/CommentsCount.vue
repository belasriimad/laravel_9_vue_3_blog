<template>
  <h3 class="my-3">
    Comments ({{store.getComments.length}})
  </h3>
</template>

<script setup>
    import { useCommentsStore } from '@/stores/useCommentsStore';

    const store = useCommentsStore();
</script>

<style>

</style>