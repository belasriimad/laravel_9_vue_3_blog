<template>
  <div class="d-flex flex-column">
    <div class="flex" v-for="comment in store.getComments.slice(0, data.commentToShow)" :key="comment.id">
        <div class="flex-shrink-0">
            <span class="fw-bold">
                {{comment.user.name}}
            </span>
        </div>
        <div class="flex-grow-1 ms-">
            <span class="text-muted">
                <i> {{comment.created_at}}</i>
            </span>
            <p>
                {{comment.body}}
            </p>
        </div>
    </div>
    <button v-if="data.commentToShow < store.getComments.length"
        @click="loadMoreComments"
        class="btn btn-sm btn-link">
        Load more
    </button>
  </div>
</template>

<script setup>
    import { useCommentsStore } from '@/stores/useCommentsStore';
    import { onMounted, reactive } from 'vue';

    const store = useCommentsStore();

    const data = reactive({
        commentToShow: 3
    });

    const props = defineProps({
        post_id: {
            type: Number,
            required: true
        }
    });

    const loadMoreComments = () => {
        if(data.commentToShow >= store.getComments.length){
            return;
        }else{
            data.commentToShow = data.commentToShow + 3;
        }
    }

    onMounted(() => store.fetchComments(props.post_id));
</script>

<style>

</style>