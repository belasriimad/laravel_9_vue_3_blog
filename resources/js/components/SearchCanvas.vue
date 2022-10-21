<template>
<div class="offcanvas offcanvas-start" tabindex="-1" id="searchcanvas" aria-labelledby="searchcanvaslabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="searchcanvaslabel">{{placeholder}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <input type="text"
            v-model="data.term"
            :placeholder="props.placeholder"
            @change="getPostsByTerm"
            class="form-control">
        <div v-if="data.posts.length">
            <ul class="list-group">
                <li class="list-group-item" v-for="post in data.posts" :key="post.id">
                    <a :href="`http://127.0.0.1:8000/posts/${post.slug}`">
                        {{placeholder === 'Search' ? post.title_en : post.title_fr}}
                    </a>
                </li>
            </ul>
        </div>
        <ul class="list-group" v-if="data.message">
            <li class="list-group-item">
                {{data.message}}
            </li>
        </ul>
    </div>
</div>
</template>

<script setup>
    import { reactive } from "vue";

    const data = reactive({
        posts: [],
        term: '',
        message: ''
    });

    const props = defineProps({
        placeholder: {
            type: String,
            required: true
        }
    })

    const getPostsByTerm = async () => {
        clearResults();
        if(data.term.length >= 3){
            try {
                const response = await axios.post('/api/search',{
                    term: data.term
                });
                if(response.data.length){
                    data.posts = response.data;
                }else{
                    data.message = 'Nothing found!'
                }
            } catch (error) {
                console.log(error);
            }
        }
    }

    const clearResults = () => {
        data.posts = [];
        data.message = '';
    }
</script>

<style>

</style>