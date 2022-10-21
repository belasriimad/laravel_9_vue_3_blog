<template>
    <form @submit.prevent="addComment">
        <div class="mb-2">
            <textarea 
                placeholder="start typing..."
                v-model="data.body"
                :required="true"
                class="form-control" cols="30" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            Add
        </button>
    </form>
</template>

<script setup>
    import { reactive } from 'vue';
    import { useCommentsStore } from '@/stores/useCommentsStore';

    const data = reactive({
        body: ''
    });

    const store = useCommentsStore();

    const props = defineProps({
        user_id: {
            type: Number,
            required: true
        },
        post_id: {
            type: Number,
            required: true
        }
    })

    const addComment = async () => {
        store.storeComment(props.user_id, props.post_id, data.body);
        data.body = '';
    };
</script>

<style>

</style>