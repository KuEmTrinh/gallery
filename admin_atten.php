<?php
include 'admin_header.php';
?>
<style>
    .flex {
        display: flex;
    }

    .flex-column {
        flex-direction: column;
    }

    .atten {
        width: 50rem;
        text-align: center;
    }

    .atten__input {
        width: 50rem;
        height: 20rem;
    }

    .mbt-1 {
        margin-bottom: 1rem;
    }

    .atten__btn {
        margin: 0 auto;
        background-color: #565656;
        color: #eee;
        width: 10rem;
        padding: 1rem 2rem;
        border: none;
        border-radius: 0.5rem;
    }

    .center {
        margin: 0 auto;
    }

    .w-50 {
        width: 50rem;
    }

    .w100 {
        width: 100%;
    }
</style>

<div class="w100 flex" id="app">
    <div class="atten center w-50 flex flex-column">
        <h1 class="mbt-1">注意事項記入</h1>
        <textarea class="atten__input mbt-1" v-model="content"></textarea>
        <div class="atten__btn" @click="createAtten">送信</div>
    </div>
    <div>
        <div class="gallery_buttons">
            <button class="Attention_delete" @click.prevent="AttentionDelete(Attention.id,Attention.content)">削除</button>
            <button class="Attention_Edit" @click.prevent="galleryGetEl(gallery.id, gallery.name)">編集</button>
        </div>
    </div>
</div>

<script>
    var vm = new Vue({
        el: '#app',
        data: function() {
            return {
                content: ""
            }
        },
        methods: {
            createAtten() {
                axios.post('controller/AttentionController.php', {
                    action: 'createAttention',
                    content: this.content
                }).then((response) => console.log(response.data))
            },
        },
        created() {

        }
    })
</script>